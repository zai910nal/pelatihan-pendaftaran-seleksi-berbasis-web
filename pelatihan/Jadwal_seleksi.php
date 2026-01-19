<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jadwal_seleksi extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('pelatihan_login')) {
            redirect('pelatihan/auth/login');
        }

        $this->load->model('pelatihan/Jadwal_model');
    }

    public function index()
{
    $id_peserta = $this->session->userdata('id_peserta');
    $data['jadwal'] = $this->Jadwal_model->get_by_peserta($id_peserta);
    $this->load->view('pelatihan/jadwal_seleksi/index', $data);
}


    // ✅ ADMIN/PANITIA: kelola jadwal
    public function kelola()
    {
        $role = $this->session->userdata('role');
        if (!in_array($role, ['admin', 'panitia'])) {
            show_error('Akses ditolak', 403);
        }

        $data['jadwal'] = $this->Jadwal_model->get_all();
        $this->load->view('pelatihan/jadwal_seleksi/kelola', $data);
    }

   public function tambah()
{
    $role = $this->session->userdata('role');
    if (!in_array($role, ['admin', 'panitia'])) show_error('Akses ditolak', 403);

    $data['pendaftaran'] = $this->Jadwal_model->get_pendaftaran_belum_jadwal();
    $this->load->view('pelatihan/jadwal_seleksi/tambah', $data);
}


    public function simpan()
{
    $role = $this->session->userdata('role');
    if (!in_array($role, ['admin', 'panitia'])) show_error('Akses ditolak', 403);

    $id_pendaftaran = $this->input->post('id_pendaftaran');
    if (!$id_pendaftaran) {
        $this->session->set_flashdata('error', 'Pendaftaran wajib dipilih.');
        redirect('pelatihan/jadwal_seleksi/tambah');
    }

    $data = [
        'id_pendaftaran'  => $id_pendaftaran,
        'tanggal_seleksi' => $this->input->post('tanggal_seleksi'),
        'jam_seleksi'     => $this->input->post('jam_seleksi') ?: null,
        'lokasi'          => $this->input->post('lokasi'),
        'status_hadir'    => 'belum',
    ];

    $this->Jadwal_model->insert($data);
    $this->session->set_flashdata('success', 'Jadwal seleksi berhasil ditambahkan.');
    redirect('pelatihan/jadwal_seleksi/kelola');
}
public function selesai($id_jadwal)
{
    $id_peserta = $this->session->userdata('id_peserta');

    if ($this->Jadwal_model->set_hadir($id_jadwal, $id_peserta)) {
        $this->session->set_flashdata('success', 'Status seleksi berhasil ditandai sudah.');
    } else {
        $this->session->set_flashdata('error', 'Gagal. Jadwal bukan milik kamu / tidak ditemukan.');
    }

    redirect('pelatihan/jadwal_seleksi');
}
public function saya_sudah_seleksi()
{
    $role = $this->session->userdata('role');
    if ($role !== 'peserta') {
        show_error('Akses ditolak', 403);
    }

    $id_jadwal = $this->input->post('id_jadwal');
    if (empty($id_jadwal)) {
        $this->session->set_flashdata('error', 'ID jadwal tidak valid.');
        redirect('pelatihan/jadwal_seleksi');
    }

    // update status_hadir = 'sudah'
    $this->Jadwal_model->update($id_jadwal, ['status_hadir' => 'sudah']);

    $this->session->set_flashdata('success', 'Status seleksi berhasil diupdate.');
    redirect('pelatihan/jadwal_seleksi');
}



    public function edit($id_jadwal)
    {
        $role = $this->session->userdata('role');
        if (!in_array($role, ['admin', 'panitia'])) {
            show_error('Akses ditolak', 403);
        }

        $data['jadwal']    = $this->Jadwal_model->get_by_id($id_jadwal);
        $data['pelatihan'] = $this->Jadwal_model->get_all_pelatihan();
        $this->load->view('pelatihan/jadwal_seleksi/edit', $data);
    }

    public function update($id_jadwal)
    {
        $role = $this->session->userdata('role');
        if (!in_array($role, ['admin', 'panitia'])) {
            show_error('Akses ditolak', 403);
        }

        $id_pelatihan = $this->input->post('id_pelatihan');
        if (!$this->Jadwal_model->cek_pelatihan($id_pelatihan)) {
            $this->session->set_flashdata('error', 'Pelatihan tidak valid.');
            redirect('pelatihan/jadwal_seleksi/edit/'.$id_jadwal);
        }

        $data = [
            'id_pelatihan'    => $id_pelatihan,
            'tanggal_seleksi' => $this->input->post('tanggal_seleksi'),
            'lokasi'          => $this->input->post('lokasi'),
        ];

        $this->Jadwal_model->update($id_jadwal, $data);
        $this->session->set_flashdata('success', 'Jadwal seleksi berhasil diupdate.');
        redirect('pelatihan/jadwal_seleksi/kelola');
    }

    public function hapus($id_jadwal)
    {
        $role = $this->session->userdata('role');
        if (!in_array($role, ['admin', 'panitia'])) {
            show_error('Akses ditolak', 403);
        }

        $this->Jadwal_model->delete($id_jadwal);
        $this->session->set_flashdata('success', 'Jadwal seleksi berhasil dihapus.');
        redirect('pelatihan/jadwal_seleksi/kelola');
    }

}
