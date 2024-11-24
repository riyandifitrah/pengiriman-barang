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
			'waktu' => $waktu_barang,
			'created_at' => date('Y-m-d H:i:s')
		];

		// Simpan ke database
		if ($this->any_model->insert_form_pengiriman($data)) {
			echo json_encode(['status' => 'success', 'message' => 'Data berhasil disimpan']);
		} else {
			echo json_encode(['status' => 'error', 'message' => 'Gagal menyimpan data.']);
		}
	}
	function get_detail_user()
	{
		$start = $this->input->get('start');
		$length = $this->input->get('length');
		$order_column = $_GET['order'][0]['column'];
		$order_dir = $_GET['order'][0]['dir'];
		$search_value = $_GET['search']['value'];
		$status_filter = $this->input->get('status');  // Dapatkan parameter status jika ada
		$columns = ['username', 'role_id', 'login_notes', 'login_last', 'login_start'];
		$this->db->from('m_user');
		if (!empty($status_filter)) {
			$this->db->where('status', $status_filter);  // Filter berdasarkan status
		}
		$total_data = $this->db->count_all_results();
		$this->db->select('*');
		$this->db->from('m_user');
		$this->db->where_not_in('username', ['root']);
		$this->db->where_not_in('role_id', [5]);

		if (!empty($search_value)) {
			$this->db->group_start();
			$this->db->like('username', $search_value);
			$this->db->or_like('role_id', $search_value);
			$this->db->or_like('login_notes', $search_value);
			$this->db->or_like('login_start', $search_value);
			$this->db->or_like('login_last', $search_value);
			$this->db->group_end();
		}
		if (isset($columns[$order_column])) {
			$this->db->order_by($columns[$order_column], $order_dir);
		}
		if (!empty($status_filter)) {
			$this->db->where('status', $status_filter);
		}
		$this->db->limit($length, $start);
		$query = $this->db->get();
		$data_user = $query->result();
		$data = array();
		$no = 0;
		foreach ($data_user as $v) {
			$btn_notes = '<div class="d-flex justify-content-center align-items-center">';
			if ($v->login_notes == TRUE) {
				$btn_notes .= '<span class="badge badge-success right">Online</span>';
			} else {
				$btn_notes .= '<span class="badge badge-danger right">Offline</span>';
			}

			$btn_notes .= '</div>';
			$button = '<div class="d-flex justify-content-center align-items-center text-center">';
			switch ($v->role_id) {
				case 1:
					$button .= '<div><button class="button-66" data-id="' . $v->id . '">Admin</button></div>';
					break;
				case 2:
					$button .= '<div><button class="button-66" data-id="' . $v->id . '">Sender</button></div>';
					break;
				case 3:
					$button .= '<div><button class="button-66" data-id="' . $v->id . '">Harbors</button></div>';
					break;
				case 4:
					$button .= '<div><button class="button-66" data-id="' . $v->id . '">Receiver</button></div>';
					break;
				default:
					$button = '';
			}
			$button .= '</div>';



			$data[] = array(
				'no' => ++$no,
				'username' => $v->username,
				'role_id' => $button,
				'login_notes' => $btn_notes,
				'login_last' => $v->login_last ? $v->login_last : '---------',
				'login_start' => $v->login_start ? $v->login_start : '---------',
				// 'action' => $button
			);
		}
		echo json_encode(array(
			"draw" => intval($this->input->get('draw')),
			"recordsTotal" => $total_data,
			"totalPengiriman" => $this->any_model->status_count(),
			"recordsFiltered" => $this->db->affected_rows(),
			"data" => $data
		));
	}

	public function get_pengiriman()
	{
		$start = $this->input->get('start');
		$length = $this->input->get('length');
		$order_column = $_GET['order'][0]['column'];
		$order_dir = $_GET['order'][0]['dir'];
		$search_value = $_GET['search']['value'];
		// die_dump($total);

		// Tambahkan filter status dari request (misal status 2 untuk view 2)
		$status_filter = $this->input->get('status');  // Dapatkan parameter status jika ada

		$columns = ['id_barang', 'bill', 'deskripsi', 'status', 'port', 'tgl', 'waktu'];

		$this->db->from('form_pengiriman');
		if (!empty($status_filter)) {
			$this->db->where('status', $status_filter);  // Filter berdasarkan status
		}
		$total_data = $this->db->count_all_results();

		$this->db->select('*');
		$this->db->from('form_pengiriman');

		if (!empty($search_value)) {
			$this->db->group_start();
			$this->db->like('id_barang', $search_value);
			$this->db->or_like('bill', $search_value);
			$this->db->or_like('deskripsi', $search_value);
			$this->db->or_like('status', $search_value);
			$this->db->or_like('port', $search_value);
			$this->db->or_like('tgl', $search_value);
			$this->db->or_like('waktu', $search_value);
			$this->db->group_end();
		}

		if (isset($columns[$order_column])) {
			$this->db->order_by($columns[$order_column], $order_dir);
		}

		if (!empty($status_filter)) {
			$this->db->where('status', $status_filter);  // Tambahkan filter untuk query
		}

		$this->db->limit($length, $start);

		$query = $this->db->get();
		$data_pengiriman = $query->result();

		$data = array();
		$no = 0;
		foreach ($data_pengiriman as $v) {
			$status = 'Unknown';
			$button = '<div class="d-flex justify-content-center align-items-center">';
			switch ($v->status) {
				case 1:
					$status = 'In Shipping';
					$button .= '<button type="submit" class="button-dataTable btn-color-1" id="btn-update" data-id="' . $v->id_barang . '" title="Klik untuk mengupdate">
                    <i class="fa-solid fa-truck-fast"></i>
                	</button>';
					$button .= '<a class="button-dataTable btn-color-4" id="btn-view" 
					data-toggle="modal" data-target="#exampleModal" 
					data-id="' . $v->id_barang . '">
					<i class="fa-solid fa-eye"></i>
					</a>';
					break;
				case 2:
					$status = 'Arrive at port';
					$button .= '<button type="submit" class="button-dataTable btn-color-3" id="btn-update-arrive" data-idb="' . $v->id_barang . '">
                    <i class="fa-solid fa-ship"></i>
                </button>';
					break;
				case 3:
					$status = 'Received';
					$button .= '<button type="submit" class="button-dataTable btn-color-5" id="btn-update-received" data-idb="' . $v->id_barang . '">
                    <i class="fa-solid fa-hand-holding-heart"></i></button>';
					$button .= '<a class="button-dataTable btn-color-4" id="btn-view" 
					data-toggle="modal" data-target="#exampleModal" 
					data-id="' . $v->id_barang . '">
					<i class="fa-solid fa-eye"></i>
					</a>';;
					break;
				default:
					$button .= '<a class="button-dataTable btn-color-2" id="btn-x" data-id="' . $v->id_barang . '">
                    <i class="fa-solid fa-circle-xmark"></i>
                </a>';
					break;
			}
			$button .= '</div>';

			$data[] = array(
				'no' => ++$no,
				'id_barang' => $v->id_barang,
				'bill' => $v->bill,
				'deskripsi' => $v->deskripsi,
				'status' => $status,
				'port' => $v->port,
				'tgl' => $v->tgl,
				'waktu' => $v->waktu,
				'action' => $button
			);
		}
		echo json_encode(array(
			"draw" => intval($this->input->get('draw')),
			"recordsTotal" => $total_data,
			"totalPengiriman" => $this->any_model->status_count(),
			"recordsFiltered" => $this->db->affected_rows(),
			"data" => $data
		));
	}
	public function fetch_pengiriman()
	{
		$id_barang = $this->input->get('id_barang');
		$data_barang = $this->any_model->fetch_id($id_barang);

		if ($data_barang) {
			echo json_encode($data_barang);
		} else {
			echo json_encode(['error' => 'Data tidak ditemukan']);
		}
	}
	public function update_pengiriman()
	{
		$id_barang = $this->input->post('id_barang');
		$status = $this->input->post('status');
		$data = $this->any_model->update_status($id_barang, $status);

		if ($data) {
			echo json_encode(['status' => 'success', 'message' => 'Data berhasil disimpan']);
		} else {
			echo json_encode(['status' => 'error', 'message' => 'Gagal menyimpan data.']);
		}
	}
	public function update_pengiriman_arrived()
	{
		$id_barang = $this->input->post('id_barang');
		$status = $this->input->post('status');
		$data = $this->any_model->update_status_arrived($id_barang, $status);

		if ($data) {
			echo json_encode(['status' => 'success', 'message' => 'Data berhasil disimpan']);
		} else {
			echo json_encode(['status' => 'error', 'message' => 'Gagal menyimpan data.']);
		}
	}
	public function add_user()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$role = $this->input->post('role');

		if (empty($username) || empty($password) || empty($role)) {
			echo json_encode(['status' => 'error', 'message' => 'Semua field harus diisi.']);
			return;
		}

		if ($this->any_model->check_username_exists($username)) {
			echo json_encode(['status' => 'error', 'message' => 'Username sudah digunakan.']);
			return;
		}

		$data = [
			'username' => $username,
			'password' => password_hash($password, PASSWORD_DEFAULT),
			'role_id' => $role,
			'created_at' => date('Y-m-d H:i:s')
		];

		if ($this->any_model->insert_user($data)) {
			echo json_encode(['status' => 'success', 'message' => 'Data berhasil disimpan']);
		} else {
			echo json_encode(['status' => 'error', 'message' => 'Gagal menyimpan data.']);
		}
	}
}
