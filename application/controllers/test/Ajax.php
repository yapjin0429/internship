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
		$lists = $this->db->get('test_todolist');
		$lists = $lists->result_array();

		$data['lists'] = $lists;

		$this->load->view('ajax/todolist', $data);
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

	//handle request from ajax
	public function edit_todo()
	{
		$todoId = $this->input->post('id');
		$content = $this->input->post('content');

		echo $content;
		echo $todoId;

		$data['content'] = $content;

		$this->db->where('id', $todoId);
		$this->db->update('test_todolist', $data);

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

		//handle request from ajax
	public function add_comment($artworkId = 0)
	{
		$comment = $this->input->post('comment');
		$userId = $this->session->userdata('userid');

		if (! empty($comment)) {
			$data = 
			[
					'user_id' => $userId,
					'artwork_id' => $artworkId,
					'body' => $comment,
			];
			$this->db->insert('comment', $data);
			$id = $this->db->insert_id();
		}

		$response['id'] = $id;
		$response['content'] = $comment;

		$user = $this->db->where('id', $userId);
		$user = $this->db->get('user');
		$userFirstName = $user->row('first_name');
		$userLastName = $user->row('last_name');

		$response['userFirstName'] = $userFirstName;
		$response['userLastName'] = $userLastName;


		$createdAt = $this->db->where('id', $id);
		$createdAt = $this->db->get('comment');
		$createdAt = $createdAt->row('created_at');

		$response['createdAt'] = $createdAt;

 		echo json_encode($response);
	}

	//handle request from ajax
	public function delete_comment()
	{
		$commentId = $this->input->post('id');

		$delete = $this->db->where('id', $commentId);
		$delete = $this->db->delete('comment');
	}

	//handle request from ajax
	public function edit_comment()
	{
		$id = $this->input->post('id');
		$content = $this->input->post('comment');

		echo $content;
		echo $todoId;

		$data['body'] = $content;

		$this->db->where('id', $id);
		$this->db->update('comment', $data);		
	}
}