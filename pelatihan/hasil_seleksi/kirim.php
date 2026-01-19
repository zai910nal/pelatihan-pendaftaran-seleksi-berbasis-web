<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kirim Hasil Seleksi</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="/codelingter/assets/css/ui-dashboard.css">

  <style>
    .alert{
      padding:12px 14px;
      border-radius:12px;
      margin:0 0 14px 0;
      font-weight:800;
      border: 1px solid rgba(255,255,255,0.18);
      background: rgba(16,185,129,0.18);
      color:#d1fae5;
    }
    .alert.error{
      background: rgba(239,68,68,0.18);
      color:#fee2e2;
    }

    .form-wrap{ margin-top: 10px; display: grid; gap: 14px; max-width: 920px; }
    .form-row{ display:grid; grid-template-columns: 1fr 1fr; gap: 12px; }
    @media(max-width: 900px){ .form-row{ grid-template-columns: 1fr; } }

    .form-group label{
      display:block;
      margin-bottom: 6px;
      color: rgba(255,255,255,0.85);
      font-weight: 800;
      font-size: 14px;
    }

    .form-control{
      width: 100%;
      padding: 12px 14px;
      border-radius: 12px;
      border: 1px solid rgba(255,255,255,0.15);
      background: rgba(255,255,255,0.10);
      color: #150909;
      outline: none;
    }
    .form-control::placeholder{ color: rgba(255,255,255,0.55); }

    textarea.form-control{ min-height: 120px; resize: vertical; line-height: 1.5; }

    .helper{ font-size: 13px; color: rgba(255,255,255,0.65); margin-top: 6px; }

    .form-actions{ display:flex; gap: 10px; align-items:center; justify-content:flex-start; margin-top: 4px; flex-wrap: wrap; }

    .btn-primary{
      display:inline-flex;
      gap:10px;
      align-items:center;
      padding: 11px 14px;
      border-radius: 12px;
      border: 1px solid rgba(255,255,255,0.15);
      background: rgba(78,142,162,0.95);
      color:#fff;
      font-weight: 900;
      cursor:pointer;
    }
    .btn-primary:hover{ filter: brightness(1.05); }

    .btn-ghost{
      display:inline-flex;
      gap:10px;
      align-items:center;
      padding: 11px 14px;
      border-radius: 12px;
      border: 1px solid rgba(255,255,255,0.16);
      background: rgba(255,255,255,0.08);
      color:#fff;
      font-weight: 900;
      cursor:pointer;
    }
    .btn-ghost:hover{ background: rgba(255,255,255,0.12); }
  </style>
</head>

