<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {

    private $db_pelatihan;

    public function __construct()
    {
        parent::__construct();
        $this->db_pelatihan = $this->load->database('db_baru', TRUE);
    }

    // Ambil semua pendaftaran yang statusnya Pending
    public function get_pendaftaran_pending()
{
    return $this->db_pelatihan
        ->select('pendaftaran.*, pelatihan.nama_pelatihan')
        ->from('pendaftaran')
        ->join('pelatihan', 'pelatihan.id_pelatihan = pendaftaran.id_pelatihan', 'left')
        ->where('pendaftaran.status_verifikasi', 'menunggu') // ✅ huruf kecil
        ->order_by('pendaftaran.id_pendaftaran', 'DESC')
        ->get()
        ->result(); // ✅ bukan row()
}


    public function update_status_verifikasi($id_pendaftaran, $status)
{
    $update = ['status_verifikasi' => $status];

    if ($status === 'diterima') {
        // minimal 70 kalau diterima
        $row = $this->db_pelatihan->where('id_pendaftaran', $id_pendaftaran)->get('pendaftaran')->row();
        $current = (int)($row->persentase_lulus ?? 0);
        $update['persentase_lulus'] = max($current, 70);
    }

    if ($status === 'ditolak') {
        $update['persentase_lulus'] = 0;
    }

    return $this->db_pelatihan
        ->where('id_pendaftaran', $id_pendaftaran)
        ->update('pendaftaran', $update);
}

    public function get_all_pendaftaran()
{
    return $this->db_pelatihan
        ->select('pendaftaran.*, pelatihan.nama_pelatihan')
        ->from('pendaftaran')
        ->join('pelatihan', 'pelatihan.id_pelatihan = pendaftaran.id_pelatihan', 'left')
        ->order_by('pendaftaran.id_pendaftaran', 'DESC')
        ->get()
        ->result();
}

public function update_status_seleksi($id_pendaftaran, $status_seleksi)
{
    $update = ['status_seleksi' => $status_seleksi];

    if ($status_seleksi === 'Lulus') {
        $update['persentase_lulus'] = 100;
    } elseif ($status_seleksi === 'Tidak Lulus') {
        $update['persentase_lulus'] = 0;
    }

    return $this->db_pelatihan
        ->where('id_pendaftaran', $id_pendaftaran)
        ->update('pendaftaran', $update);
}
public function get_detail($id_pendaftaran)
{
    return $this->db_pelatihan
        ->select('pendaftaran.*, pelatihan.nama_pelatihan')
        ->from('pendaftaran')
        ->join('pelatihan', 'pelatihan.id_pelatihan = pendaftaran.id_pelatihan', 'left')
        ->where('pendaftaran.id_pendaftaran', $id_pendaftaran)
        ->get()
        ->row();
}
public function get_berkas_by_pendaftaran($id_pendaftaran)
{
    return $this->db_pelatihan
        ->where('id_pendaftaran', $id_pendaftaran)
        ->order_by('id_berkas', 'DESC')
        ->get('berkas')
        ->result();
}

}
