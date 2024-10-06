<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MY_Jquery extends CI_Controller
{
	protected $csrf;

	public function __construct()
	{
		parent::__construct();
        // if (get_cookie('userId') === null)
		// 	redirect('login');
		$this->csrf = array(
			'name' => $this->security->get_csrf_token_name(),
			'hash' => $this->security->get_csrf_hash()
		);

	}
}
