<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Berkas_model extends CI_Model {

    protected $db_pelatihan;

    public function __construct()
    {
        parent::__construct();
        $this->db_pelatihan = $this->load->database('db_baru', TRUE);
    }

    public function get_pendaftaran_by_peserta($id_peserta)
    {
        return $this->db_pelatihan
            ->where('id_peserta', $id_peserta)
            ->get('pendaftaran')
            ->row();
    }

    public function get_by_id_pendaftaran($id_pendaftaran)
    {
        return $this->db_pelatihan
            ->where('id_pendaftaran', $id_pendaftaran)
            ->order_by('id_berkas', 'DESC')
            ->get('berkas')
            ->result();
    }

    public function insert($data)
    {
        return $this->db_pelatihan->insert('berkas', $data);
    }

    public function update_status($id_berkas, $status)
    {
        return $this->db_pelatihan
            ->where('id_berkas', $id_berkas)
            ->update('berkas', ['status_berkas' => $status]);
    }

    public function get_all()
    {
        return $this->db_pelatihan
            ->select('b.*, p.id_peserta')
            ->from('berkas b')
            ->join('pendaftaran p', 'p.id_pendaftaran = b.id_pendaftaran', 'left')
            ->order_by('b.id_berkas', 'DESC')
            ->get()
            ->result();
    }
}
