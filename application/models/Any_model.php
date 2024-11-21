<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Any_model extends MY_Model
{
	public function __construct()
	{
		// load library database
		parent::__construct();
		$this->load->model('User_model', 'us_model');
	}

	public function generate_nomor_bill()
	{
		$today = date('Ymd');
		$this->db->like('bill', $today, 'after');
		$this->db->order_by('bill', 'DESC');
		$last_bill = $this->db->get('form_pengiriman')->row();
		return $last_bill;
	}
	public function generate_id_barang()
	{
		$id_barang = str_pad(mt_rand(0, 99999999), 8, '0', STR_PAD_LEFT);
		return $id_barang;
	}

	public function insert_form_pengiriman($data)
	{
		$this->db->insert('form_pengiriman', $data);
		return $this->db->affected_rows() != 1 ? false : true;
	}
	public function insert_user($data)
	{
		$this->db->insert('m_user', $data);
		return $this->db->affected_rows() != 1 ? false : true;
	}
	public function check_username_exists($username)
	{
		$this->db->where('username', $username);
		$query = $this->db->get('m_user');
		return $query->num_rows() > 0;
	}
	public function get_form_pengiriman()
	{
		$query = $this->db->select('*')->from('form_pengiriman');
		return $query ? $query : [];
	}
	public function fetch_id($id)
	{
		$fetch_query = $this->db->select('*')
			->from('form_pengiriman')
			->where('id_barang', $id)
			->get();
		if ($fetch_query->num_rows() > 0) {
			return $fetch_query->row_array();
		} else {
			return null;
		}
	}
	public function update_status($id, $status)
	{
		$this->db->set('status', $status);
		$this->db->set('updated_at', date('Y-m-d H:i:s'));
		$this->db->where('id_barang', $id);
		return $this->db->update('form_pengiriman');
	}
	public function update_status_arrived($id, $status)
	{
		$this->db->set('status', $status);
		$this->db->set('updated_second_at', date('Y-m-d H:i:s'));
		$this->db->where('id_barang', $id);
		return $this->db->update('form_pengiriman');
	}
	public function status_count()
	{
		$data = [];
		$this->db->select('status, COUNT(*) as count');
		$this->db->from('form_pengiriman');
		$this->db->group_by('status');
		$query = $this->db->get();
		$status_counts = [
			1 => 0,
			2 => 0,
			3 => 0
		];
		foreach ($query->result() as $row) {
			$status_counts[$row->status] = (int) $row->count;
		}
		return [
			'status_1' => $status_counts[1],
			'status_2' => $status_counts[2],
			'status_3' => $status_counts[3]
		];
	}
}
