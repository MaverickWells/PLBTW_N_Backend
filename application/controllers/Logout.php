<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends CI_Controller {
	// public function _construct()
	// {
	// 	session_start();
	// }
	
	public function index()
	{
		$check = $this->session->userdata('username');
		if(empty($check)){	
			header("location:".base_url());
		}
		else{
			$this->session->sess_destroy();
			header("location:".base_url());
		}
		
	}
}
