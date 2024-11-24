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
		$this->load->model('User_model', 'sm');
		$this->user_menu = get_user_menu($this->session->userdata('role_id'));
		$this->username = $this->session->userdata('username');
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
			'role_id' => $this->session->userdata('role_id'),
			'user_data' => $this->sm->user_profile($this->username)
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
			'main_menu_' => 'Tambah Data',
			'content' => 'Form Input Barang',
			'main_menu' => $this->user_menu,
			'role_id' => $this->session->userdata('role_id'),
			'user_data' => $this->sm->user_profile($this->username)

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
			'main_menu_' => 'Tambah Data',
			'content' => 'Tabel Arrived',
			'csrf' => $this->csrf,
			'main_menu' => $this->user_menu,
			'role_id' => $this->session->userdata('role_id'),
			'user_data' => $this->sm->user_profile($this->username),

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
			'main_menu_' => 'Tambah Data',
			'content' => 'Tabel Received',
			'csrf' => $this->csrf,
			'main_menu' => $this->user_menu,
			'role_id' => $this->session->userdata('role_id'),
			'user_data' => $this->sm->user_profile($this->username),

		);
		$this->load->view('layouts/wrapper_top.php', $parse);
		$this->load->view('layouts/sidebar.php', $parse);
		$this->load->view('received', $parse);
	}
	
	public function form_csv()
	{
		$bln = get_name_month();
		$parse = array(
			'title' => 'Form CSV',
			'header' => 'Form CSV',
			'main_menu_' => 'Tambah Data',
			'content' => 'Filter Data',
			'csrf' => $this->csrf,
			'bln' => $bln,
			'main_menu' => $this->user_menu,
			'role_id' => $this->session->userdata('role_id'),
			'user_data' => $this->sm->user_profile($this->username),
		);
		// die_dump($parse);
		$this->load->view('layouts/wrapper_top.php', $parse);
		$this->load->view('layouts/sidebar.php', $parse);
		$this->load->view('form_csv', $parse);
	}
	function view_data_csv()
	{
		$status = $this->input->post('statuses');
		$statusArray = array_map('intval', explode(',', $status));
		// die_dump([$status,$statusArray]);
		$tgla = $this->input->post('tgla');
		$blna = $this->input->post('blna');
		$thna = $this->input->post('thna');
		$tgli = $this->input->post('tgli');
		$blni = $this->input->post('blni');
		$thni = $this->input->post('thni');
		$tgl_awal = date('Y-m-d', strtotime("$thna-$blna-$tgla"));
		$tgl_akhir = date('Y-m-d', strtotime("$thni-$blni-$tgli"));
		$data = $this->am->get_data_pengiriman_csv($statusArray, $tgl_awal, $tgl_akhir);
		// $this->load->view('layouts/wrapper_top.php', $parse);
		// $this->load->view('layouts/sidebar.php', $parse);
		$this->load->view('tabel_csv', ['data' => $data]);
	}
	public function export_data_csv()
	{
		// Ambil data yang dikirim melalui AJAX
		$data = json_decode($this->input->get('data'), true);

		if (empty($data)) {
			echo json_encode(['message' => 'No data to export']);
			return;
		}

		// Tentukan nama file CSV
		$filename = 'export_data_' . time() . '.csv';

		// Header untuk file CSV
		header('Content-Type: text/csv');
		header('Content-Disposition: attachment; filename="' . $filename . '"');
		header('Pragma: no-cache');
		header('Expires: 0');
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");

		// Mulai output CSV
		echo '"No","Bill","Deskripsi","Tanggal Kirim","Tanggal Tiba","Status"' . PHP_EOL; // Header CSV

		// Tulis data ke CSV
		foreach ($data as $index => $row) {
			// Menambahkan nomor urut di depan data
			echo '"' . ($index + 1) . '",';
			echo '"' . $row['bill'] . '",';
			echo '"' . $row['deskripsi'] . '",';
			echo '"' . $row['tgl_kirim'] . '",';
			echo '"' . $row['tgl_tiba'] . '",';
			echo '"' . $row['status'] . '"' . PHP_EOL;
		}
		log_message('info', 'Data received: ' . print_r($data, true));

		// Akhiri script untuk menghentikan pengolahan lebih lanjut
		exit;
	}
}
