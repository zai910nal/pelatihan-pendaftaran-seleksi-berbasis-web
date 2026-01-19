<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Berkas extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('pelatihan_login')) {
            redirect('pelatihan/auth/login');
        }

        $this->load->model('pelatihan/Berkas_model');
    }

    // ✅ PESERTA: halaman berkas + upload
    public function index()
    {
        $id_peserta = $this->session->userdata('id_peserta');
        $pendaftaran = $this->Berkas_model->get_pendaftaran_by_peserta($id_peserta);

        if (!$pendaftaran) {
            $this->session->set_flashdata('error', 'Anda belum mendaftar pelatihan, silakan daftar dulu.');
            redirect('pelatihan/pendaftaran');
        }

        $data['pendaftaran'] = $pendaftaran;
        $data['berkas'] = $this->Berkas_model->get_by_id_pendaftaran($pendaftaran->id_pendaftaran);

        $this->load->view('pelatihan/berkas/index', $data);
    }

    // ✅ PESERTA: proses upload
    public function upload()
    {
        $id_peserta = $this->session->userdata('id_peserta');
        $pendaftaran = $this->Berkas_model->get_pendaftaran_by_peserta($id_peserta);

        if (!$pendaftaran) {
            show_error("Tidak ada pendaftaran untuk peserta ini.", 500);
        }

        $nama_berkas = $this->input->post('nama_berkas');

        if (empty($_FILES['file_berkas']['name'])) {
            $this->session->set_flashdata('error', 'File berkas wajib dipilih.');
            redirect('pelatihan/berkas');
        }

        $config['upload_path']   = FCPATH . 'uploads/berkas/';
        $config['allowed_types'] = 'pdf|jpg|jpeg|png';
        $config['max_size']      = 2048; // 2MB
        $config['encrypt_name']  = true;

        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0777, true);
        }

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('file_berkas')) {
            $this->session->set_flashdata('error', $this->upload->display_errors('', ''));
            redirect('pelatihan/berkas');
        }

        $file_name = $this->upload->data('file_name');

        $data = [
            'id_pendaftaran' => $pendaftaran->id_pendaftaran,
            'nama_berkas'    => $nama_berkas,
            'file_path'      => 'uploads/berkas/' . $file_name,
            'status_berkas'  => 'tidak_valid'
        ];

        $this->Berkas_model->insert($data);

        $this->session->set_flashdata('success', 'Berkas berhasil diupload.');
        redirect('pelatihan/berkas');
    }

    // ✅ PANITIA/ADMIN: kelola berkas (lihat semua + verifikasi)
    public function kelola()
    {
        $role = $this->session->userdata('role');
        if (!in_array($role, ['admin', 'panitia'])) {
            show_error('Akses ditolak', 403);
        }

        $data['berkas'] = $this->Berkas_model->get_all();
        $this->load->view('pelatihan/berkas/kelola', $data);
    }

    // ✅ PANITIA/ADMIN: update status berkas
   public function verifikasi($id_berkas)
{
    $role = $this->session->userdata('role');
    if (!in_array($role, ['admin', 'panitia'])) {
        show_error('Akses ditolak', 403);
    }

    $status = $this->input->post('status_berkas');
    $allowed = ['valid', 'tidak_valid'];
    if (!in_array($status, $allowed)) {
        $this->session->set_flashdata('error', 'Status tidak valid.');
        redirect('pelatihan/berkas/kelola');
    }

    $this->Berkas_model->update_status($id_berkas, $status);

    $this->session->set_flashdata('success', 'Status berkas berhasil diupdate.');
    redirect('pelatihan/berkas/kelola');
}

}
