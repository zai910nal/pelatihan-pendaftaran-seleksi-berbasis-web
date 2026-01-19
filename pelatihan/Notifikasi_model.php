<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notifikasi_model extends CI_Model {

    protected $db_pelatihan;

    public function __construct()
    {
        parent::__construct();
        $this->db_pelatihan = $this->load->database('db_baru', TRUE);
    }

    public function get_by_peserta($id_peserta)
    {
        return $this->db_pelatihan
            ->where('id_peserta', $id_peserta)
            ->order_by('tanggal', 'DESC')
            ->get('notifikasi')
            ->result();
    }

    public function insert($data)
    {
        return $this->db_pelatihan->insert('notifikasi', $data);
    }
}
