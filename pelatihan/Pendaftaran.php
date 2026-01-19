<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pendaftaran extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('pelatihan_login')) {
            redirect('pelatihan/auth/login');
        }

        $this->load->model('pelatihan/Pendaftaran_model');
    }

    public function index()
    {
        $id_peserta = $this->session->userdata('id_peserta');

        $data['pendaftaran'] = $this->Pendaftaran_model->get_by_peserta($id_peserta);
        $data['pelatihan']   = $this->Pendaftaran_model->get_all_pelatihan(); // <-- ambil pelatihan dari DB

        $this->load->view('pelatihan/pendaftaran/pendaftaran', $data);
    }

    public function simpan()
    {
        $id_peserta   = $this->session->userdata('id_peserta');
        $id_pelatihan = $this->input->post('id_pelatihan');

        if (!$id_peserta) {
            show_error("Session id_peserta belum terset.", 500);
        }

        if (!$id_pelatihan) {
            $this->session->set_flashdata('error', 'Pelatihan wajib dipilih.');
            redirect('pelatihan/pendaftaran');
        }

        // cek id_pelatihan valid (hindari error FK)
        if (!$this->Pendaftaran_model->cek_pelatihan($id_pelatihan)) {
            $this->session->set_flashdata('error', 'Pelatihan tidak valid.');
            redirect('pelatihan/pendaftaran');
        }

        // upload berkas (opsional)
        $nama_file = null;
        if (!empty($_FILES['berkas']['name'])) {
            $config['upload_path']   = FCPATH . 'uploads/berkas/';
            $config['allowed_types'] = 'pdf|jpg|jpeg|png';
            $config['max_size']      = 2048; // 2MB
            $config['encrypt_name']  = true;

            if (!is_dir($config['upload_path'])) {
                mkdir($config['upload_path'], 0777, true);
            }

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('berkas')) {
                $this->session->set_flashdata('error', $this->upload->display_errors('', ''));
                redirect('pelatihan/pendaftaran');
            }

            $nama_file = $this->upload->data('file_name');
        }

       $data = [
  'id_peserta'        => $id_peserta,
  'id_pelatihan'      => $id_pelatihan,
  'nama_lengkap'      => $this->input->post('nama_lengkap'),
  'email'             => $this->input->post('email'),
  'no_hp'             => $this->input->post('no_hp'),
  'alamat'            => $this->input->post('alamat'),
  'berkas'            => $nama_file,
  'tanggal_daftar'    => date('Y-m-d'),
  'status_verifikasi' => 'menunggu',
];

// hitung persen
$skor = 0;
if ($nama_file) $skor += 20;

$email = $this->input->post('email');
if (filter_var($email, FILTER_VALIDATE_EMAIL)) $skor += 10;

$no_hp = preg_replace('/\D/', '', $this->input->post('no_hp'));
if (strlen($no_hp) >= 10) $skor += 10;

$alamat = $this->input->post('alamat');
if (strlen(trim($alamat)) >= 10) $skor += 10;

$data['persentase_lulus'] = min(100, $skor);

$this->Pendaftaran_model->simpan($data);



        $this->session->set_flashdata('success', 'Pendaftaran berhasil!');
        redirect('pelatihan/pendaftaran');
    }
}
