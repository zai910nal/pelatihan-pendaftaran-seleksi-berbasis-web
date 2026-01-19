<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelatihan extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('pelatihan_login')) {
            redirect('pelatihan/auth/login');
        }

        $this->load->model('pelatihan/Pendaftaran_model');
        $this->load->model('pelatihan/Jadwal_model'); // ✅ TAMBAH INI
    }

    public function index()
    {
        $role       = $this->session->userdata('role');
        $id_peserta = $this->session->userdata('id_peserta');

        $data = [];
        $data['role'] = $role;

        if ($role == 'peserta') {

            $pendaftaran = $this->Pendaftaran_model->get_by_peserta($id_peserta);
            $data['pendaftaran'] = $pendaftaran;

            // ✅ ambil jadwal milik peserta (bisa array)
            $jadwal = $this->Jadwal_model->get_by_peserta($id_peserta);
            $data['jadwal'] = $jadwal;

            // Default tampilan kalau belum daftar
            $data['status_verifikasi_text'] = 'Belum Daftar';
            $data['status_seleksi_text']    = 'Belum Ada';
            $data['persentase']             = 0;
            $data['berkas_ada']             = false;

            if ($pendaftaran) {
                // status verifikasi
                $sv = strtolower(trim($pendaftaran->status_verifikasi ?? 'menunggu'));
                if ($sv == 'menunggu') $data['status_verifikasi_text'] = 'Menunggu Verifikasi';
                elseif ($sv == 'diterima') $data['status_verifikasi_text'] = 'Terverifikasi';
                elseif ($sv == 'ditolak') $data['status_verifikasi_text'] = 'Ditolak';

                // ✅ status seleksi (normalisasi huruf kecil)
                $stSel = strtolower(trim($pendaftaran->status_seleksi ?? 'menunggu'));

                // kalau admin simpan pakai "Lulus/Tidak Lulus" atau "lulus/tidak lulus" tetap kebaca
                if (in_array($stSel, ['lulus', 'diterima'])) {
                    $data['status_seleksi_text'] = 'Lulus';
                } elseif (in_array($stSel, ['tidak lulus', 'gagal', 'ditolak'])) {
                    $data['status_seleksi_text'] = 'Tidak Lulus';
                } else {
                    // ✅ kalau belum ada hasil seleksi, cek status hadir jadwal
                    $data['status_seleksi_text'] = 'Menunggu Tes';

                    if (!empty($jadwal)) {
                        $j0 = is_array($jadwal) ? $jadwal[0] : $jadwal;
                        $hadir = strtolower(trim($j0->status_hadir ?? 'belum'));
                        if (in_array($hadir, ['sudah','hadir','selesai'])) {
                            $data['status_seleksi_text'] = 'Menunggu Penilaian';
                        }
                    }
                }

                // persentase
                $data['persentase'] = (int)($pendaftaran->persentase_lulus ?? 0);

                // berkas
                $data['berkas_ada'] = !empty($pendaftaran->berkas);
            }

            $this->load->view('pelatihan/pelatihan/index_peserta', $data);
            return;
        }

        if ($role == 'admin') {
            $this->load->view('pelatihan/pelatihan/index_admin', $data);
            return;
        }

        show_error("Role tidak dikenali: ".$role, 403);
    }
}
