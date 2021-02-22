<?php 
 
/**
 * 
 */
class Ajax extends CI_Controller
{
	
	public function index()
	{
		$this->load->view('ajax/tutorial');
	}

	public function todolist()
	{
		$this->load->view('ajax/todolist');
	}

	//handle request from ajax
	public function add_todo()
	{
		$response = [];

		$todo = $this->input->post('todo');

		//Insert Record
		$data['content'] = $todo;

		$success = $this->db->insert('test_todolist', $data);

		$todoId = $this->db->insert_id();

		if ($success) {
			$response['status'] = 1;
			$response['todoId'] = $todoId;

			$response['content'] = $todo;
		} 
		else {
			$response['status'] = 0;
		}

		echo json_encode($response);
	}

	//handle request from ajax
	public function delete_todo()
	{
		$todoId = $this->input->post('id');

		$delete = $this->db->where('id', $todoId);
		$delete = $this->db->delete('test_todolist');

		echo $todoId;
	}	

	public function fb()
	{
		$info = $this->db->get('fb');
		$info = $info->row_array();

		$data['fb'] = $info;

		$this->load->view('ajax/fb', $data);
	}

	public function edit()
	{
		$gender 	  = $this->input->post('gender');
		$birthdate  = $this->input->post('birthdate');
		$birthyear  = $this->input->post('birthyear');
		$languages  = $this->input->post('languages');
		$interested = $this->input->post('interested');

		if ($gender) {
			$data = ['gender' => $gender];
		}

		if ($birthdate) {
			$data = ['birthdate' => $birthdate];
		}

		if ($birthyear) {
			$data = ['birthyear' => $birthyear];
		}

		if ($languages) {
			$data = ['languages' => $languages];
		}

		if ($interested) {
			$data = ['interested' => $interested];
		}		
		$this->db->where('id', 1);
		$this->db->update('fb', $data);

	}
}