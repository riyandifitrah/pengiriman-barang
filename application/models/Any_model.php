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
	public function update_status($id)
	{
		// Mengatur zona waktu ke Asia/Jakarta
		date_default_timezone_set('Asia/Jakarta');
		$this->db->set('status', 2);
		$this->db->set('updated_at', date('Y-m-d H:i:s'));
		$this->db->where('id_barang', $id);
		return $this->db->update('form_pengiriman');
	}
}
