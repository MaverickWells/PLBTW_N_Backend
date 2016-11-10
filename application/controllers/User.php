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

		$this->user_model->CreateUser($data);
		header("location:".base_url());
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
