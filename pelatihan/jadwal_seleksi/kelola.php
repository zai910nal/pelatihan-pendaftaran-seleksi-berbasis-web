<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kelola Jadwal Seleksi</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="/codelingter/assets/css/ui-dashboard.css">

  <style>
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

    .alert{
      padding:12px 14px;
      border-radius:12px;
      margin:0 0 14px 0;
      font-weight:700;
      border: 1px solid rgba(255,255,255,0.18);
      background: rgba(16,185,129,0.18);
      color:#d1fae5;
    }
    .alert.error{ background: rgba(239,68,68,0.18); color:#fee2e2; }

    .btn-primary{
      display:inline-flex; gap:10px; align-items:center;
      padding:10px 14px; border-radius:12px;
      background: rgba(78,142,162,0.95);
      color:#fff; font-weight:800; text-decoration:none;
      border: 1px solid rgba(255,255,255,0.15);
    }
    .btn-primary:hover{ filter: brightness(1.05); }

    .btn-action{
      display:inline-flex; gap:8px; align-items:center;
      padding:9px 12px; border-radius:12px;
      background: rgba(255,255,255,0.10);
      color:#fff; font-weight:800; text-decoration:none;
      border: 1px solid rgba(255,255,255,0.14);
      margin-right:8px;
    }
    .btn-action:hover{ background: rgba(255,255,255,0.16); }
    .btn-danger{
      background: rgba(239,68,68,0.20);
      border-color: rgba(239,68,68,0.22);
    }
    .btn-danger:hover{ background: rgba(239,68,68,0.28); }
    .actions{ white-space: nowrap; }
    small{ opacity:.85; }
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
             class="nav-link active">
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
      <h1>Kelola Jadwal Seleksi</h1>
      <p>Jadwal dibuat per peserta/pendaftaran (bisa beda jadwal & lokasi)</p>
    </div>

    <div class="card">
      <div class="card-header">
        <h3 class="card-title"><i class="fas fa-calendar-check"></i> Data Jadwal</h3>
        <span class="badge info">Admin</span>
      </div>

      <?php if ($this->session->flashdata('success')): ?>
        <div class="alert"><?= $this->session->flashdata('success') ?></div>
      <?php endif; ?>
      <?php if ($this->session->flashdata('error')): ?>
        <div class="alert error"><?= $this->session->flashdata('error') ?></div>
      <?php endif; ?>

      <a class="btn-primary" href="<?= site_url('pelatihan/jadwal_seleksi/tambah') ?>">
        <i class="fas fa-plus"></i> Tambah Jadwal
      </a>

      <div class="table-wrap">
        <table>
          <thead>
            <tr>
              <th>Peserta</th>
              <th>Pelatihan</th>
              <th>Tanggal</th>
              <th>Jam</th>
              <th>Lokasi</th>
              <th>Status</th>
              <th style="width:220px;text-align:center;">Aksi</th>
            </tr>
          </thead>
          <tbody>
          <?php if (empty($jadwal)): ?>
            <tr>
              <td colspan="7" style="text-align:center; padding:18px;">Belum ada jadwal.</td>
            </tr>
          <?php else: foreach($jadwal as $j): ?>
            <?php $hadir = strtolower($j->status_hadir ?? 'belum'); ?>
            <tr>
              <td>
                <?= htmlspecialchars($j->nama_lengkap ?? '-') ?><br>
                <small><?= htmlspecialchars($j->email ?? '-') ?></small>
              </td>
              <td><?= htmlspecialchars($j->nama_pelatihan ?? '-') ?></td>
              <td><?= htmlspecialchars($j->tanggal_seleksi ?? '-') ?></td>
              <td><?= htmlspecialchars($j->jam_seleksi ?? '-') ?></td>
              <td><?= htmlspecialchars($j->lokasi ?? '-') ?></td>
              <td>
                <?php if ($hadir === 'sudah'): ?>
                  <span class="badge success">SUDAH</span>
                <?php else: ?>
                  <span class="badge warning">BELUM</span>
                <?php endif; ?>
              </td>
              <td class="actions" style="text-align:center;">
                <a class="btn-action" href="<?= site_url('pelatihan/jadwal_seleksi/edit/'.$j->id_jadwal) ?>">
                  <i class="fas fa-pen"></i> Edit
                </a>
                <a class="btn-action btn-danger"
                   onclick="return confirm('Hapus jadwal ini?')"
                   href="<?= site_url('pelatihan/jadwal_seleksi/hapus/'.$j->id_jadwal) ?>">
                  <i class="fas fa-trash"></i> Hapus
                </a>
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
