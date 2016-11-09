<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class USER_MODEL extends CI_Model {
	public function CreateUser($data)
	{
		$this->db->insert('user', $data);
	}

	public function GetAllUser()
	{
		$query = $this->db->get('user');

		return $query->result();
	}

	public function DeleteUser($id)
	{
		$this->db->where('iduser', $id);
        $this->db->delete('user');
	}
}
