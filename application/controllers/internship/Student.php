<?php
 
/**
 * Student Dashboard
 */
class Student extends CI_Controller
{
 
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
	}

	/**
	 * View or edit student profile
	 *
	 * URL: student/profile
	 */
	public function profile($userID = 0)
	{
		$userID = $this->session->userdata('userid');

		// get user profile
		$userProfile = $this->db->where('user_id', $userID);
		$userProfile = $this->db->get('user_profile');
		$userProfile = $userProfile->row_array();

		$this->form_validation->set_rules('name', 'name', 'required');
		$this->form_validation->set_rules('dob', 'date of birth', 'required');
		$this->form_validation->set_rules('contact', 'contact', 'required');
		$this->form_validation->set_rules('email', 'email', 'required');
		$this->form_validation->set_rules('institution', 'institution', 'required');
		$this->form_validation->set_rules('program', 'program', 'required');
		$this->form_validation->set_rules('internship_start', 'internship start', 'required');
		$this->form_validation->set_rules('internship_end', 'internship end', 'required');
		$this->form_validation->set_rules('prefer_location', 'prefer location', 'required');
		$this->form_validation->set_rules('prefer_allowance', 'prefer allowance', 'required');
		$this->form_validation->set_rules('status', 'status', 'required');
	

		if ($this->form_validation->run()) {

			$viewData = 
			[	
				'name'								=> $this->input->post('name'),
				'date_of_birth' 			=> $this->input->post('dob'),
				'contact' 						=> $this->input->post('contact'),
				'email'								=> $this->input->post('email'),
				'institution' 				=> $this->input->post('institution'),
				'program' 						=> $this->input->post('program'),
				'internship_start' 		=> $this->input->post('internship_start'),
				'internship_end' 			=> $this->input->post('internship_end'),
				'prefer_location' 		=> $this->input->post('prefer_location'),
				'prefer_allowance' 		=> $this->input->post('prefer_allowance'),
				'active'							=> $this->input->post('status')							
			];

			if (! empty($_FILES['resume']['name'])) {

				$config['allowed_types'] = 'gif|jpg|png|pdf';
				$config['upload_path'] = './image/resume/';

				$this->load->library('upload', $config);

				if ($this->upload->do_upload('resume')) {

					$filedata = $this->upload->data();
					$viewData['resume'] = base_url('image/resume/'. $filedata['file_name']);	

				}
				else{
					$message = $this->upload->display_errors();
					$this->session->set_flashdata('message', $message);		
				}									
			}									

			if (! empty($userProfile)) {

				$this->db->where('user_id', $userID);
				$this->db->update('user_profile', $viewData);						

			}else{

				$viewData['user_id'] = $userID;
				$this->db->insert('user_profile', $viewData);		
			}

			$message = 'Information Updated !';
			$this->session->set_flashdata('message', $message);

			redirect('internship/student/profile');			
		}
		//Form will have error if the user haven't insert profile info before, ?? '' is allow the form wont have error if pass empty data
		$data = 
		[
		'name' 			 				=> $userProfile['name'] ?? '',
		'date_of_birth' 		=> $userProfile['date_of_birth'] ?? '',
		'contact' 					=> $userProfile['contact'] ?? '',
		'email'     				=> $userProfile['email'] ?? '',
		'institution'     	=> $userProfile['institution'] ?? '',
		'program'						=> $userProfile['program'] ?? '',
		'internship_start' 	=> $userProfile['internship_start'] ?? '',
		'internship_end'    => $userProfile['internship_end'] ?? '',
		'prefer_location'   => $userProfile['prefer_location'] ?? '',
		'prefer_allowance'	=> $userProfile['prefer_allowance'] ?? '',	
		'resume'						=> $userProfile['resume'] ?? '',
		'status'						=> $userProfile['active'] ?? ''
	  ];			

		$this->load->view('internship/student/profile', $data);
	}

	/**
	 * My Jobs.
	 * Show all the jobs applied.
	 *
	 * URL: student/my-jobs
	 */
	public function my_jobs()
	{
		$userId = $this->session->userdata('userid');

		// Get user's job
		$userJobs = $this->db->where('user_id', $userId);
		$userJobs = $this->db->get('user_job');
		$userJobs = $userJobs->result_array();

		//Get the company who post the job
		foreach ($userJobs as $index => $userJob) {

			//Add company name into array

			//get company id from job db
			$this->db->where('id', $userJob['job_id']);
			$query = $this->db->get('job');
			$companyid = $query->row('company_id');

			//use company id to find company name
			$this->db->where('id', $companyid);
			$query = $this->db->get('company');
			$company = $query->row('name');			

			$userJobs[$index]['name'] = $company;

      //Add job title into array
			$this->db->where('id', $userJob['job_id']);
			$query = $this->db->get('job');
			$title = $query->row('job_title');		

			$userJobs[$index]['job_title'] = $title;	
		
		}
		$data['userJobs'] = $userJobs;

		if (! empty($userJobs)) {

			return $this->load->view('internship/student/my_jobs', $data);		
		}		
		$this->load->view('internship/student/my_jobs');		
	}

	/**
	 * My Offers.
	 * Show the offer requests sent by the recruiters.
	 *
	 * URL: student/my-offers
	 */
	public function my_offers()
	{
		$userId = $this->session->userdata('userid');

		// Get user's offers
		$userOffers = $this->db->where('user_id', $userId);
		$userOffers = $this->db->get('company_offer');
		$userOffers = $userOffers->result_array();


		foreach ($userOffers as $index => $userOffer) {

			$companyName = $this->db->where('id', $userOffer['company_id']);
			$companyName = $this->db->get('company');
			$companyName = $companyName->row('name');

			$userOffers[$index]['companyName'] = $companyName;

			$jobTitle = $this->db->where('id', $userOffer['job_id']);
			$jobTitle = $this->db->get('job');
			$jobTitle = $jobTitle->row('job_title');

			$userOffers[$index]['jobTitle'] = $jobTitle;
		}
		$data['userOffers'] = $userOffers;

		// echo "<pre>";
		// print_r($data);

		if(! empty($userOffers)) {

			return $this->load->view('internship/student/my_offers', $data);
		}
		$this->load->view('internship/student/my_offers');
	}

	public function accept_offer($jobId = 0)
	{
		$userId = $this->session->userdata('userid');

		if (! empty($userId)) {

			$data = ['status' => '1'];

			$acceptOffer = $this->db->where('user_id', $userId);
			$acceptOffer = $this->db->where('job_id', $jobId);
			$this->db->update('company_offer', $data);

			$message = 'Offer Accepted !';
			$this->session->set_flashdata('message', $message);			
		}

		redirect('internship/student/my_offers');
	}

	public function reject_offer($jobId = 0)
	{
		$userId = $this->session->userdata('userid');

		if (! empty($userId)) {

		$data = ['status' => '2'];

		$acceptOffer = $this->db->where('user_id', $userId);
		$acceptOffer = $this->db->where('job_id', $jobId);
		$this->db->update('company_offer', $data);

		$message = 'Offer Rejected !';
		$this->session->set_flashdata('message', $message);
		}

		redirect('internship/student/my_offers');
	}

}
 
?>
