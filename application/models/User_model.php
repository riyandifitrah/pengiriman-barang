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
		$this->db->select('ms.*, mr.*')
			->from(static::PREFIX_USER_TABLE . ' as ms')
			->join(static::PREFIX_ROLE_TABLE . ' as mr', 'ms.role_id = mr.role_level', 'INNER')
			->where('ms.username', $username);
			// ->where('mr.role_level', $role_level)
			// ->where('mr.role_name', $role_name);
		$resp = $this->db->get()->row();
		return $resp ? $resp : ['NULL'];
	}


}