<body>
<div class="container">

  <!-- SIDEBAR ADMIN -->
  <div class="sidebar">
    <div class="sidebar-header">
      <i class="fas fa-user-shield"></i>
      <h3>Admin</h3>
    </div>

    <nav>
      <ul class="nav-menu">
        <li class="nav-item">
          <a href="<?= site_url('pelatihan/pelatihan') ?>"
             class="nav-link <?= ($this->uri->segment(2) == 'pelatihan') ? 'active' : '' ?>">
            <i class="fas fa-home"></i><span>Dashboard</span>
          </a>
        </li>

        <li class="nav-item">
          <a href="<?= site_url('pelatihan/admin/verifikasi_list') ?>"
             class="nav-link <?= ($this->uri->segment(2) == 'admin' && $this->uri->segment(3) == 'verifikasi_list') ? 'active' : '' ?>">
            <i class="fas fa-file-signature"></i><span>Kelola Formulir</span>
          </a>
        </li>

        <li class="nav-item">
          <a href="<?= site_url('pelatihan/jadwal_seleksi/kelola') ?>"
             class="nav-link <?= ($this->uri->segment(2) == 'jadwal_seleksi' && $this->uri->segment(3) == 'kelola') ? 'active' : '' ?>">
            <i class="fas fa-calendar-alt"></i><span>Kelola Jadwal</span>
          </a>
        </li>

        <li class="nav-item">
          <a href="<?= site_url('pelatihan/berkas/kelola') ?>"
             class="nav-link <?= ($this->uri->segment(2) == 'berkas' && $this->uri->segment(3) == 'kelola') ? 'active' : '' ?>">
            <i class="fas fa-folder-open"></i><span>Kelola Berkas</span>
          </a>
        </li>

        <li class="nav-item">
          <a href="<?= site_url('pelatihan/hasil_seleksi/kirim') ?>"
             class="nav-link <?= ($this->uri->segment(2) == 'hasil_seleksi' && $this->uri->segment(3) == 'kirim') ? 'active' : '' ?>">
            <i class="fas fa-paper-plane"></i><span>Kirim Hasil</span>
          </a>
        </li>
      </ul>
    </nav>

    <div class="logout">
      <ul class="nav-menu">
        <li class="nav-item">
          <a href="<?= site_url('pelatihan/auth/logout') ?>" class="nav-link">
            <i class="fas fa-sign-out-alt"></i><span>Logout</span>
          </a>
        </li>
      </ul>
    </div>
  </div>

  <!-- CONTENT -->
  <div class="content">
    <div class="content-header">
      <h1>Kirim Hasil Seleksi</h1>
      <p>Set hasil seleksi peserta + kirim notifikasi</p>
    </div>

    <div class="card">
      <div class="card-header">
        <h3 class="card-title"><i class="fas fa-bell"></i> Form Hasil Seleksi</h3>
        <span class="badge info">Admin</span>
      </div>

      <?php if ($this->session->flashdata('success')): ?>
        <div class="alert"><?= $this->session->flashdata('success') ?></div>
      <?php endif; ?>

      <?php if ($this->session->flashdata('error')): ?>
        <div class="alert error"><?= $this->session->flashdata('error') ?></div>
      <?php endif; ?>

      <form method="post" action="<?= site_url('pelatihan/hasil_seleksi/simpan') ?>" class="form-wrap">

        <div class="form-row">
          <!-- kalau nanti controller kirim list pendaftaran, dropdown ini bisa dipakai -->
          <div class="form-group">
            <label><i class="fas fa-file-lines"></i> ID Pendaftaran (opsional)</label>
            <input class="form-control" type="number" name="id_pendaftaran" placeholder="Contoh: 11">
            <div class="helper">
              Isi jika kamu ingin hasil seleksi menempel ke pendaftaran tertentu.
            </div>
          </div>

          <div class="form-group">
            <label><i class="fas fa-id-badge"></i> ID Peserta</label>
            <input class="form-control" type="number" name="id_peserta" required placeholder="Masukkan ID peserta">
            <div class="helper">
              Wajib. Pastikan sesuai yang ada di database.
            </div>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label><i class="fas fa-award"></i> Status Seleksi</label>
            <select class="form-control" name="status_seleksi" required>
              <option value="menunggu">Menunggu</option>
              <option value="lulus">Lulus</option>
              <option value="tidak lulus">Tidak Lulus</option>
            </select>
            <div class="helper">
              Ini yang akan jadi “hasil seleksi” pada peserta.
            </div>
          </div>

          <div class="form-group">
            <label><i class="fas fa-percent"></i> Nilai / Persentase (opsional)</label>
            <input class="form-control" type="number" name="persentase_lulus" min="0" max="100" placeholder="0 - 100">
            <div class="helper">
              Jika kamu ingin override persentase kelulusan.
            </div>
          </div>
        </div>

        <div class="form-group">
          <label><i class="fas fa-message"></i> Isi Notifikasi (opsional)</label>
          <textarea class="form-control" name="isi_notifikasi"
            placeholder="Kosongkan jika tidak ingin kirim pesan. Contoh: Selamat! Anda LULUS seleksi. Silakan cek jadwal seleksi."></textarea>
          <div class="helper">
            Kalau dikosongkan: sistem tetap bisa menyimpan status seleksi (kalau controller kamu dipakai untuk update pendaftaran).
          </div>
        </div>

        <div class="form-actions">
          <button class="btn-primary" type="submit">
            <i class="fas fa-paper-plane"></i> Simpan & Kirim
          </button>

          <button class="btn-ghost" type="button" onclick="document.querySelector('textarea[name=isi_notifikasi]').value='Selamat! Anda LULUS seleksi. Silakan cek menu Jadwal Seleksi untuk info lokasi & waktu.';">
            <i class="fas fa-wand-magic-sparkles"></i> Isi Template Lulus
          </button>

          <button class="btn-ghost" type="button" onclick="document.querySelector('textarea[name=isi_notifikasi]').value='Terima kasih sudah mengikuti seleksi. Saat ini Anda dinyatakan TIDAK LULUS. Tetap semangat dan coba lagi.';">
            <i class="fas fa-wand-magic-sparkles"></i> Isi Template Tidak Lulus
          </button>
        </div>

      </form>
    </div>
  </div>

</div>
</body>
</html>
