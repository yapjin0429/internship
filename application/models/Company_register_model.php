<?php 

class Company_register_model extends CI_Model
{
	
	function insert($data)
	{
		$this->db->insert('company', $data);
		return $this->db->insert_id();
	}

	function verify_email($key)
	{
		$this->db->where('activation_code', $key);
		$this->db->where('active', '0');
		$query = $this->db->get('company');

		if ($query->num_rows() > 0) {

			$data = array(
				'active'	=> '1',
				'activation_code' => null
			);
			$this->db->where('activation_code', $key);
			$this->db->update('company', $data);
			
			return true;
		}
		return false;
	}
}

?>