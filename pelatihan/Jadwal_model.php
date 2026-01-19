<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jadwal_model extends CI_Model {

    protected $db_pelatihan;

    public function __construct()
    {
        parent::__construct();
        $this->db_pelatihan = $this->load->database('db_baru', TRUE);
    }
public function get_all()
{
    return $this->db_pelatihan
        ->select('j.*, p.nama_pelatihan, d.nama_lengkap, d.email')
        ->from('jadwal_seleksi j')
        ->join('pendaftaran d', 'd.id_pendaftaran = j.id_pendaftaran', 'left')
        ->join('pelatihan p', 'p.id_pelatihan = d.id_pelatihan', 'left')
        ->order_by('j.tanggal_seleksi', 'ASC')
        ->get()
        ->result();
}

// ✅ jadwal khusus peserta yang login
public function get_by_peserta($id_peserta)
{
    return $this->db_pelatihan
        ->select('j.*, p.nama_pelatihan')
        ->from('jadwal_seleksi j')
        ->join('pendaftaran d', 'd.id_pendaftaran = j.id_pendaftaran', 'inner')
        ->join('pelatihan p', 'p.id_pelatihan = d.id_pelatihan', 'left')
        ->where('d.id_peserta', $id_peserta)
        ->order_by('j.tanggal_seleksi', 'ASC')
        ->get()
        ->result();
}

// ✅ dropdown admin: ambil pendaftaran diterima yang belum punya jadwal
public function get_pendaftaran_belum_jadwal()
{
    return $this->db_pelatihan
        ->select('d.id_pendaftaran, d.nama_lengkap, d.email, p.nama_pelatihan')
        ->from('pendaftaran d')
        ->join('pelatihan p', 'p.id_pelatihan = d.id_pelatihan', 'left')
        ->join('jadwal_seleksi j', 'j.id_pendaftaran = d.id_pendaftaran', 'left')
        ->where('d.status_verifikasi', 'diterima')
        ->where('j.id_pendaftaran IS NULL', null, false)
        ->order_by('d.id_pendaftaran', 'DESC')
        ->get()
        ->result();
}

public function set_hadir($id_jadwal, $id_peserta)
{
    // pastikan jadwal ini milik peserta itu
    $row = $this->db_pelatihan
        ->select('j.id_jadwal, d.id_peserta')
        ->from('jadwal_seleksi j')
        ->join('pendaftaran d', 'd.id_pendaftaran = j.id_pendaftaran', 'inner')
        ->where('j.id_jadwal', $id_jadwal)
        ->get()->row();

    if (!$row || (int)$row->id_peserta !== (int)$id_peserta) return false;

    return $this->db_pelatihan
        ->where('id_jadwal', $id_jadwal)
        ->update('jadwal_seleksi', ['status_hadir' => 'sudah']);
}


    public function get_by_id($id_jadwal)
    {
        return $this->db_pelatihan
            ->where('id_jadwal', $id_jadwal)
            ->get('jadwal_seleksi')
            ->row();
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

    public function insert($data)
    {
        return $this->db_pelatihan->insert('jadwal_seleksi', $data);
    }

    public function update($id_jadwal, $data)
    {
        return $this->db_pelatihan
            ->where('id_jadwal', $id_jadwal)
            ->update('jadwal_seleksi', $data);
    }

    public function delete($id_jadwal)
    {
        return $this->db_pelatihan
            ->where('id_jadwal', $id_jadwal)
            ->delete('jadwal_seleksi');
    }
}
