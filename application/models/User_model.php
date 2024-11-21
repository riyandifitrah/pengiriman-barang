<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends MY_Model
{
	public function __construct()
	{
		// load library database
		parent::__construct();
	}

	public function check_session($username)
	{
		$this->db->select('ms.*, mr.role_name, mr.role_level')
			->from(static::PREFIX_USER_TABLE . ' as ms')
			->join(static::PREFIX_ROLE_TABLE . ' as mr', 'ms.role_id = mr.role_level', 'INNER')
			->where('ms.username', $username);
		// ->where('mr.role_level', $role_level)
		// ->where('mr.role_name', $role_name);
		$resp = $this->db->get()->row();
		return $resp ? $resp : '';
	}
	public function user_profile($username){
		$this->db->select('ms.*, mr.*')
			->from(static::PREFIX_USER_TABLE . ' as ms')
			->join(static::PREFIX_ROLE_TABLE . ' as mr', 'ms.role_id = mr.role_level', 'INNER')
			->where('ms.username', $username);
		$resp = $this->db->get()->row();
		return $resp ? $resp :'';
	}
	public function update_login($id)
	{
		
		$data = array(
			'login_start' => date('Y-m-d H:i:s'),
			'login_notes' => 1
		);
		$this->db->where('id', $id);
		$this->db->update(static::PREFIX_USER_TABLE, $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	public function update_logout($id)
	{
		
		$data = array(
			'login_last' => date('Y-m-d H:i:s'),
			'login_notes' => 0
		);
		$this->db->where('id', $id);
		$this->db->update(static::PREFIX_USER_TABLE, $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
}
