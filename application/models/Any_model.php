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

	public function generate_nomor_bill() {
		$today = date('Ymd');
        $this->db->like('bill', $today, 'after'); 
        $this->db->order_by('bill', 'DESC'); 
        $last_bill = $this->db->get('form_pengiriman')->row();
        return $last_bill;

    }
	public function generate_id_barang() {
		$id_barang = str_pad(mt_rand(0, 99999999), 8, '0', STR_PAD_LEFT);
		return $id_barang;
	}
	
	public function insert_form_pengiriman($data){
		$this->db->insert('form_pengiriman', $data);
		return $this->db->affected_rows() != 1 ? false : true;
	}


}