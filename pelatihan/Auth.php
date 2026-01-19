<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('pelatihan/Auth_model');
    }

    public function login()
{
    if ($this->session->userdata('pelatihan_login')) {
        redirect('pelatihan/pelatihan');
    }
    $this->load->view('pelatihan/auth/login');
}
public function register()
{
    if ($this->session->userdata('pelatihan_login')) {
        redirect('pelatihan/pelatihan');
    }
    $this->load->view('pelatihan/auth/register');
}

public function proses_register()
{
    $username    = trim($this->input->post('username'));
    $passwordRaw = $this->input->post('password');
    $nama        = trim($this->input->post('nama_lengkap'));
    $email       = trim($this->input->post('email'));
    $no_hp       = trim($this->input->post('no_hp'));
    $alamat      = trim($this->input->post('alamat'));

    // validasi minimal sesuai struktur tabel peserta kamu (nama_lengkap & email wajib)
    if ($username === '' || $passwordRaw === '' || $nama === '' || $email === '') {
        $this->session->set_flashdata('error', 'Username, Password, Nama Lengkap, dan Email wajib diisi.');
        redirect('pelatihan/auth/register');
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $this->session->set_flashdata('error', 'Format email tidak valid.');
        redirect('pelatihan/auth/register');
    }

    // cek username sudah dipakai?
    if ($this->Auth_model->cek_username($username)) {
        $this->session->set_flashdata('error', 'Username sudah digunakan.');
        redirect('pelatihan/auth/register');
    }

    // 1) insert ke tabel user (role peserta)
    $id_user = $this->Auth_model->buat_user_peserta($username, md5($passwordRaw));

    // 2) insert ke tabel peserta (FK ke user)
    $id_peserta = $this->Auth_model->buat_peserta([
        'id_user'      => $id_user,
        'nama_lengkap' => $nama,
        'email'        => $email,
        'no_hp'        => $no_hp ?: null,
        'alamat'       => $alamat ?: null,
    ]);

    // 3) auto login
    $this->session->set_userdata([
        'pelatihan_login' => true,
        'id_user'         => $id_user,
        'id_peserta'      => $id_peserta,
        'role'            => 'peserta',
        'username'        => $username
    ]);

    $this->session->set_flashdata('success', 'Registrasi berhasil. Silakan daftar pelatihan.');
    redirect('pelatihan/pelatihan');
}


public function proses_login()
{
    $username = $this->input->post('username');
    $password = md5($this->input->post('password'));

    $user = $this->Auth_model->cek_login($username, $password);

    if ($user) {
        $this->session->set_userdata([
            'pelatihan_login' => true,
            'id_user'   => $user->id_user,
            'id_peserta'=> $user->id_peserta,
            'role'      => $user->role,
            'username'  => $user->username
        ]);

        redirect('pelatihan/pelatihan');
    } else {
        $this->session->set_flashdata('error','Username atau Password salah');
        redirect('pelatihan/auth/login');
    }
}


    public function logout()
    {
        $this->session->sess_destroy();
        redirect('pelatihan/auth/login');
    }
}
