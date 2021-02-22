<?php 

class Register_model extends CI_Model
{
	
	function insert($data)
	{
		$this->db->insert('user', $data);
		return $this->db->insert_id();
	}

	function verify_email($key)
	{
		$this->db->where('activation_code', $key);
		$this->db->where('active', '0');
		$query = $this->db->get('user');

		if ($query->num_rows() > 0) {

			$data = array(
				'active'	=> '1',
				'activation_code' => null
			);
			$this->db->where('activation_code', $key);
			$this->db->update('user', $data);
			
			return true;
		}
		return false;
	}
}

?>