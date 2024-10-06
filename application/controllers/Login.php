<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
	protected $csrf;

	public function __construct()
	{
		parent::__construct();
		if (get_cookie('userId') !== null)
			redirect('beranda');
		$this->csrf = array(
			'name' => $this->security->get_csrf_token_name(),
			'hash' => $this->security->get_csrf_hash()
		);
		$this->load->model('User_model', 'us_model');
	}
	public function index()
	{
		$data = array(
			'title' => 'LOGIN',
			'csrf' => $this->csrf,
		);
		$this->load->view('layouts/wrapper_top.php');
		$this->load->view('login', $data);
	}
	public  function start_session()
	{
		$resp['status'] = false;
		$uname = $this->input->post('uname') ?? '';
		$upass = $this->input->post('upass') ?? '';
		$check_log = $this->us_model->check_session($uname);
		// die_dump($check_log);
		if ($check_log && password_verify($upass, $check_log->password)) {
			$resp['status'] = true;
			$cookie = array(
				'name' => 'userId',
				'value' => base64_encode($check_log->id),
				'expire' => '3600', // 1 hour
			);
			// die_dump($cookie);
			set_cookie($cookie);
		}
		$this->output->set_output(json_encode($resp));
	}
}
