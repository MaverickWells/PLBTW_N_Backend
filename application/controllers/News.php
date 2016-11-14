<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News extends CI_Controller {

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
		$session = $this->session->userdata('username');
		if(empty($session)){
			header("location:".base_url());
		}
		else{
			$data = array('username' => $session, 'users' => $this->user_model->GetAllUser());
			$this->load->view('news_page', $data);
		}

	}

	public function insert()
	{
		$link = mysqli_connect("localhost", "root", "root", "plbtw");

		$data = array(
			'title' => mysqli_real_escape_string($link, $this->input->post('title')),
			'content' => mysqli_real_escape_string($link, $this->input->post('content')),
			'category' => mysqli_real_escape_string($link, $this->input->post('category')),
			'sub_category' => mysqli_real_escape_string($link, $this->input->post('sub-category')),
			'location' => mysqli_real_escape_string($link, $this->input->post('location')),
			'news_web' => mysqli_real_escape_string($link, $this->input->post('ori_site')),
			'news_url' => mysqli_real_escape_string($link, $this->input->post('ori_url')),
			'keyword' => mysqli_real_escape_string($link, $this->input->post('keyword')),
			// 'image' => strtolower(mysqli_real_escape_string($link, $this->input->post('roles')))
		);

		// $config['upload_path'] = "http://localhost/plbtw-backend/uploads";
		// $config['allowed_types'] = "gif|jpg|jpeg|png";
		// $config['max_size'] = "0";
		// $config['max_width'] = "0";
		// $config['max_height'] = "0";
		//
		// $this->upload->initialize($config);

		// var_dump($_FILES['image']);


		if ( ! $this->upload->do_upload('image'))
        {
                // $error = array('error' => $this->upload->display_errors());
				//
                // $this->load->view('upload_form', $error);

				var_dump($this->upload->display_errors());
        }
        else
        {
                // $data = array('upload_data' => $this->upload->data());
				//
                // $this->load->view('upload_success', $data);

				//var_dump($this->upload->data()['full_path']);

				$data['image'] = $this->upload->data()['full_path'];

				$this->news_model->CreateNews($data);
				redirect($this->agent->referrer());
        }

		// $this->news_model->CreateNews($data);
		// redirect($this->agent->referrer());


		// if($result > 0){
		// 	if($data['role'] == "developer"){
		// 		$md5 =  md5($data['username'].$data['password']);
		// 		$sha1 = sha1($md5);
		// 		$sha256 = hash('sha256', $sha1);
		// 		$sha512 = hash('sha512', $sha256);
		//
		// 		$api_key_data = array(
		// 			'iduser' => $this->db->insert_id(),
		// 			'user_api_key' => $sha512
		// 	 	);
		//
		// 		$api_key_result = $this->user_model->InsertAPIKEY($api_key_data);
		//
		// 		$data_api_key = array(
		// 			'api_key' => $sha512,
		// 			'username' => $data['username']
		// 		);
		//
		// 		if($api_key_result > 0){
		// 			$this->load->view('api_key', $data_api_key);
		// 		}
		// 		else{
		//
		//         }
		// 	}
		// 	else {
		// 		header("location:".base_url());
		// 	}
        // }
        // else{
			//header("location:".base_url());
        // }
	}

	public function delete($id)
	{
		// $this->user_model->DeleteNews($id);
		// header("location:".base_url());
	}

	public function update()
	{
		// $link = mysqli_connect("localhost", "root", "root", "plbtw");
		//
		// $data = array(
		// 	'username' => mysqli_real_escape_string($link, $this->input->post('username'))
		// );
		//
		// if(!empty($this->input->post('password'))){
		// 	$data['password'] = md5(mysqli_real_escape_string($link, $this->input->post('password')));
		// }
		//
		// $this->user_model->UpdateNews($data, $this->input->post('iduser'));
		// // var_dump($data);
		// header("location:".base_url());
	}

	public function edit($id)
	{
		// $session = $this->session->userdata('username');
		// if(empty($session)){
		// 	header("location:".base_url());
		// }
		// else{
		// 	$user = $this->user_model->GetUser($id);
		// 	$data = array('username' => $session,
		// 		'users' => $this->user_model->GetAllUser(),
		// 		'usern' => $user['username'],
		// 		'password' => $user['password'],
		// 		'iduser' => $user['iduser']
		// 	);
		//
		// 	// var_dump($data['user']);
		//
		// 	$this->load->view('admin_page', $data);
		// 	//header("location:".base_url());
		// }
	}
}
