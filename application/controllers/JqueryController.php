<?php
defined('BASEPATH') or exit('No direct script access allowed');

class JqueryController extends CI_Controller
{
	protected $csrf;

	public function __construct()
	{
		parent::__construct();
		$this->csrf = array(
			'name' => $this->security->get_csrf_token_name(),
			'hash' => $this->security->get_csrf_hash()
		);
		$this->load->model('Any_model', 'any_model');
	}
	public function post_pengiriman()
	{
		// Ambil data POST
		$id_barang = $this->input->post('id_barang');
		$bill_landing = $this->input->post('bill_landing');
		$deskripsi_barang = $this->input->post('deskripsi_barang');
		$status_barang = $this->input->post('status_barang');
		$port = $this->input->post('port');
		$tanggal_barang = $this->input->post('tanggal_barang');
		$waktu_barang = $this->input->post('waktu_barang');

		// Validasi data jika perlu
		// Misalnya: pastikan tidak ada field yang kosong
		if (empty($id_barang) || empty($bill_landing) || empty($deskripsi_barang) || empty($status_barang) || empty($port) || empty($tanggal_barang) || empty($waktu_barang)) {
			echo json_encode(['status' => 'error', 'message' => 'Semua field harus diisi.']);
			return;
		}

		// Siapkan data untuk disimpan
		$data = [
			'id_barang' => $id_barang,
			'bill' => $bill_landing,
			'deskripsi' => $deskripsi_barang,
			'status' => $status_barang,
			'port' => $port,
			'tgl' => $tanggal_barang,
			'waktu' => $waktu_barang
		];

		// Simpan ke database
		if ($this->any_model->insert_form_pengiriman($data)) {
			echo json_encode(['status' => 'success', 'message' => 'Data berhasil disimpan']);
		} else {
			echo json_encode(['status' => 'error', 'message' => 'Gagal menyimpan data.']);
		}
	}

	// public function insert_pengiriman($data)
	// {
	// 	return $this->db->insert('pengiriman', $data); // Ganti 'pengiriman' dengan nama tabel yang sesuai
	// }
}
