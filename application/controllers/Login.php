<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	public function _construct()
	{
		session_start();
	}
	
	public function index()
	{
		$check = $this->session->userdata('username');
		if(empty($check)){	
			$this->load->view('login_page');
		}
		else{
			header("location:".base_url()."index.php/admin");
		}
		
	}
}
