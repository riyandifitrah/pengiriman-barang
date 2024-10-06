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
	}
	public function logout()
	{
		// $this->session->unset_userdata('user_id'); // Unset session
		delete_cookie('userId');
		redirect('login');
	}
	public function index()
	{
		$parse = array(
			'title' => 'Pengiriman Barang',
			'header' => 'Pengiriman barang',
			'main_menu' => 'Pengiriman barang',
			'content' => 'Data Barang',
			'csrf' => $this->csrf,
		);
		$this->load->view('layouts/wrapper_top.php', ['parse' => $parse]);
		$this->load->view('layouts/sidebar.php', ['parse' => $parse]);
		$this->load->view('index');
	}
	public function form_input_barang()
	{
		$parse = array(
			'title' => 'Pengiriman Barang',
			'header' => 'Pengiriman barang',
			'main_menu' => 'Tambah Data',
			'content' => 'Form Input Barang',
			
		);
		$csrf=$this->csrf;
		$today = date('Ymd');
		$last_bill = $this->am->generate_nomor_bill();
		$id_barang = !empty($this->am->generate_id_barang()) ? $this->am->generate_id_barang() : [];
		$error_message = '';
		if ($last_bill) {
            $last_sequence = substr($last_bill->bill, -3)+1;
			if (strlen($last_sequence) >= 3) {
				$error_message = "Nomor bill sudah mencapai batas maksimum hari ini.";
				$new_sequence = '999'; // Tetap di 999 jika sudah mencapai batas maksimum
			}
			else {
				$bill ='---';
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
		$this->load->view('layouts/wrapper_top.php', ['parse' => $parse]);
		$this->load->view('layouts/sidebar.php', ['parse' => $parse]);
		$this->load->view('form_input_barang', $data);
	}
}
