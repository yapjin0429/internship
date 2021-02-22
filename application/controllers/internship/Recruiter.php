<?php

/**
 * Recruiter Dashboard
 */
class Recruiter extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->helper('date');
	}

	/**
	 * View or edit profile
	 *
	 * URL: recruiter/profile
	 */
	public function profile()
	{
		$companyID = $this->session->userdata('companyid');

		// Get company
		$this->db->where('id', $companyID);
		$query = $this->db->get('company');
		$company  = $query->row_array();

		// Get company profile
		$this->db->where('company_id', $companyID);
		$query   = $this->db->get('company_profile');
		$profile = $query->row_array();	

		$this->form_validation->set_rules('company_name', 'name', 'required');
		$this->form_validation->set_rules('nature_of_business', 'nature_of_business', 'required');
		$this->form_validation->set_rules('company_type', 'type', 'required');
		$this->form_validation->set_rules('company_size', 'size', 'required');
		$this->form_validation->set_rules('working_hour', 'working_hour', 'required');

		if ($this->form_validation->run()) {

			$company_name = ['name' => $this->input->post('company_name')];
			$this->db->where('id', $companyID);
			$this->db->update('company', $company_name);					

			$data =
			[
				'nature_of_business' 	=> $this->input->post('nature_of_business'),
				'company_type' 				=> $this->input->post('company_type'),
				'company_size' 				=> $this->input->post('company_size'),
				'working_hour' 				=> $this->input->post('working_hour')
			];

			if (! empty($_FILES['company_logo']['name'])) {

				$config['allowed_types'] = 'gif|jpg|png';
				$config['upload_path'] = './image/company_logo/';

				$this->load->library('upload', $config);

				if ($this->upload->do_upload('company_logo')) {

					$filedata = $this->upload->data();
					$data['company_logo'] = base_url('image/company_logo/' . $filedata['file_name']);	

				}
				else{
					$message = $this->upload->display_errors();
					$this->session->set_flashdata('message', $message);		
				}									
			}

			if (! empty($profile)) {

				$this->db->where('company_id', $companyID);
				$this->db->update('company_profile', $data);
			} 
			else{			

				$data['company_id'] = $companyID;

			  $this->db->where('company_id', $companyID);
				$this->db->insert('company_profile', $data);					
			}

			$message = 'Information Updated !';
			$this->session->set_flashdata('message', $message);

			redirect('internship/recruiter/profile'); // Refresh data				
		}

		$data = [
			'name' 			 					=> $company['name'],
			'nature_of_business'  => $profile['nature_of_business'] ?? '',
			'company_type' 				=> $profile['company_type'] ?? '',
			'company_size'     		=> $profile['company_size'] ?? '',
			'working_hour'     		=> $profile['working_hour'] ?? '',
			'company_logo'				=> $profile['company_logo'] ?? ''
		];		

		$this->load->view('internship/recruiter/profile', $data);
	}

	/**
	 * My Jobs.
	 * Show all the jobs posted by the recruiter.
	 *
	 * URL: recruiter/my-jobs
	 */
	public function my_jobs()
	{
		$companyID = $this->session->userdata('companyid');
 
		// Get job
		$this->db->where('company_id', $companyID);
		$query = $this->db->get('job');
		$jobs = $query->result_array();

		foreach ($jobs as $index => $job) {
			$query = $this->db->where('job_id', $job['id']);
			$query = $this->db->get('user_job');

			$applicants = $query->result_array();
			$jobs[$index]['applicants'] = $applicants;

			$applicantsNo = $query->num_rows('user_id');
			$jobs[$index]['applicantsNo'] = $applicantsNo;	
		}

		// echo "<pre>";
		// print_r($jobs);
		if (! empty($jobs)) {

			$data['jobs'] = $jobs;
			// echo "<pre>";
			// print_r($data);
			return $this->load->view('internship/recruiter/my_jobs', $data);		
		}

		$this->load->view('internship/recruiter/my_jobs');		
	}

	/**
	 * My Offers.
	 * Show all the offers sent to the students.
	 *
	 * URL: recruiter/my-offers
	 */
	public function my_offers()
	{
		$companyId = $this->session->userdata('companyid');
 
		// Get offers
		$offers = $this->db->where('company_id', $companyId);
		$offers = $this->db->get('company_offer');
		$offers = $offers->result_array();

		foreach ($offers as $index => $offer) {

			$query1 				= $this->db->where('id', $offer['job_id']);
			$query1 				= $this->db->get('job');

			$job_title 			= $query1->row('job_title');

			$offers[$index]['job_title'] = $job_title;

			$query2 			= $this->db->where('user_id', $offer['user_id']);
			$query2				= $this->db->get('user_profile');

			$name 				 = $query2->row('name');

			$offers[$index]['name'] = $name;
		}

		$data['offers'] = $offers;

		$this->load->view('internship/recruiter/my_offers', $data);
	}

	/**
	 * Applicants.
	 * Show all the applicant (student) requests.
	 *
	 * URL: recruiter/applicants
	 */
	public function applicants()
	{
		$companyId = $this->session->userdata('companyid');
 
		// Get student requests
		$applicants = $this->db->where('company_id', $companyId);
		$applicants = $this->db->get('user_job');
		$applicants = $applicants->result_array();

		foreach ($applicants as $index => $applicant) {

		$query1 				= $this->db->where('user_id', $applicant['user_id']);
		$query1 				= $this->db->get('user_profile');

		$name 					= $query1->row('name');
		$institution		= $query1->row('institution');
		$program 			  = $query1->row('program');
		$preferLocation = $query1->row('prefer_location');
		$dob 						= $query1->row('date_of_birth');

		$userBorn 	 = mdate('%Y', strtotime($dob));
		$currentYear = mdate('%Y');
		$age         = $currentYear - $userBorn;

		$applicants[$index]['name'] 					 = $name;
		$applicants[$index]['institution']	 	 = $institution;
		$applicants[$index]['program'] 			   = $program;			
		$applicants[$index]['preferLocation']  = $preferLocation;
		$applicants[$index]['age'] 						 = $age;

		$query2 					= $this->db->where('id', $applicant['job_id']);
		$query2 					= $this->db->get('job');

		$jobTitle         = $query2->row('job_title');

		$applicants[$index]['job_title'] 						 = $jobTitle;
		}

		$data['applicants'] = $applicants;		

		// echo "<pre>";
		// print_r($data);

		$this->load->view('internship/recruiter/applicants', $data);
	}

	/**
	 * Intern List.
	 * Show all the interns (student) bookmarked by the recruiter.
	 *
	 * URL: recruiter/saved-interns
	 */
	public function saved_interns()
	{
		$companyId = $this->session->userdata('companyid');
 
		// Get interns
		$interns = $this->db->where('company_id', $companyId);
		$interns = $this->db->get('company_saved_intern');
		$interns = $interns->result_array();

		foreach ($interns as $index => $intern) {

			$query 					= $this->db->where('user_id', $intern['user_id']);
			$query 					= $this->db->get('user_profile');

			$name 					= $query->row('name');
			$institution		= $query->row('institution');
			$program 			  = $query->row('program');
			$preferLocation = $query->row('prefer_location');
			$dob 						= $query->row('date_of_birth');

			$userBorn = mdate('%Y', strtotime($dob));
			$currentYear = mdate('%Y');
			$age = $currentYear - $userBorn;

			$interns[$index]['name'] 					 = $name;
			$interns[$index]['institution']	 	 = $institution;
			$interns[$index]['program'] 			 = $program;			
			$interns[$index]['preferLocation'] = $preferLocation;
			$interns[$index]['age'] = $age;
		}

		if (! empty($interns)) {

			$data['interns'] = $interns;
			return $this->load->view('internship/recruiter/saved_interns', $data);		
		}

		$this->load->view('internship/recruiter/saved_interns');
	}

	public function job_applicants($jobId = 0)
	{
		// Get job
		$job = $this->db->where('id', $jobId);
		$job = $this->db->get('job');
		$job = $job->row_array();

		$query = $this->db->where('job_id', $job['id']);
		$query = $this->db->get('user_job');

		$applicants = $query->result_array();

		foreach ($applicants as $index => $applicant) {

			$query 					= $this->db->where('user_id', $applicant['user_id']);
			$query 					= $this->db->get('user_profile');

			$name 					= $query->row('name');
			$institution		= $query->row('institution');
			$program 			  = $query->row('program');
			$preferLocation = $query->row('prefer_location');
			$dob 						= $query->row('date_of_birth');

			$userBorn = mdate('%Y', strtotime($dob));
			$currentYear = mdate('%Y');
			$age = $currentYear - $userBorn;

			$applicants[$index]['name'] 					= $name;
			$applicants[$index]['institution']	 	= $institution;
			$applicants[$index]['program'] 			  = $program;			
			$applicants[$index]['preferLocation'] = $preferLocation;
			$applicants[$index]['age'] 						= $age;
		}		

		$data['applicants'] = $applicants;
		$data['job'] = $job;

		// echo "<pre>";
		// print_r($data);

		$this->load->view('internship/recruiter/job_applicants', $data);
	}

	public function activate_job($jobId = 0)
	{
		$companyId = $this->session->userdata('companyid');

		if (! empty($companyId)) {

			$data = ['status' => '1'];

			$this->db->where('id', $jobId);
			$this->db->update('job', $data);
		}
		redirect('internship/recruiter/my_jobs');
	}

	public function deactivate_job($jobId = 0)
	{
		$companyId = $this->session->userdata('companyid');

		if (! empty($companyId)) {

			$data = ['status' => '2'];

			$this->db->where('id', $jobId);
			$this->db->update('job', $data);
		}
		redirect('internship/recruiter/my_jobs');
	}
	
}

?>
