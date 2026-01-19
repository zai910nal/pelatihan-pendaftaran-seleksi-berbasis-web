<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kelola Berkas</title>

  <!-- WAJIB biar ikon muncul -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="/codelingter/assets/css/ui-dashboard.css">

  <style>
    /* Rapihin tabel agar konsisten dengan dashboard */
    .table-wrap{
      margin-top: 12px;
      background: rgba(255,255,255,0.08);
      border: 1px solid rgba(255,255,255,0.15);
      border-radius: 14px;
      overflow: hidden;
      backdrop-filter: blur(10px);
    }
    table{ width:100%; border-collapse: collapse; }
    thead th{
      background: rgba(255,255,255,0.92);
      color:#0f172a;
      font-weight:800;
      padding:14px 12px;
      text-align:left;
      font-size:14px;
      border-bottom:1px solid rgba(0,0,0,0.10);
      white-space: nowrap;
    }
    tbody td{
      padding:14px 12px;
      color: rgba(255,255,255,0.92);
      border-bottom:1px solid rgba(255,255,255,0.10);
      font-size:14px;
      vertical-align: middle;
    }
    tbody tr:hover td{ background: rgba(255,255,255,0.06); }
    thead th + th, tbody td + td{ border-left:1px solid rgba(255,255,255,0.10); }

    /* Form kecil di kolom aksi */
    .mini-form{
      display:flex;
      gap:10px;
      align-items:center;
      justify-content:flex-start;
      flex-wrap: wrap;
    }
    select{
      padding:10px 12px;
      border-radius:10px;
      border:1px solid rgba(255,255,255,0.18);
      background: rgba(255,255,255,0.12);
      color:#fff;
      outline:none;
      min-width: 180px;
    }
    option{ color:#0f172a; } /* tulisan option biar terbaca */

    button{
      padding:10px 12px;
      border:none;
      border-radius:10px;
      background: rgba(78,142,162,0.95);
      color:#fff;
      font-weight:800;
      cursor:pointer;
    }
    button:hover{ filter: brightness(1.05); }

    .alert{
      padding:12px 14px;
      border-radius:12px;
      margin:0 0 14px 0;
      font-weight:700;
      border: 1px solid rgba(255,255,255,0.18);
      background: rgba(16,185,129,0.18);
      color:#d1fae5;
    }
    .alert.error{
      background: rgba(239,68,68,0.18);
      color:#fee2e2;
    }

    .file-link{
      display:inline-flex;
      gap:8px;
      align-items:center;
      text-decoration:none;
      color:#dbeafe;
      font-weight:800;
    }
    .file-link:hover{ text-decoration: underline; }

    .badge{
      display:inline-flex;
      align-items:center;
      gap:8px;
      padding:.45rem .85rem;
      border-radius:999px;
      font-size:.75rem;
      font-weight:900;
      letter-spacing:.04em;
      border:1px solid rgba(255,255,255,0.15);
      color:#fff;
      background:rgba(255,255,255,0.10);
      white-space: nowrap;
    }
    .badge.success{background:rgba(16,185,129,0.25);}
    .badge.warning{background:rgba(245,158,11,0.25);}
    .badge.info{background:rgba(123,189,232,0.22);}

    .muted{ color: rgba(255,255,255,0.75); }

    @media(max-width: 900px){
      .mini-form{ flex-direction: column; align-items: flex-start; }
      select{ min-width: 220px; width: 100%; }
      button{ width: 100%; }
    }
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
      <h1>Kelola Berkas</h1>
      <p>Verifikasi berkas peserta (Valid / Belum Valid)</p>
    </div>

    <div class="card">
      <div class="card-header">
        <h3 class="card-title"><i class="fas fa-folder-open"></i> Daftar Berkas</h3>
        <span class="badge info">Admin</span>
      </div>

      <?php if ($this->session->flashdata('success')): ?>
        <div class="alert"><?= $this->session->flashdata('success') ?></div>
      <?php endif; ?>

      <?php if ($this->session->flashdata('error')): ?>
        <div class="alert error"><?= $this->session->flashdata('error') ?></div>
      <?php endif; ?>

      <div class="table-wrap">
        <table>
          <thead>
            <tr>
              <th>ID Berkas</th>
              <th>ID Peserta</th>
              <th>Nama Berkas</th>
              <th>File</th>
              <th>Status</th>
              <th>Ubah Status</th>
            </tr>
          </thead>

          <tbody>
          <?php if(empty($berkas)): ?>
            <tr>
              <td colspan="6" style="text-align:center; padding:18px; color: rgba(255,255,255,0.88);">
                Belum ada berkas.
              </td>
            </tr>
          <?php else: foreach($berkas as $b): ?>
            <?php
              $st = strtolower(trim($b->status_berkas ?? 'tidak_valid'));
              $isValid = ($st === 'valid');

              // label tampil (buat manusia)
              $statusLabel = $isValid ? 'Valid (Terverifikasi)' : 'Belum Valid';
              $statusBadge = $isValid ? 'success' : 'warning';

              $fileUrl = !empty($b->file_path) ? base_url($b->file_path) : null;
            ?>
            <tr>
              <td><?= (int)$b->id_berkas ?></td>
              <td><?= (int)$b->id_peserta ?></td>
              <td><?= htmlspecialchars($b->nama_berkas ?? '-') ?></td>

              <td>
                <?php if ($fileUrl): ?>
                  <a class="file-link" href="<?= htmlspecialchars($fileUrl) ?>" target="_blank">
                    <i class="fas fa-eye"></i> Lihat
                  </a>
                <?php else: ?>
                  <span class="muted">-</span>
                <?php endif; ?>
              </td>

              <td>
                <span class="badge <?= $statusBadge ?>">
                  <i class="fas <?= $isValid ? 'fa-check-circle' : 'fa-hourglass-half' ?>"></i>
                  <?= htmlspecialchars($statusLabel) ?>
                </span>
              </td>

              <td>
                <form class="mini-form" method="post" action="<?= site_url('pelatihan/berkas/verifikasi/'.$b->id_berkas) ?>">
                  <!-- PENTING: value harus sesuai ENUM DB: valid / tidak_valid -->
                  <select name="status_berkas" required>
                    <option value="tidak_valid" <?= ($st==='tidak_valid')?'selected':'' ?>>Belum Valid</option>
                    <option value="valid" <?= ($st==='valid')?'selected':'' ?>>Valid (Terverifikasi)</option>
                  </select>

                  <button type="submit"><i class="fas fa-save"></i> Simpan</button>
                </form>
              </td>
            </tr>
          <?php endforeach; endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>
</body>
</html>
