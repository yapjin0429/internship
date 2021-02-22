<?php
 
class Company extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
	}

	/**
	 * View a company (recruiter) profile
	 *
	 * URL: company/view/{id}
	 */
	public function view($companyId = 0)
	{
		//get company 
		$this->db->where('id', $companyId);  	
		$query = $this->db->get('company');
		$company = $query->row_array();
		$data['company'] = $company;

		//get company profile
		$this->db->where('company_id', $companyId);  	
		$query = $this->db->get('company_profile');
		$company_profile = $query->row_array();
		$data['company_profile'] = $company_profile;

		$this->load->view('internship/company/view', $data);
	}
}

?>
