<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pendaftaran_model extends CI_Model {

    protected $db_pelatihan;

    public function __construct()
    {
        parent::__construct();
        $this->db_pelatihan = $this->load->database('db_baru', TRUE);
    }

    public function get_by_peserta($id_peserta)
{
    return $this->db_pelatihan
        ->select('pendaftaran.*, pelatihan.nama_pelatihan')
        ->from('pendaftaran')
        ->join('pelatihan', 'pelatihan.id_pelatihan = pendaftaran.id_pelatihan', 'left')
        ->where('pendaftaran.id_peserta', $id_peserta)
        ->order_by('pendaftaran.id_pendaftaran', 'DESC')
        ->get()
        ->row(); // ✅ ambil terbaru
}



    public function get_all_pelatihan()
    {
        return $this->db_pelatihan
            ->order_by('id_pelatihan', 'ASC')
            ->get('pelatihan')
            ->result();
    }

    public function cek_pelatihan($id_pelatihan)
    {
        return $this->db_pelatihan
            ->where('id_pelatihan', $id_pelatihan)
            ->get('pelatihan')
            ->row();
    }

    public function simpan($data)
    {
        return $this->db_pelatihan->insert('pendaftaran', $data);
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

public function update_status_seleksi($id_pendaftaran, $status_seleksi)
{
    { return $this->db_pelatihan
        ->where('id_pendaftaran', $id_pendaftaran)
        ->update('pendaftaran', ['status_seleksi' => $status_seleksi]);

    $update = ['status_seleksi' => $status_seleksi];
    }
    if ($status_seleksi === 'diterima') {
    $row = $this->get_detail($id_pendaftaran);
    $current = (int)($row->persentase_lulus ?? 0);
    $update['persentase_lulus'] = max($current, 70);
}

if ($status_seleksi === 'ditolak') {
    $update['persentase_lulus'] = 0;
}


    return $this->db_pelatihan
        ->where('id_pendaftaran', $id_pendaftaran)
        ->update('pendaftaran', $update);
}
public function sudah_daftar($id_peserta, $id_pelatihan)
{
    return $this->db_pelatihan
        ->where('id_peserta', $id_peserta)
        ->where('id_pelatihan', $id_pelatihan)
        ->get('pendaftaran')
        ->num_rows() > 0;
}

      
}


