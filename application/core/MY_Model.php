<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MY_Model extends CI_Model
{	
	public const DB_CORE = ENVIRONMENT == 'production' ? 'pengiriman_barang' : 'pengiriman_barang';
	public const PREFIX_ROLE_TABLE = ENVIRONMENT == 'production' ? 'm_role' : 'm_role';
	public const PREFIX_USER_TABLE = ENVIRONMENT == 'production' ? 'm_user' : 'm_user';

	function __construct()
	{
		parent::__construct();
		$this->load->dbforge();
		$this->load->database();
	}


}