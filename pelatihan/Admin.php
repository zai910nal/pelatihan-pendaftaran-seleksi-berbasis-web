<?php
class Admin extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('pelatihan_login')) {
            redirect('pelatihan/auth/login');
        }

        $role = $this->session->userdata('role');
        if (!in_array($role, ['admin','panitia'])) {
            show_error('Akses ditolak', 403);
        }

        $this->load->model('pelatihan/Admin_model');
        $this->load->model('pelatihan/Pendaftaran_model');
    }

    public function verifikasi_list()
{
    $data['rows'] = $this->Admin_model->get_all_pendaftaran(); // ✅ harus 'rows'
    $this->load->view('pelatihan/admin/verifikasi_list', $data);
}


    public function verifikasi($id_pendaftaran)
{
    $this->Admin_model->update_status_verifikasi($id_pendaftaran, 'diterima');
    $this->session->set_flashdata('success', 'Pendaftaran berhasil diverifikasi.');
    redirect('pelatihan/admin/verifikasi_list');
}

public function verifikasi_tolak($id_pendaftaran)
{
    $this->Admin_model->update_status_verifikasi($id_pendaftaran, 'ditolak');
    $this->session->set_flashdata('success', 'Pendaftaran berhasil ditolak.');
    redirect('pelatihan/admin/verifikasi_list');
}
public function verifikasi_detail($id_pendaftaran)
{
    $row = $this->Admin_model->get_detail($id_pendaftaran);
    if (!$row) show_404();

    $data['row'] = $row;
    $data['berkas_list'] = $this->Admin_model->get_berkas_by_pendaftaran($id_pendaftaran);

    $this->load->view('pelatihan/admin/verifikasi_detail', $data);
}


    // Menu lain (sementara hanya view)
    public function kelola_jadwal()
    {
        $this->load->view('pelatihan/jadwal_seleksi/kelola');
    }

    public function kelola_berkas()
    {
        $this->load->view('pelatihan/berkas/kelola');
    }

    public function kirim_hasil()
    {
        $this->load->view('pelatihan/hasil_seleksi/kirim');
    }
}
