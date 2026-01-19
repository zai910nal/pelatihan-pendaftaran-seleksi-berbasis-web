<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Verifikasi Pendaftaran</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="/codelingter/assets/css/ui-dashboard.css">

  <style>
    /* Area page */
    .page-title{
      font-size: 34px;
      font-weight: 800;
      margin: 0 0 10px 0;
      color: #fff;
    }
    .page-subtitle{
      margin: 0 0 18px 0;
      color: rgba(255,255,255,0.75);
    }

    /* Flash message */
    .alert{
      padding: 12px 14px;
      border-radius: 12px;
      margin: 0 0 14px 0;
      font-weight: 600;
      border: 1px solid rgba(255,255,255,0.18);
      backdrop-filter: blur(8px);
    }
    .alert.success{ background: rgba(16,185,129,0.18); color: #d1fae5; }
    .alert.error{ background: rgba(239,68,68,0.18); color: #fee2e2; }

    /* Table wrap */
    .table-wrap{
      margin-top: 10px;
      background: rgba(255,255,255,0.08);
      border: 1px solid rgba(255,255,255,0.15);
      border-radius: 14px;
      overflow: hidden;
      backdrop-filter: blur(10px);
    }

    table{
      width: 100%;
      border-collapse: collapse;
    }

    thead th{
      background: rgba(255,255,255,0.92);
      color: #0f172a;
      font-weight: 800;
      padding: 14px 12px;
      text-align: left;
      border-bottom: 1px solid rgba(0,0,0,0.10);
      font-size: 14px;
      white-space: nowrap;
    }

    tbody td{
      padding: 14px 12px;
      color: rgba(255,255,255,0.92);
      border-bottom: 1px solid rgba(255,255,255,0.10);
      font-size: 14px;
      vertical-align: middle;
    }

    tbody tr:hover td{
      background: rgba(255,255,255,0.06);
    }

    thead th + th,
    tbody td + td{
      border-left: 1px solid rgba(255,255,255,0.10);
    }

    th.col-no, td.col-no{ width: 70px; text-align:center; }
    th.col-aksi, td.col-aksi{ width: 240px; text-align:center; }

    /* Badge status */
    .badge{
      display: inline-flex;
      align-items: center;
      padding: 6px 12px;
      border-radius: 999px;
      font-size: 12px;
      font-weight: 800;
      letter-spacing: .3px;
      border: 1px solid rgba(255,255,255,0.18);
      white-space: nowrap;
    }
    .badge.pending{ background: rgba(245,158,11,0.20); color: #ffedd5; }
    .badge.verif{ background: rgba(16,185,129,0.20); color: #d1fae5; }
    .badge.tolak{ background: rgba(239,68,68,0.20); color: #fee2e2; }

    /* Button aksi */
    .btn{
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
      padding: 8px 12px;
      border-radius: 10px;
      font-weight: 800;
      font-size: 12px;
      text-decoration: none;
      border: 1px solid rgba(255,255,255,0.18);
      margin: 2px;
      white-space: nowrap;
    }
    .btn.info{ background: rgba(59,130,246,0.22); color: #dbeafe; }
    .btn.ok{ background: rgba(16,185,129,0.22); color: #d1fae5; }
    .btn.no{ background: rgba(239,68,68,0.22); color: #fee2e2; }

    /* Responsive */
    @media (max-width: 900px){
      thead th, tbody td{ padding: 12px 10px; font-size: 13px; }
      th.col-aksi, td.col-aksi{ width: auto; }
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
      <h1 class="page-title">Verifikasi Pendaftaran</h1>
      <p class="page-subtitle">Kelola pendaftaran peserta dan status verifikasi.</p>
    </div>

    <?php if ($this->session->flashdata('success')): ?>
      <div class="alert success"><?= $this->session->flashdata('success') ?></div>
    <?php endif; ?>

    <?php if ($this->session->flashdata('error')): ?>
      <div class="alert error"><?= $this->session->flashdata('error') ?></div>
    <?php endif; ?>

    <div class="card">
      <div class="card-header">
        <h3 class="card-title"><i class="fas fa-list-check"></i> Daftar Pendaftaran</h3>
        <span class="badge menunggu">Review</span>
      </div>

      <div class="table-wrap">
        <table>
          <thead>
            <tr>
              <th class="col-no">No</th>
              <th>Nama</th>
              <th>Email</th>
              <th>Pelatihan</th>
              <th>Status</th>
              <th>Tanggal</th>
              <th class="col-aksi">Aksi</th>
            </tr>
          </thead>

          <tbody>
          <?php if(!empty($rows)): $no=1; foreach($rows as $r): ?>
            <tr>
              <td class="col-no"><?= $no++ ?></td>
              <td><?= htmlspecialchars($r->nama_lengkap) ?></td>
              <td><?= htmlspecialchars($r->email) ?></td>
              <td><?= htmlspecialchars($r->nama_pelatihan ?? '-') ?></td>

              <td>
                <?php
                  $st = $r->status_verifikasi;

                  if ($st == 'menunggu') {
                    echo '<span class="badge pending">Menunggu</span>';
                  } elseif ($st == 'diterima') {
                    echo '<span class="badge verif">Diterima</span>';
                  } elseif ($st == 'ditolak') {
                    echo '<span class="badge tolak">Ditolak</span>';
                  } else {
                   echo '<span class="badge pending">'.htmlspecialchars($st).'</span>';
                  }

                ?>
              </td>

              <td><?= htmlspecialchars($r->tanggal_daftar) ?></td>

              <td class="col-aksi">
                <a class="btn info" href="<?= site_url('pelatihan/admin/verifikasi_detail/'.$r->id_pendaftaran) ?>">
                  <i class="fas fa-eye"></i> Detail
                </a>

                <a class="btn ok"
                   href="<?= site_url('pelatihan/admin/verifikasi/'.$r->id_pendaftaran) ?>"
                   onclick="return confirm('Verifikasi pendaftaran ini?')">
                  <i class="fas fa-check"></i> Verifikasi
                </a>

                <a class="btn no"
                   href="<?= site_url('pelatihan/admin/verifikasi_tolak/'.$r->id_pendaftaran) ?>"
                   onclick="return confirm('Tolak pendaftaran ini?')">
                  <i class="fas fa-xmark"></i> Tolak
                </a>
              </td>
            </tr>
          <?php endforeach; else: ?>
            <tr>
              <td colspan="7" style="text-align:center; padding: 18px; color: rgba(255,255,255,0.85);">
                Belum ada pendaftaran.
              </td>
            </tr>
          <?php endif; ?>
          </tbody>
        </table>
      </div>

    </div>
  </div>
</div>
</body>
</html>
