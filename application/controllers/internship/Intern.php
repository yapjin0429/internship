<?php

class Intern extends CI_Controller
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
	 * View intern.
	 * For recruiter to view the intern profile.
	 *
	 * URL: intern/view/{id}
	 */
	public function view($studentId = 0)
	{
		// Check if the user is owner (student) or recruiter.
		//		Show static page only
		// 		1. If the user is owner (student), show `Edit` button. => URL: /student/profile
		// 		2. If the user is recruiter, show `Contact` => URL: /intern/contact/{id}
		// 				and `Save` buttons. => URL: /intern/save/{id}

		if (empty($studentId)){
			show_404();
		}

		//Get job by jobId
		$intern = $this->db->where('user_id', $studentId);  
		$intern = $this->db->get('user_profile');
		$intern = $intern->row_array();


		if (empty($intern)){
			show_404();
		}		

		$data['user_profile'] = $intern;

		//Recruiter
		$companyId = $this->session->userdata('companyid');

		//Student
		$userId = $this->session->userdata('userid');

		//Owner
		$owner = $intern['user_id'];

		$isRecruiter = false;
		$isSaved = false;

		$isOwner = false;

		//check company
		if (! empty($companyId)) {

			$isRecruiter = true;

			$userSaved = $this->db->where('company_id', $companyId);
			$userSaved = $this->db->where('user_id', $intern['user_id']);
			$userSaved = $this->db->get('company_saved_intern');
			$userSaved = $userSaved->row_array();

			$jobs = $this->db->where('company_id', $companyId);
			$jobs = $this->db->get('job');
			$jobs = $jobs->result_array();

			foreach ($jobs as $index => $job) {

				$isSent = false; //inside here because need to loop for every student

				$user_id = $this->db->where('job_id', $job['id']);
				$user_id = $this->db->get('company_offer');
				$user_id = $user_id->row('user_id');

				$jobs[$index]['user_id'] = $user_id;		

				if(! empty($user_id)){
					$isSent = true;
				}
				$jobs[$index]['isSent'] = $isSent;
				
			}								

			if(! empty($userSaved)){
				$isSaved = true;
			}		
		}
		$data['jobs'] = $jobs;		
		$data['isRecruiter'] = $isRecruiter;
		$data['isSaved'] = $isSaved;

		if (! empty($userId)) {

			if ($userId == $owner) {
				$isOwner = true;
			}
		}
		$data['isOwner'] = $isOwner;

		// echo "<pre>";
		// print_r($data);

		$this->load->view('internship/intern/view', $data);		
	}

	// -----------------------------------------------------------------------
	// RECRUITER FUNCTIONS.
	// Only accessible by recruiters.
	// -----------------------------------------------------------------------

	/**
	 * Contact the intern.
	 * For recruiters to contact the intern, send offer and email to the student.
	 *
	 * URL: intern/contact/{id}
	 */
	public function send_offer($jobId = 0)
	{
		// Check if user is `recruiter`. //email modal //notification modal
 
		//Recruiter
		$companyId = $this->session->userdata('companyid');

		//User
		$internId = $this->input->post('user_id');

		//Get intern details
		$intern = $this->db->where('user_id', $internId);
		$intern = $this->db->get('user_profile');
		$intern = $intern->row_array();

		//Get company details
		$company = $this->db->where('id', $companyId);
		$company = $this->db->get('company');
		$company = $company->row_array();		

		//Get job details
		$job = $this->db->where('id', $this->input->post('job_id'));
		$job = $this->db->get('job');
		$job = $job->row_array();

		//print current date
		$datestring = '%Y-%m-%d';
		$time = time();		
			
		//check for company and insert company offer
		if (! empty($companyId)) {

			$data = [ 'status' => '1' ];			

			$this->db->where('user_id', $this->input->post('user_id'));
			$this->db->where('job_id', $this->input->post('job_id'));
			$this->db->where('company_id', $companyId);	

			$offer = $this->db->update('user_job', $data);
		}

		if ($offer > 0) {

			//Email details
			$subject = " Job Offer from ".$company['name'];
			$message =
			"
			<p>Dear ".$intern['name'].",</p>
			<p>We are pleased to inform you that you have received an internship placement for ".$job['job_title']." from ".$company['name']." on ".mdate($datestring, $time).". If you want to know more details, please follow the link: [link to student/my_jobs]</p>
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
			$this->email->to($intern['email']);
			$this->email->subject($subject);
			$this->email->message($message);

			if ($this->email->send()) {		

				$this->session->set_flashdata('message', 'Offer email successfully sent to the intern !');
			}
		}
		redirect('internship/intern/view/'.$internId);
	}

	public function reject_offer($jobId = 0)
	{
		//Recruiter
		$companyId = $this->session->userdata('companyid');
			
		//check for company and insert company offer
		if (! empty($companyId)) {

			$data = ['status'  => '2'];

			$this->db->where('user_id', $this->input->post('user_id'));
			$this->db->where('job_id', $this->input->post('job_id'));
			$this->db->where('company_id', $companyId);

			$this->db->update('user_job', $data);

			$this->session->set_flashdata('message', 'Applicant Rejected !');
		}
		else{
			echo "invalid user for this function";
		}

		redirect('internship/recruiter/applicants');
	}	

	/**
	 * Save the intern.
	 * For recruiters to save the intern for later.
	 *
	 * URL: intern/save/{id}
	 */
	public function save($studentId = 0)
	{
		// Check if user is `recruiter`. //notification modal
		$companyId = $this->session->userdata('companyid');

		$intern = $this->db->where('id', $studentId);
		$intern = $this->db->get('user');
		$intern = $intern->row_array();

		if(! empty($companyId)){

			$data = 
			[
				'company_id' =>	$companyId,
				'user_id' 	 => $intern['id']
			];
			$this->db->insert('company_saved_intern', $data);

		}else{

			echo "invalid user to perform this function";
		}
		redirect('internship/listing/interns');
	}



}

?>
