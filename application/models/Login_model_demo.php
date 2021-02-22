<?php 

class Login_model extends CI_model
{
	
	public function can_login($email, $password)
	{
		$this->db->where('email', $email);
		$query = $this->db->get('user');

		if ($query->num_rows() > 0) {
			$user = $query->row_array();

			// 1. Verify if user is active
			if ($user['active'] == '0') { // If user not active (value=0)
				return 'First verified your email address'; // If return used, script execution is ended.
			}

			// 2. Verify if password correct
			$store_password = $this->encryption->decrypt($user['password']);
			if ($password == $store_password) { // If password match
				$this->session->set_userdata('id', $row->id);
				return true;
			}

			return 'Wrong Password';
		}

		return "Wrong Email Address";
	}

	// Sample for pseudocode
	public function change_password($old_password, $new_password)
	{
		// 1. Get the current user id
		$userId = $this->session->userdata('id');

		// 2. Search the real password from db
		$user = $this->db->where('id', $userId);
		$user = $this->db->get('user');
		$user = $user->row_array();

		// 3. Compare with old password
		// If not match, return false
		if ($user['password'] != $old_password) {
			return false;
		}

		// 4. Update the user password
		$data['password'] = $new_password;

		$this->db->where('id', $userId);
		$this->db->update('user', $data);
	}
	
}

?>