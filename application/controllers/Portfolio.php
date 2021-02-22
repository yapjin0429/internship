<?php

class Portfolio extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
	}

	public function user_portfolio()
	{

		$userID = $this->session->userdata('userid');

		// Get user name to display on top
		$this->db->where('id', $userID);
		$query = $this->db->get('user');
		$user  = $query->row()->first_name;
		$data['user']= $user;

		// Get artwork
		$this->db->where('user_id', $userID);
		$query = $this->db->get('artwork');
		$artworks = $query->result_array();

		if (! empty($artworks)) {

			$data['artworks'] = $artworks;
			return $this->load->view('portfolio/user_portfolio', $data);
		}

		$this->load->view('portfolio/user_portfolio', $data);
	}

	public function view_artwork($artworkid = null)
	{
		//get user id
		$userID = $this->session->userdata('userid');

		//get specific artwork through id
		$this->db->where('id', $artworkid);  		//$query = $this->db->get_where('artwork', array('id' => $artworkid));
		$query = $this->db->get('artwork');
		$artwork = $query->row_array();
		$data['artwork'] = $artwork;

 		$this->form_validation->set_rules('comment', 'Comment', 'required');

 		if ($this->form_validation->run()) {

 			$Commentdata =
 			[
 			 'user_id' => $userID,
 			 'artwork_id' => $artworkid,
 			 'body' => $this->input->post('comment')
 			];
 			$this->db->insert('comment', $Commentdata);
 		}

 		// Get specific artwork comments
 		$this->db->where('artwork_id', $artworkid); // Target specific artwork id
 		$query = $this->db->get('comment'); // Get data from comment table
 		$comments = $query->result_array(); // Get result from the query in the format of array
 		// assign the result array to $comments variable

		// Get user
		foreach ($comments as $index => $comment) {

			$this->db->where('id', $comment['user_id']);
			$query = $this->db->get('user');
			$user = $query->row_array();

			$comments[$index]['user_first_name'] = $user['first_name'];
			$comments[$index]['user_last_name'] = $user['last_name'];
		}

		$data['comments'] = $comments;


		$this->load->view('portfolio/view_artwork', $data);
	}

	public function edit_artwork($artworkid = null)
	{
		// Get artwork
		$this->db->where('id', $artworkid);  		//$query = $this->db->get_where('artwork', array('id' => $artworkid));
		$query = $this->db->get('artwork');
		$artwork = $query->row_array();

		// Return artwork details to view file
		$data['artwork'] = $artwork;

		// Run form validation
		$this->form_validation->set_rules('artwork_title', 'title', 'required');
		$this->form_validation->set_rules('artwork_description', 'description', 'required');

		// If validated
		if ($this->form_validation->run()) {
			// Set default message as success
			$message = 'Artwork updated!';

			// Record updated artwork details
			$artworkData = [
				'artwork_title' 			=> $this->input->post('artwork_title'),
				'artwork_description' => $this->input->post('artwork_description')
			];

			// Upload artwork image
			if (!empty($_FILES['artwork']['name'])) {
				// Setup upload library
				$config['allowed_types'] = 'gif|jpg|png';
				$config['upload_path'] = './image/';

				// Load upload library
				$this->load->library('upload', $config);

				// Upload artwork image
				// If success uploaded
				if ($this->upload->do_upload('artwork')) {
					// Get upload data
					$filedata = $this->upload->data();

					// Record image filename to be insert into database
					$artworkData['artwork_image'] = base_url('image/' . $filedata['file_name']);
				}
				// Else, if fail to upload
				else {
					// Display upload error
					$message = $this->upload->display_errors();
					$this->session->set_flashdata('message', $message);
				}
			}

			// Update artwork
			$this->db->where('id', $artworkid);
			$this->db->update('artwork', $artworkData);

			// Set message
			$this->session->set_flashdata('message', $message);

			// Refresh artwork page
			redirect('portfolio/edit_artwork/'.$artworkid);
		}

		// Load the view file
		$this->load->view('portfolio/edit_artwork', $data);
	}

	public function upload_artwork()
	{
		$userID = $this->session->userdata('userid');

		$this->form_validation->set_rules('artwork_title', 'title', 'required');
		$this->form_validation->set_rules('artwork_description', 'description', 'required');

		if ($this->form_validation->run()) {

			$config['allowed_types'] = 'gif|jpg|png';
			$config['upload_path'] = './image/';

			$this->load->library('upload', $config);

			if ($this->upload->do_upload('artwork')) {

				$filedata = $this->upload->data();

				$data =
				[
					'user_id' 						=> $userID,
					'artwork_title' 			=> $this->input->post('artwork_title'),
					'artwork_description' => $this->input->post('artwork_description'),
					'artwork_image' 			=> base_url('image/' . $filedata['file_name']),
					// <img src="http://localhost/internship/image/cri.jpg">
				];
				$this->db->where('id', $userID);
				$this->db->insert('artwork', $data);

				$message = 'Artwork Updated !';
				$this->session->set_flashdata('message', $message);

			}else{
				$message = $this->upload->display_errors();
				$this->session->set_flashdata('message', $message);

			}
		}

		$this->load->view('portfolio/upload_artwork');
	}

}

?>
