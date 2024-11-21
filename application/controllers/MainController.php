<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MainController extends CI_Controller
{
	protected $csrf;

	public function __construct()
	{
		parent::__construct();
		if (get_cookie('userId') === null)
			redirect('login');
		$this->csrf = array(
			'name' => $this->security->get_csrf_token_name(),
			'hash' => $this->security->get_csrf_hash()
		);
		$this->load->model('Any_model', 'am');
		$this->user_menu = get_user_menu($this->session->userdata('role_id'));
		
	}
	public function logout()
	{
		// Ambil user ID dari session atau cookie
		$user_id = $this->session->userdata('user_id'); // Pastikan session ada

		if ($user_id) {
			// Update timestamp logout sebelum logout
			$this->us_model->update_logout($user_id);

			// Hapus session dan cookie
			$this->session->unset_userdata('user_id'); // Unset session
			delete_cookie('userId');
		}

		redirect('login'); // Redirect ke halaman login
	}
	public function index()
	{

		$parse = array(
			'title' => 'Pengiriman Barang',
			'header' => 'Pengiriman barang',
			'main_menu_' => 'Pengiriman barang',
			'content' => 'Data Barang',
			'csrf' => $this->csrf,
			'main_menu' => $this->user_menu,
		);
		$this->load->view('layouts/wrapper_top.php', $parse);
		$this->load->view('layouts/sidebar.php', $parse);
		$this->load->view('index', $parse);
	}

	public function form_input_barang()
	{

		$parse = array(
			'title' => 'Pengiriman Barang',
			'header' => 'Pengiriman barang',
			'main_menu' => 'Tambah Data',
			'content' => 'Form Input Barang',
			'main_menu' => $this->user_menu,

		);

		$today = date('Ymd');
		$last_bill = $this->am->generate_nomor_bill();
		$id_barang = !empty($this->am->generate_id_barang()) ? $this->am->generate_id_barang() : [];
		$error_message = '';
		if ($last_bill) {
			$last_sequence = substr($last_bill->bill, -3) + 1;
			if (strlen($last_sequence) >= 3) {
				$error_message = "Nomor bill sudah mencapai batas maksimum hari ini.";
				$new_sequence = '999'; // Tetap di 999 jika sudah mencapai batas maksimum
			} else {
				$bill = '---';
			}
			$new_sequence = str_pad($last_sequence, 3, '0', STR_PAD_LEFT);
			// die_dump($new_sequence);
			$bill = $today . '-' . $new_sequence;
		} else {
			$new_sequence = '001';
			$bill = $today . '-' . $new_sequence;
		}
		$data = array(
			'bill' => $bill,
			'error_message' => $error_message,
			'id_barang' => $id_barang,
			'csrf' => $this->csrf
		);
		$this->load->view('layouts/wrapper_top.php', $parse);
		$this->load->view('layouts/sidebar.php', $parse);
		$this->load->view('form_input_barang', $data);
	}
	public function arrived()
	{
		$parse = array(
			'title' => 'Arrived Data',
			'header' => 'Arrived Data',
			'main_menu' => 'Tambah Data',
			'content' => 'Tabel Arrived',
			'csrf' => $this->csrf,
			'main_menu' => $this->user_menu,

		);
		$this->load->view('layouts/wrapper_top.php', $parse);
		$this->load->view('layouts/sidebar.php', $parse);
		$this->load->view('arrived', $parse);
	}
	public function received()
	{
		$parse = array(
			'title' => 'Received Data',
			'header' => 'Received Data',
			'main_menu' => 'Tambah Data',
			'content' => 'Tabel Received',
			'csrf' => $this->csrf,
			'main_menu' => $this->user_menu,

		);
		$this->load->view('layouts/wrapper_top.php', $parse);
		$this->load->view('layouts/sidebar.php', $parse);
		$this->load->view('received', $parse);
	}
}
