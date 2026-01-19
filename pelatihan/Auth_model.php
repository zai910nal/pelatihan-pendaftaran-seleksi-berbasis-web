<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model {

    private $db_pelatihan;

    public function __construct()
    {
        parent::__construct();
        $this->db_pelatihan = $this->load->database('db_baru', TRUE);
    }

    public function cek_login($username, $password)
{
    return $this->db_pelatihan
        ->select('user.id_user, user.username, user.role, peserta.id_peserta')
        ->from('user')
        ->join('peserta', 'peserta.id_user = user.id_user', 'left')
        ->where('user.username', $username)
        ->where('user.password', $password)
        ->get()
        ->row();
}
public function cek_username($username)
{
    return $this->db_pelatihan
        ->where('username', $username)
        ->get('user')
        ->row();
}

public function buat_user_peserta($username, $password)
{
    $this->db_pelatihan->insert('user', [
        'username' => $username,
        'password' => $password,
        'role'     => 'peserta'
    ]);
    return $this->db_pelatihan->insert_id();
}

public function buat_peserta($data)
{
    // wajib: id_user, nama_lengkap, email (sesuai struktur tabel kamu)
    $this->db_pelatihan->insert('peserta', $data);
    return $this->db_pelatihan->insert_id();
}


}

