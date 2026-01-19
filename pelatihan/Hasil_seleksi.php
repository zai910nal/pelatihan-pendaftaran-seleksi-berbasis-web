<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hasil_seleksi extends CI_Controller {

    public function __construct()
{
    parent::__construct();

    if (!$this->session->userdata('pelatihan_login')) {
        redirect('pelatihan/auth/login');
    }

    $this->load->model('pelatihan/Notifikasi_model');
    $this->load->model('pelatihan/Admin_model');       // ✅ tambahkan
    $this->load->model('pelatihan/Pendaftaran_model'); // ✅ opsional (untuk tampilkan data peserta)
}



    public function index()
{
    $id_peserta = $this->session->userdata('id_peserta');

    $data['notifikasi'] = $this->Notifikasi_model->get_by_peserta($id_peserta);
    $data['pendaftaran'] = $this->Pendaftaran_model->get_by_peserta($id_peserta); // ✅ tambah

    // ✅ ambil data pendaftaran peserta (buat status seleksi/verifikasi/persentase)
    $pendaftaran = $this->Pendaftaran_model->get_by_peserta($id_peserta);

    // kalau ternyata return-nya array/list, ambil yang paling baru
    if (is_array($pendaftaran)) {
        $data['pendaftaran'] = !empty($pendaftaran) ? $pendaftaran[0] : null;
    } else {
        $data['pendaftaran'] = $pendaftaran; // kalau return row object
    }

    $this->load->view('pelatihan/hasil_seleksi/index', $data);
}


    // ✅ PANITIA/ADMIN: form kirim hasil seleksi
    public function kirim()
    {
        $role = $this->session->userdata('role');
        if (!in_array($role, ['admin', 'panitia'])) {
            show_error('Akses ditolak', 403);
        }

        $this->load->view('pelatihan/hasil_seleksi/kirim');
    }

    // ✅ PANITIA/ADMIN: simpan notifikasi hasil seleksi
    public function simpan()
{
    $role = $this->session->userdata('role');
    if (!in_array($role, ['admin', 'panitia'])) {
        show_error('Akses ditolak', 403);
    }

    $id_peserta     = (int)$this->input->post('id_peserta');
    $id_pendaftaran = (int)$this->input->post('id_pendaftaran'); // dari form
    $status_seleksi = $this->input->post('status_seleksi');      // Lulus / Tidak Lulus / Menunggu
    $isi_notifikasi = $this->input->post('isi_notifikasi');

    if (!$id_peserta) {
        $this->session->set_flashdata('error', 'ID peserta wajib diisi.');
        redirect('pelatihan/hasil_seleksi/kirim');
    }

    // ✅ 1) Update hasil seleksi di pendaftaran (kalau id_pendaftaran diisi)
    if (!empty($id_pendaftaran) && !empty($status_seleksi)) {
        $this->Admin_model->update_status_seleksi($id_pendaftaran, $status_seleksi);
    }

    // ✅ 2) Insert notifikasi kalau ada pesan
    if (!empty(trim($isi_notifikasi))) {
        $dataNotif = [
            'id_peserta'     => $id_peserta,
            'isi_notifikasi' => $isi_notifikasi,
            'tanggal'        => date('Y-m-d'),
        ];
        $this->Notifikasi_model->insert($dataNotif);
    }

    $this->session->set_flashdata('success', 'Hasil seleksi berhasil disimpan dan/atau dikirim!');
    redirect('pelatihan/hasil_seleksi/kirim');
}
}
