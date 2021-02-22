<?php

class Listing extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->helper('date');
	}
 
	/**
	 * Job Post List.
	 * Show all the latest job posts for students.
	 *
	 * URL: /listing/job-posting
	 */
	public function job_posting()
	{
		$userId = $this->session->userdata('userid');

		//Get all jobs
		$query = $this->db->get('job');
		$jobs = $query->result_array();

		$isStudent = false;

		if (! empty($userId)) {

			$isStudent = true;

			//Get the company who post the job
			foreach ($jobs as $index => $job) {

				$isApplied = false;
			
				//Use companyid to search the id in the company table			
				//Extract the specific company name out from the company table
				//Add the company name into the specific jobs array	

				$this->db->where('id', $job['company_id']);
				$query = $this->db->get('company');
				$company = $query->row('name');

				$jobs[$index]['name'] = $company;

				$this->db->where('company_id', $job['company_id']);
				$query = $this->db->get('company_profile');
				$logo = $query->row('company_logo');

				$jobs[$index]['logo'] = $logo;

				$jobApplied = $this->db->where('user_id', $userId);
				$jobApplied = $this->db->where('job_id', $job['id']);
				$jobApplied = $this->db->get('user_job');
				$jobApplied = $jobApplied->row_array();

				if(! empty($jobApplied)) {
					$isApplied = true;
				}
				$jobs[$index]['isApplied'] = $isApplied;							
			}
			$data['isStudent'] = $isStudent;		
			$data['jobs'] = $jobs;			
		}



		// Public accessible.
		// If the user is `student`, show `Apply Job` button. => URL: /job/apply/{id}
		$this->load->view('internship/listing/job_posting', $data);		
	}

	// -----------------------------------------------------------------------

	/**
	 * Intern List.
	 * Show all the active interns for recruiters.
	 *
	 * URL: /listing/interns
	 */
	public function interns()
	{
		// Public accessible.
		// If the user is `recruiter`, show `Contact` => URL: /intern/contact/{id}
		// and `Save` button. => URL: /intern/save/{id}

		//Get all interns
		$interns = $this->db->get('user_profile');
		$interns = $interns->result_array();

		$companyId = $this->session->userdata('companyid');

		$isRecruiter = false;		

		if (! empty($companyId)) {

			$isRecruiter = true;

			foreach ($interns as $index => $intern) { //Correct

				$isSaved = false;	
				
				$userBorn = mdate('%Y', strtotime($intern['date_of_birth']));
				$currentYear = mdate('%Y');

				$age = $currentYear - $userBorn;

				$interns[$index]['age'] = $age;

				$userSaved = $this->db->where('company_id', $companyId);
				$userSaved = $this->db->where('user_id', $intern['user_id']);
				$userSaved = $this->db->get('company_saved_intern');
				$userSaved = $userSaved->row_array();

				if(! empty($userSaved)) {
					$isSaved = true;
				}
				$interns[$index]['isSaved'] = $isSaved;		
			}			
		}
		$data['isRecruiter'] = $isRecruiter;
		$data['interns'] = $interns;

		// echo "<pre>";
		// print_r($data);

		// foreach ($interns as $index => $intern) { //Wrong

		// 	$test = $this->db->get('user_profile');
		// 	$test = $test->row('date_of_birth');

		// 	$userBorn = mdate('%Y', strtotime($test));
		// 	$currentYear = mdate('%Y');

		// 	print_r($userBorn);
		// 	print_r($currentYear);
		// 	$age = $currentYear - $userBorn;

		// 	$interns[$index]['age'] = $age;
		// }
		// $data['interns'] = $interns;
			
		$this->load->view('internship/listing/interns', $data);		
	}
}

?>
