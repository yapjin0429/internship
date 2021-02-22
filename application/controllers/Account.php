<?php

class Account extends CI_Controller
{

	public function __construct()				//constructor
	{
		parent::__construct();	//library that loaded for this controller
		$this->load->library('form_validation');
		$this->load->library('encryption');
		$this->load->model('register_model');
		$this->load->model('login_model');
	}

	public function login()	//login method
	{
		$this->form_validation->set_rules('user_email', 'email', 'required|trim|valid_email');
		$this->form_validation->set_rules('user_password', 'password', 'required');

		if ($this->form_validation->run()) {

			$result = $this->login_model->can_login(
				$this->input->post('user_email'),
				$this->input->post('user_password')
			);

			if ($result == 'true') {

			redirect('portfolio/user_portfolio');
			}
			else{

				$this->session->set_flashdata('message', $result);
				redirect('account/login');
			}
		}

		$this->load->view('account/login');
	}

	public function logout() //TODO
	{
		$this->session->sess_destroy();
		redirect('account/login');
	} 

	public function register()	//register method
	{
		$this->form_validation->set_rules('first_name', 'first name', 'required');
		$this->form_validation->set_rules('last_name', 'last name', 'required');
		$this->form_validation->set_rules('user_email', 'email', 'required|valid_email|is_unique[user.email]');
		$this->form_validation->set_rules('user_password', 'password', 'required');
		$this->form_validation->set_rules('confirm_password', 'password', 'required|matches[user_password]');

		if ($this->form_validation->run()) {

			$verification_key 	= md5(rand());
			$encrypted_password = $this->encryption->encrypt($this->input->post('user_password'));

			$data = array(
				'first_name' 			=> 	$this->input->post('first_name'),
				'last_name' 			=>	$this->input->post('last_name'),
				'email' 					=> 	$this->input->post('user_email'),
				'password' 				=> 	$encrypted_password,
				'activation_code' => 	$verification_key
			);

			$id = $this->register_model->insert($data);

			if ($id > 0) {
				$subject = "Please verify email for login";
				$message =
				"
				<p>Hi ".$this->input->post('first_name')."</p>
				<p>This is an email verification mail. To verify, click this <a href='".base_url()."account/verify_email/".$verification_key."'>link</a>.</p>
				<p>Once clicked, your email will be verified and able to login</p>
				<p>Thanks</p>
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
				$this->email->from('info@senangprint.com');
				$this->email->to($this->input->post('user_email'));
				$this->email->subject($subject);
				$this->email->message($message);

				if ($this->email->send()) {

					$this->session->set_flashdata('message', 'Success ! Kindly check your email for verification mail');
					redirect('account/register');
				}
			}
		}

		$this->load->view('account/register');		//load view page
	}

	public function verify_email($key = null)		//verify email method
	{
		if ($key) {

			if ($this->register_model->verify_email($key)) {

				$data['message'] =
				'
				<h1 align="center">Your Email has been succesfully verified, now you can login from <a href="'.base_url().'account/login">here</a><h1>
				';
			}
			else{

				$data['message'] = '<h1 align="center">Invalid Link</h1>';
			}

			$this->load->view('account/email_verification', $data);
		}
	}

	public function forgot_password()
	{
		$this->form_validation->set_rules('user_email', 'email', 'required|trim|valid_email');

		$email = $this->input->post('user_email');

		if ($this->form_validation->run()) {

			$this->db->where('email', $email);
			$query = $this->db->get('user');

			if ($query->num_rows() > 0) {

				$resetcode = md5(rand());

				// Update user reset code
				$data = array('password_reset_code' => $resetcode);
				$this->db->where('email', $email);
				$this->db->update('user', $data);

				// Prepare email content
				$subject = "Password Reset Link";
				$message = "
				<p>Hi ".$this->input->post('user_email')."</p>
				<p>This is an reset password mail. To verify, click this <a href='".base_url()."account/reset_password/".$resetcode."'>link</a>.</p>
				<p>Once clicked, your will able to reset your password</p>
				<p>Thanks</p>
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
				$this->email->from('info@senangprint.com');
				$this->email->to($this->input->post('user_email'));
				$this->email->subject($subject);
				$this->email->message($message);

				if ($this->email->send()) {

					$successmessage = 'Success ! Kindly check your email for reset password mail !';
					$this->session->set_flashdata('message', $successmessage);

					redirect('account/forgot_password');
				}

			}
			else {

				$errormessage = 'Invalid Email Address';
				$this->session->set_flashdata('message', $errormessage);
			}
		}
  	$this->load->view('account/forgot_password');
  }

  public function reset_password($resetcode = null)
  {
  	$this->form_validation->set_rules('user_password', 'password', 'required');
		$this->form_validation->set_rules('confirm_password', 'password', 'required|matches[user_password]');

		if ($this->form_validation->run()) {

			$this->db->where('password_reset_code', $resetcode);
			$query = $this->db->get('user');

			if ($query->num_rows() > 0) {

				// Hash the new password
			  $newpassword = $this->encryption->encrypt($this->input->post('user_password'));

				// Update user password
				$data = array(
					'password' => $newpassword,
					'password_reset_code' => null
				);
				$this->db->where('password_reset_code', $resetcode);
				$this->db->update('user', $data);

				// Return success message
				$successmessage = 'Password Successfully Updated ! Try To Login Now !';
				$this->session->set_flashdata('message', $successmessage);

				// Redirect to login page
				redirect('account/login');
			}
		}

		$data = [
			'code' => $resetcode
		];

  	$this->load->view('account/reset_password', $data);
  }

}

?>
