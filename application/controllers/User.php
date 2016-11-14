<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		// $session = $this->session->userdata('username');
		// if(empty($session)){
		// 	header("location:".base_url());
		// }
		// else{
		// 	$data = array('username' => $session, 'users' => $this->user_model->GetAllUser());
		// 	$this->load->view('admin_page', $data);
		// }

	}

	public function insert()
	{
		$link = mysqli_connect("localhost", "root", "root", "plbtw");

		$data = array(
			'username' => mysqli_real_escape_string($link, $this->input->post('username')),
			'password' => md5(mysqli_real_escape_string($link, $this->input->post('password'))),
			'role' => strtolower(mysqli_real_escape_string($link, $this->input->post('roles')))
		);

		$result = $this->user_model->CreateUser($data);


		if($result > 0){
			if($data['role'] == "developer"){
				$md5 =  md5($data['username'].$data['password']);
				$sha1 = sha1($md5);
				$sha256 = hash('sha256', $sha1);
				$sha512 = hash('sha512', $sha256);

				$api_key_data = array(
					'iduser' => $this->db->insert_id(),
					'user_api_key' => $sha512
			 	);

				$api_key_result = $this->user_model->InsertAPIKEY($api_key_data);

				$data_api_key = array(
					'api_key' => $sha512,
					'username' => $data['username']
				);

				if($api_key_result > 0){
					$this->load->view('api_key', $data_api_key);
				}
				else{

		        }
			}
			else {
				header("location:".base_url());
			}
        }
        else{
			header("location:".base_url());
        }
	}

	public function delete($id)
	{
		$this->user_model->DeleteUser($id);
		header("location:".base_url());
	}

	public function update()
	{
		$link = mysqli_connect("localhost", "root", "root", "plbtw");

		$data = array(
			'username' => mysqli_real_escape_string($link, $this->input->post('username'))
		);

		if(!empty($this->input->post('password'))){
			$data['password'] = md5(mysqli_real_escape_string($link, $this->input->post('password')));
		}

		$this->user_model->UpdateUser($data, $this->input->post('iduser'));
		// var_dump($data);
		header("location:".base_url());
	}

	public function edit($id)
	{
		$session = $this->session->userdata('username');
		if(empty($session)){
			header("location:".base_url());
		}
		else{
			$user = $this->user_model->GetUser($id);
			$data = array('username' => $session,
				'users' => $this->user_model->GetAllUser(),
				'usern' => $user['username'],
				'password' => $user['password'],
				'iduser' => $user['iduser']
			);

			// var_dump($data['user']);

			$this->load->view('admin_page', $data);
			//header("location:".base_url());
		}
	}
}
