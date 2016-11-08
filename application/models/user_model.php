<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class USER_MODEL extends CI_Model {
	public function CreateUser($username, $password, $role)
	{
		# code...
		$link = mysqli_connect("localhost", "root", "root", "plbtw");

		$data = array(
			'username' => mysqli_real_escape_string($link, $username),
			'password' => md5(mysqli_real_escape_string($link, $password)),
			'role' => strtolower(mysqli_real_escape_string($link, $role))
		);

		$this->db->insert('user', $data);
	}

	public function GetAllUser()
	{
		$query = $this->db->get('user');

		return $query->result();
	}
}
