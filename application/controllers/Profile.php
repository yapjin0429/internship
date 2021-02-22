<?php

class Profile extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->library('encryption');
	}

	public function view_profile()
	{
		$userID = $this->session->userdata('userid');

		// Get user
		$this->db->where('id', $userID);
		$query = $this->db->get('user');
		$user  = $query->row_array();

		// Get profile
		$this->db->where('user_id', $userID);
		$query   = $this->db->get('profile');
		$profile = $query->row_array();

		$this->form_validation->set_rules('first_name', 'first name', 'required');
		$this->form_validation->set_rules('last_name', 'last name', 'required');
		$this->form_validation->set_rules('user_email', 'email', 'required|valid_email');

		if (! empty($this->input->post('user_password'))) {

			$this->form_validation->set_rules('user_password', 'new password', 'required');
			$this->form_validation->set_rules('confirm_password', 'confirm password', 'required|matches[user_password]');
		}

		if ($this->form_validation->run()) {
			// If user exists
			if (! empty($user)) {

				$data = array(
					'first_name' => $this->input->post('first_name'),
					'last_name'  => $this->input->post('last_name'),
					'email' 		 => $this->input->post('user_email')
				);

				// My new password
				$new_password = $this->input->post('user_password');
				// If user gives new password
				if (! empty($new_password)) {

					$data['password'] = $this->encryption->encrypt($new_password);
				}
				$this->db->where('id', $userID);
				$this->db->update('user', $data);

				// If profile exists
				if (! empty($profile)) {
					$data = array(
						// 'user_id' => $userID,
						'university'   => $this->input->post('university'),
						'major_course' => $this->input->post('course'),
						'skills'       => $this->input->post('skills'),
						'experience'   => $this->input->post('experience'),
						'intro'        => $this->input->post('intro'),
					);
					$this->db->where('user_id', $userID);
					$this->db->update('profile', $data);
				}
				else {

					$data = array(
						'user_id'      => $userID,
						'university'   => $this->input->post('university'),
						'major_course' => $this->input->post('course'),
						'skills'       => $this->input->post('skills'),
						'experience'   => $this->input->post('experience'),
						'intro'        => $this->input->post('intro'),
					);
					$this->db->where('user_id', $userID);
					$this->db->insert('profile', $data);
				}
				$successmessage = 'Info Successfully Updated !';
				$this->session->set_flashdata('message', $successmessage);

				redirect('profile/view_profile'); // Refresh data
			}
		}
		$data = [
			'first_name' => $user['first_name'],
			'last_name'  => $user['last_name'],
			'email'      => $user['email'],
			'university' => $profile['university'] ?? '',
			'course'     => $profile['major_course'] ?? '',
			'skills'     => $profile['skills'] ?? '',
			'experience' => $profile['experience'] ?? '',
			'intro'      => $profile['intro'] ?? ''
		];

		$this->load->view('profile/view_profile', $data);
	}














}
 
?>
