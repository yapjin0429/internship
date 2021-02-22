<?php

class Job extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->helper('date');
	}

	// -----------------------------------------------------------------------
	// PUBLIC FUNCTIONS.
	// -----------------------------------------------------------------------

	/**
	 * View job.
	 * View a specific job by job ID.
	 *
	 * URL: /job/view/{id}
	 */
	public function view($jobId = 0)
	{
		// Check if the user is owner (recruiter) or student.
		// 		1. If the user is owner (recruiter), show `Edit` => URL: /job/edit/{id}
		// 				and `Delete` buttons. => URL: /job/delete/{id}
		// 		2. If the user is student, show `Apply Job` button. => URL: /job/apply/{id}

		if (empty($jobId)){
			show_404();
		}

		//Get job by jobId
		$this->db->where('id', $jobId);  
		$query = $this->db->get('job');
		$job = $query->row_array();

		if (empty($job)){
			show_404();
		}

		//Get owner of company
		$companyownerid = $job['company_id'];

		//Get owner of company information
		$this->db->where('id', $companyownerid);
		$query = $this->db->get('company');
		$companyinfo = $query->row_array();

		//Get owner of company profile
		$this->db->where('company_id', $companyownerid);
		$query = $this->db->get('company_profile');
		$company_profile  = $query->row_array();		

		//pass data to view file
		$data['job'] = $job;
		$data['company_info'] = $companyinfo;
		$data['company_profile'] = $company_profile;

		//-------------------------------------------------
		//Guest
		//...

		//Student
		$userID = $this->session->userdata('userid');

		$isStudent = false;
		$jobApplied = false;

		//check whether user is student
		if(! empty($userID)){

			$isStudent = true;

			$userJob = $this->db->where('user_id', $userID);
			$userJob = $this->db->where('job_id', $jobId);
			$userJob = $this->db->get('user_job');
			$userJob = $userJob->row_array();

			//check whether student already apply the job
			if(! empty($userJob)){
				$jobApplied = true;
			}
		}
		$data['isStudent'] = $isStudent;
		$data['jobApplied'] = $jobApplied;


		//Job Owner
		$companyownerid;
		//Recruiter
		$companyID = $this->session->userdata('companyid');

		$isowner = false;

		//Check whether user logged in as recruiter
		if(! empty($companyID)){
			//Check whether user is job owner
			if($companyownerid == $companyID){
				$isowner = true;
			}
		}
		$data['isowner'] = $isowner;

		$this->load->view('internship/job/view', $data);
	}

	// -----------------------------------------------------------------------
	// RECRUITER FUNCTIONS.
	// Only accessible by recruiters.
	// -----------------------------------------------------------------------

	/**
	 * Edit job.
	 * For recruiters edit their existing job post.
	 *
	 * URL: job/edit/{id}
	 */
	public function edit($jobId = 0)
	{
		// Check if user is `recruiter` and is the `owner`.

		if (empty($jobId)){
			show_404();
		}

		// Get job id
		$this->db->where('id', $jobId);  	
		$query = $this->db->get('job');
		$job = $query->row_array();

		if (empty($job)){
			show_404();
		}

		$data['job'] = $job;

		// Get the logged in company ID
		$companyId = $this->session->userdata('companyid');

		//Get company id from job
		$this->db->where('id', $jobId);
		$query = $this->db->get('job');
		$jobcompanyId = $query->row('company_id');

		if ($companyId != $jobcompanyId) {
			show_error('You are not allowed to edit this job.');
		}

		$this->form_validation->set_rules('job_title', 'job_title', 'required');
		$this->form_validation->set_rules('allowance', 'allowance', 'required');
		$this->form_validation->set_rules('location', 'location', 'required');
		$this->form_validation->set_rules('job_posting_date', 'job_posting_date', 'required');
		$this->form_validation->set_rules('job_posting_valid_until', 'job_posting_valid_until', 'required');
		$this->form_validation->set_rules('requirements', 'requirements', 'required');
		$this->form_validation->set_rules('responsibility', 'responsibility', 'required');

		if ($this->form_validation->run()) {
 
			$jobdata = 
			[
				'job_title'   						=> $this->input->post('job_title'),
				'allowance' 							=> $this->input->post('allowance'),
				'location'       					=> $this->input->post('location'),
				'job_posting_date'  			=> $this->input->post('job_posting_date'),
				'job_posting_valid_until' => $this->input->post('job_posting_valid_until'),
				'requirements'   					=> $this->input->post('requirements'),
				'responsibility'        => $this->input->post('responsibility'),				
			];
			$this->db->where('id', $jobId);
			$this->db->update('job', $jobdata);

			$message = 'Information Updated !';
			$this->session->set_flashdata('message', $message);

			redirect('internship/job/edit/'.$jobId); // Refresh data
		}

	  $this->load->view('internship/job/edit', $data);
	}

	/**
	 * Delete job.
	 * For recruiters delete their existing job post.
	 *
	 * URL: job/delete/{id}
	 */
	public function delete($jobId = 0)
	{
		// Get the logged in company ID
		$companyId = $this->session->userdata('companyid');

		//Get company id from job
		$this->db->where('id', $jobId);
		$query = $this->db->get('job');
		$jobcompanyId = $query->row('company_id');

		// // Get the user's role
		// $userRole = $this->db->where('user_id', $userId);
		// $userRole = $this->db->get('user_role');
		// $userRole = $userRole->row('role');

		// // Get the job owner id
		// $jobOwnerId = $this->db->where('id', $jobId);
		// $jobOwnerId = $this->db->get('job');
		// $jobOwnerId = $jobOwnerId->row('owner_id');

		// // Check if user == recruiter
		// if ($userRole != 'recruiter') {
		// 	show_error('Please login as recruiter to delete this job.');
		// }

		// Check if company == owner
		if ($companyId != $jobcompanyId) {
			show_error('You are not allowed to delete this job.');
		}

		// Select specific job
		$this->db->where('id', $jobId);

		// Execute deletetion
		$this->db->delete('job');

		redirect('internship/recruiter/my_jobs');
	}

	// -----------------------------------------------------------------------

	/**
	 * Add new job.
	 * For recruiters add their new job post.
	 *
	 * URL: job/add
	 */
	public function add()
	{
		$companyID = $this->session->userdata('companyid');

		if (empty($companyID)) {
			show_error('You are not allow to add job');
		}

		$this->form_validation->set_rules('job_title', 'job_title', 'required');
		$this->form_validation->set_rules('allowance', 'allowance', 'required');
		$this->form_validation->set_rules('location', 'location', 'required');
		$this->form_validation->set_rules('job_posting_date', 'job_posting_date', 'required');
		$this->form_validation->set_rules('job_posting_valid_until', 'job_posting_valid_until', 'required');
		$this->form_validation->set_rules('requirements', 'requirements', 'required');
		$this->form_validation->set_rules('responsibilities', 'responsibilities', 'required');		

		if ($this->form_validation->run()) {
			$data =
			[
				'company_id' 							=> $companyID,				
				'job_title' 							=> $this->input->post('job_title'),
				'allowance' 							=> $this->input->post('allowance'),
				'location' 								=> $this->input->post('location'),
				'job_posting_date' 				=> $this->input->post('job_posting_date'),
				'job_posting_valid_until' => $this->input->post('job_posting_valid_until'),					
				'requirements' 						=> $this->input->post('requirements'),
				'responsibility' 					=> $this->input->post('responsibilities')
			];
			$this->db->insert('job', $data);

			$message = 'Job Added !';
			$this->session->set_flashdata('message', $message);
		}

		$this->load->view('internship/job/add');
	}
	
	// -----------------------------------------------------------------------
	// STUDENT FUNCTIONS.
	// Only accessible by students.
	// -----------------------------------------------------------------------

	/**
	 * Apply job.
	 * For students to apply job and send email to recruiter.
	 *
	 * URL: job/apply/{id}
	 */
	public function apply($jobId = 0)
	{
		// Check if user is `student`.
		$userId = $this->session->userdata('userid');

		$job = $this->db->where('id', $jobId);
		$job = $this->db->get('job');
		$job = $job->row_array();

		$company = $this->db->where('id', $job['company_id']);
		$company = $this->db->get('company');
		$company = $company->row_array();

		$user = $this->db->where('user_id', $userId);
		$user = $this->db->get('user_profile');
		$user = $user->row_array();

		//print current date
		$datestring = '%Y-%m-%d';
		$time = time();			

		if(! empty($userId)){

			$data = 
			[
				'user_id' 	 => $userId,
				'company_id' =>	$job['company_id'],
				'job_id'		 => $jobId
			];
			$apply = $this->db->insert('user_job', $data);

		}

		if ($apply > 0) {

			//Email details
			$subject = " New Job Application Received For ".$job['job_title'];
			$message =
			"
			<p>Dear ".$company['name'].",</p>
			<p>We are pleased to inform you that you have received a new application for your posted job ".$job['job_title']." from ".$user['name']." on ".mdate($datestring, $time).". If you want to know more details, please follow the link: [link to student/my_jobs]</p>
			<p>Best regards</p>
			<p>XXX Team</p>
			";

			$config = array(
				'protocol'	=>	'smtp',
				'smtp_host'	=>	'senangprint.com',
				'smtp_port'	=>	587,
				'smtp_user'	=>	'dummy@senangprint.com',
				'smtp_pass'	=>	'belinked4u@1234',
				'mailtype'	=>	'html',
				'charset'		=>	'iso-8859-1',
				'wordwrap'	=>	TRUE
			);

			$this->load->library('email', $config);

			$this->email->set_newline("\r\n");
			$this->email->from('internship@senangprint.com');
			$this->email->to($company['email']);
			$this->email->subject($subject);
			$this->email->message($message);

			if ($this->email->send()) {

				$this->session->set_flashdata('message', 'Apply email successfully sent to the recruiter !');
			}
		}
		redirect('internship/student/my_jobs');
	}
 
}
?>
