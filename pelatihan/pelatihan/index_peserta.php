<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Pelatihan</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

  <style>
    /* ============================= */
/* RAPING SPACING DASHBOARD     */
/* ============================= */

/* Jarak dalam list item */
.list-item {
  padding: 1.25rem;
}

/* Judul pelatihan */
.list-item-title {
  margin-bottom: 10px;
  line-height: 1.3;
}

/* Header list */
.list-item-header {
  margin-bottom: 12px;
}

/* Meta info (tanggal, peluang, lokasi, dll) */
.meta {
  gap: 18px;
  margin-top: 6px;
}

/* Meta baris tambahan */
.meta + .meta {
  margin-top: 8px;
}

/* Progress bar spacing */
.progress-bar {
  margin-top: 14px;
}

/* Card Jadwal Seleksi - status text */
.list-item-meta {
  margin-top: 10px;
  opacity: 0.9;
}

/* Info note (teks bantuan) */
.list-item .fa-info-circle {
  margin-right: 6px;
}

/* Badge agar tidak terlalu nempel */
.badge {
  margin-left: 8px;
}

/* Card header spacing */
.card-header {
  margin-bottom: 1.2rem;
}

/* Antar card di kolom */
.card + .card {
  margin-top: 1.2rem;
}

    *{margin:0;padding:0;box-sizing:border-box;}

    :root{
      --primary-color:#2563eb;
      --secondary-color:#3b82f6;
      --accent-color:#60a5fa;
      --success-color:#10b981;
      --warning-color:#f59e0b;
      --danger-color:#ef4444;
      --sidebar-bg:#f8fafc;
      --card-bg:#ffffff;
      --text-primary:#1e293b;
      --text-secondary:#64748b;
      --border-color:#e2e8f0;
      --shadow-md:0 4px 6px -1px rgb(0 0 0 / 0.1);
      --shadow-lg:0 10px 15px -3px rgb(0 0 0 / 0.1);
      --transition:all .25s ease;
    }

    body{
      font-family:system-ui,-apple-system,Segoe UI,Roboto,sans-serif;
      background:linear-gradient(135deg,#001D39,#0A4174);
      min-height:100vh;
      color:var(--text-primary);
    }

    .container{display:flex;min-height:100vh;}

    .sidebar{
      width:280px;
      background:rgba(255,255,255,0.06);
      backdrop-filter:blur(12px);
      border-right:1px solid rgba(255,255,255,0.10);
      padding:2rem;
      color:#fff;
    }
    .sidebar-header{display:flex;align-items:center;gap:12px;margin-bottom:2rem;}
    .sidebar-header i{font-size:1.6rem;color:#7BBDE8;}
    .sidebar h3{font-size:1.25rem;font-weight:800;color:#fff;}

    .nav-menu{list-style:none;}
    .nav-item{margin-bottom:.5rem;}

    .nav-link{
      display:flex;align-items:center;gap:12px;
      padding:.9rem 1rem;
      color:rgba(255,255,255,0.85);
      text-decoration:none;
      border-radius:14px;
      transition:var(--transition);
      border:1px solid rgba(255,255,255,0.10);
      background:rgba(255,255,255,0.04);
    }
    .nav-link:hover{
      transform:translateX(4px);
      background:rgba(123,189,232,0.18);
      border-color:rgba(123,189,232,0.35);
    }
    .nav-link.active{
      background:linear-gradient(135deg,#49769F,#4E8EA2);
      border-color:rgba(255,255,255,0.18);
      box-shadow:var(--shadow-md);
      color:#fff;
    }
    .logout{margin-top:2.5rem;padding-top:1.5rem;border-top:1px solid rgba(255,255,255,0.15);}

    .content{
      flex:1;
      padding:2rem;
      overflow-y:auto;
      color:#fff;
    }

    .content-header{margin-bottom:1.8rem;}
    .content-header h1{font-size:2.2rem;font-weight:900;color:#fff;}
    .content-header p{color:rgba(255,255,255,0.75);margin-top:.4rem;}

    .status-grid{
      display:grid;
      grid-template-columns:repeat(2,minmax(260px,1fr));
      gap:1.2rem;
      margin-bottom:1.6rem;
    }

    .card{
      background:rgba(255,255,255,0.08);
      border:1px solid rgba(255,255,255,0.14);
      backdrop-filter:blur(12px);
      border-radius:18px;
      padding:1.4rem;
      box-shadow:var(--shadow-md);
    }
    .card:hover{box-shadow:var(--shadow-lg);}

    .status-card{position:relative;overflow:hidden;}
    .status-card::before{
      content:"";
      position:absolute;left:0;right:0;top:0;height:3px;
      background:linear-gradient(90deg,#7BBDE8,#4E8EA2);
      opacity:.9;
    }

    .status-header{display:flex;justify-content:space-between;align-items:center;margin-bottom:.9rem;}
    .status-title{font-weight:800;color:rgba(255,255,255,0.9);}
    .status-icon{
      width:44px;height:44px;border-radius:14px;
      display:flex;align-items:center;justify-content:center;
      background:rgba(255,255,255,0.10);
      border:1px solid rgba(255,255,255,0.15);
      color:#fff;
    }

    .status-value{font-size:1.7rem;font-weight:900;margin-bottom:.35rem;color:#fff;}
    .status-description{color:rgba(255,255,255,0.75);font-size:.95rem;}

    .badge{
      display:inline-flex;align-items:center;gap:8px;
      padding:.45rem .85rem;border-radius:999px;
      font-size:.75rem;font-weight:900;letter-spacing:.04em;
      border:1px solid rgba(255,255,255,0.15);
      color:#fff;
      margin-top:.9rem;
      background:rgba(255,255,255,0.10);
    }
    .badge.success{background:rgba(16,185,129,0.25);}
    .badge.warning{background:rgba(245,158,11,0.25);}
    .badge.danger{background:rgba(239,68,68,0.25);}
    .badge.info{background:rgba(123,189,232,0.22);}

    .main-grid{
      display:grid;
      grid-template-columns:2fr 1fr;
      gap:1.2rem;
    }

    .card-header{
      display:flex;align-items:center;justify-content:space-between;
      margin-bottom:1rem;
    }
    .card-title{font-size:1.2rem;font-weight:900;display:flex;align-items:center;gap:10px;}
    .card-title i{color:#7BBDE8;}

    .list{display:flex;flex-direction:column;gap:.85rem;}
    .list-item{
      background:rgba(255,255,255,0.06);
      border:1px solid rgba(255,255,255,0.12);
      padding:1rem;
      border-radius:16px;
    }

    .list-item-header{display:flex;justify-content:space-between;align-items:center;margin-bottom:.55rem;}
    .list-item-title{font-weight:900;color:#fff;}

    .meta{display:flex;gap:1rem;flex-wrap:wrap;color:rgba(255,255,255,0.75);font-size:.9rem;}
    .meta i{color:#7BBDE8;}

    .progress-bar{
      width:100%;height:10px;border-radius:999px;
      background:rgba(255,255,255,0.12);
      overflow:hidden;margin-top:.7rem;
    }
    .progress-fill{
      height:100%;
      width:0%;
      background:linear-gradient(90deg,#7BBDE8,#4E8EA2);
      border-radius:999px;
    }

    .stats-row{display:flex;gap:1.2rem;margin-top:1rem;justify-content:space-between;}
    .stat-item{text-align:center;flex:1;}
    .stat-value{font-size:1.8rem;font-weight:900;color:#7BBDE8;}
    .stat-label{font-size:.9rem;color:rgba(255,255,255,0.75);}

    @media(max-width:1024px){
      .main-grid{grid-template-columns:1fr;}
      .status-grid{grid-template-columns:1fr;}
      .sidebar{width:240px;}
    }
    @media(max-width:800px){
      .sidebar{display:none;}
      .content{padding:1.2rem;}
    }
  </style>
</head>

<body>
<div class="container">

  <!-- SIDEBAR -->
  <div class="sidebar">
    <div class="sidebar-header">
      <i class="fas fa-graduation-cap"></i>
      <h3>Dashboard</h3>
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
          <a href="<?= site_url('pelatihan/pendaftaran') ?>"
             class="nav-link <?= ($this->uri->segment(2) == 'pendaftaran') ? 'active' : '' ?>">
            <i class="fas fa-user-plus"></i><span>Pendaftaran</span>
          </a>
        </li>

        <li class="nav-item">
          <a href="<?= site_url('pelatihan/jadwal_seleksi') ?>"
             class="nav-link <?= ($this->uri->segment(2) == 'jadwal_seleksi') ? 'active' : '' ?>">
            <i class="fas fa-calendar-alt"></i><span>Jadwal Seleksi</span>
          </a>
        </li>

        <li class="nav-item">
          <a href="<?= site_url('pelatihan/hasil_seleksi') ?>"
             class="nav-link <?= ($this->uri->segment(2) == 'hasil_seleksi') ? 'active' : '' ?>">
            <i class="fas fa-chart-line"></i><span>Hasil Seleksi</span>
          </a>
        </li>
      </ul>
    </nav>

    <div class="logout">
      <ul class="nav-menu">
        <li class="nav-item">
          <a href="<?= site_url('pelatihan/auth/logout'); ?>" class="nav-link">
            <i class="fas fa-sign-out-alt"></i><span>Logout</span>
          </a>
        </li>
      </ul>
    </div>
  </div>

  <!-- CONTENT -->
  <div class="content">

    <?php
      // Safety default
      $persen = isset($persentase) ? (int)$persentase : 0;
      if ($persen < 0) $persen = 0;
      if ($persen > 100) $persen = 100;

      $sv = $status_verifikasi_text ?? 'Belum Daftar';
      $ss = $status_seleksi_text ?? 'Belum Ada';

      // badge mapping
      $badgeVerifClass = 'info';
      if (stripos($sv, 'Terverifikasi') !== false) $badgeVerifClass = 'success';
      elseif (stripos($sv, 'Menunggu') !== false) $badgeVerifClass = 'warning';
      elseif (stripos($sv, 'Ditolak') !== false) $badgeVerifClass = 'danger';

      $badgeSeleksiClass = 'info';
      if (stripos($ss, 'Lulus') !== false) $badgeSeleksiClass = 'success';
      elseif (stripos($ss, 'Menunggu') !== false) $badgeSeleksiClass = 'warning';
      elseif (stripos($ss, 'Tidak Lulus') !== false) $badgeSeleksiClass = 'danger';

      $tanggalDaftar = '-';
      $namaPelatihan = 'Belum ada pendaftaran';
      if (!empty($pendaftaran)) {
        $tanggalDaftar = !empty($pendaftaran->tanggal_daftar) ? $pendaftaran->tanggal_daftar : '-';
        $namaPelatihan = $pendaftaran->nama_pelatihan ?? 'Pelatihan';
      }
    ?>

    <div class="content-header">
      <h1>Selamat Datang</h1>
      <p>Pantau status dan progress pendaftaran pelatihan Anda</p>
    </div>

    <!-- STATUS CARDS -->
    <div class="status-grid">
      <div class="card status-card">
        <div class="status-header">
          <div class="status-title">Status Pendaftaran</div>
          <div class="status-icon">
            <i class="fas fa-check-circle"></i>
          </div>
        </div>

        <div class="status-value"><?= htmlspecialchars($sv) ?></div>
        <div class="status-description">
          <?= empty($pendaftaran)
              ? 'Silakan lakukan pendaftaran terlebih dahulu.'
              : 'Status pendaftaran mengikuti hasil verifikasi admin.'; ?>
        </div>

        <span class="badge <?= $badgeVerifClass ?>">
          <i class="fas fa-circle"></i>
          <?= htmlspecialchars($sv) ?>
        </span>
      </div>

      <div class="card status-card">
        <div class="status-header">
          <div class="status-title">Status Seleksi</div>
          <div class="status-icon">
            <i class="fas fa-clock"></i>
          </div>
        </div>

        <div class="status-value"><?= htmlspecialchars($ss) ?></div>
        <div class="status-description">
          <?= empty($pendaftaran)
              ? 'Status seleksi akan muncul setelah kamu mendaftar.'
              : 'Pantau jadwal seleksi dan hasil seleksi.'; ?>
        </div>

        <span class="badge <?= $badgeSeleksiClass ?>">
          <i class="fas fa-circle"></i>
          <?= htmlspecialchars($ss) ?>
        </span>
      </div>
    </div>

    <div class="main-grid">

      <!-- KIRI -->
      <div>
        <div class="card">
          <div class="card-header">
            <h3 class="card-title"><i class="fas fa-clipboard-list"></i> Pendaftaran</h3>
            <span class="badge info"><?= empty($pendaftaran) ? '0 Aktif' : '1 Aktif' ?></span>
          </div>

          <div class="list">
            <?php if (empty($pendaftaran)): ?>
              <div class="list-item">
                <div class="list-item-title">Belum ada pendaftaran</div>
                <div class="meta" style="margin-top:6px;">
                  <span><i class="fas fa-info-circle"></i> Klik menu <b>Pendaftaran</b> untuk mengisi formulir.</span>
                </div>
                <div class="progress-bar"><div class="progress-fill" style="width:0%;"></div></div>
              </div>
            <?php else: ?>
              <div class="list-item">
                <div class="list-item-header">
                  <div class="list-item-title"><?= htmlspecialchars($namaPelatihan) ?></div>
                  <span class="badge <?= $badgeVerifClass ?>"><?= htmlspecialchars($sv) ?></span>
                </div>

                <div class="meta">
                  <span><i class="fas fa-calendar"></i> <?= htmlspecialchars($tanggalDaftar) ?></span>
                  <span><i class="fas fa-percent"></i> Peluang: <?= $persen ?>%</span>
                </div>

                <div class="meta" style="margin-top:8px;">
                  <span><i class="fas fa-file"></i> Berkas: <?= !empty($berkas_ada) ? 'Ada' : 'Tidak ada' ?></span>
                </div>

                <div class="progress-bar">
                  <div class="progress-fill" style="width:<?= $persen ?>%;"></div>
                </div>
              </div>
            <?php endif; ?>
          </div>
        </div>

        <!-- ✅ JADWAL SELEKSI: SUDAH TARIK DARI DB -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title"><i class="fas fa-calendar-check"></i> Jadwal Seleksi</h3>
          </div>

          <div class="list">
            <?php
              $jadwalList = [];
              if (!empty($jadwal)) {
                $jadwalList = is_array($jadwal) ? $jadwal : [$jadwal];
              }
            ?>

            <?php if (empty($jadwalList)): ?>
              <div class="list-item">
                <div class="list-item-title">Belum ada jadwal seleksi</div>
                <div class="meta" style="margin-top:6px;">
                  <span><i class="fas fa-info-circle"></i> Jadwal akan muncul setelah admin/panitia membuat jadwal.</span>
                </div>
              </div>
            <?php else: ?>
              <?php foreach ($jadwalList as $j): ?>
                <?php
                  $tgl = !empty($j->tanggal_seleksi) ? date('d M Y', strtotime($j->tanggal_seleksi)) : '-';
                  $jam = !empty($j->jam_seleksi) ? date('H:i', strtotime($j->jam_seleksi)).' WIB' : '-';
                  $lok = !empty($j->lokasi) ? $j->lokasi : '-';
                  $namaPel = $j->nama_pelatihan ?? 'Pelatihan';

                  $hadir = strtolower(trim($j->status_hadir ?? 'belum'));

                  $badgeJClass = 'info';
                  $badgeJText  = 'TERJADWAL';

                  if (in_array($hadir, ['sudah','hadir','selesai'])) {
                    $badgeJClass = 'success';
                    $badgeJText  = 'SELESAI';
                  } else {
                    if (!empty($j->tanggal_seleksi) && strtotime($j->tanggal_seleksi) < strtotime(date('Y-m-d'))) {
                      $badgeJClass = 'warning';
                      $badgeJText  = 'LEWAT';
                    }
                  }
                ?>

                <div class="list-item">
                  <div class="list-item-header">
                    <div class="list-item-title"><?= htmlspecialchars($namaPel) ?></div>
                    <span class="badge <?= $badgeJClass ?>"><?= $badgeJText ?></span>
                  </div>

                  <div class="meta">
                    <span><i class="fas fa-calendar"></i> <?= htmlspecialchars($tgl) ?></span>
                    <span><i class="fas fa-clock"></i> <?= htmlspecialchars($jam) ?></span>
                    <span><i class="fas fa-map-marker-alt"></i> <?= htmlspecialchars($lok) ?></span>
                  </div>

                  <div class="meta" style="margin-top:8px;">
                    <span>
                      <i class="fas <?= in_array($hadir, ['sudah','hadir','selesai']) ? 'fa-check-circle' : 'fa-hourglass-half' ?>"></i>
                      Status: <?= in_array($hadir, ['sudah','hadir','selesai']) ? 'Sudah seleksi' : 'Belum seleksi' ?>
                    </span>
                    <?php if (!in_array($hadir, ['sudah','hadir','selesai'])): ?>
                      <span><i class="fas fa-info-circle"></i> Setelah tes, klik “Saya sudah seleksi” di menu Jadwal Seleksi.</span>
                    <?php endif; ?>
                  </div>
                </div>
              <?php endforeach; ?>
            <?php endif; ?>

          </div>
        </div>
      </div>

      <!-- KANAN -->
      <div>
        <div class="card">
          <div class="card-header">
            <h3 class="card-title"><i class="fas fa-bell"></i> Notifikasi</h3>
            <span class="badge info">Info</span>
          </div>

          <div class="list">
            <div class="list-item">
              <div class="list-item-title">Status Verifikasi</div>
              <div class="meta" style="margin-top:6px;">
                <span><i class="fas fa-clock"></i> <?= htmlspecialchars($sv) ?></span>
              </div>
            </div>

            <div class="list-item">
              <div class="list-item-title">Peluang Kelulusan</div>
              <div class="meta" style="margin-top:6px;">
                <span><i class="fas fa-percent"></i> <?= $persen ?>%</span>
              </div>
            </div>
          </div>
        </div>

        <div class="card">
          <div class="card-header">
            <h3 class="card-title"><i class="fas fa-tasks"></i> Aktivitas Terbaru</h3>
          </div>

          <?php
            // aktivitas sederhana (estimasi)
            $isiForm = empty($pendaftaran) ? 0 : 100;
            $uploadBerkas = (!empty($pendaftaran) && !empty($berkas_ada)) ? 100 : (empty($pendaftaran) ? 0 : 50);

            // verifikasi admin: kalau diterima 100, menunggu 50, ditolak 100
            $verif = 0;
            if (!empty($pendaftaran)) {
              if ($pendaftaran->status_verifikasi == 'diterima') $verif = 100;
              elseif ($pendaftaran->status_verifikasi == 'menunggu') $verif = 50;
              elseif ($pendaftaran->status_verifikasi == 'ditolak') $verif = 100;
            }

            $total = (int) round(($isiForm + $uploadBerkas + $verif) / 3);
            $doneCount = 0;
            if ($isiForm == 100) $doneCount++;
            if ($uploadBerkas == 100) $doneCount++;
            if ($verif == 100) $doneCount++;
          ?>

          <div class="list">
            <div class="list-item">
              <div class="list-item-header">
                <div class="list-item-title">Isi Formulir</div>
                <span class="badge <?= $isiForm==100?'success':'warning' ?>"><?= $isiForm ?>%</span>
              </div>
              <div class="meta">
                <span><i class="fas <?= $isiForm==100?'fa-check-circle':'fa-hourglass-half' ?>"></i>
                  <?= $isiForm==100?'Selesai':'Belum' ?>
                </span>
              </div>
            </div>

            <div class="list-item">
              <div class="list-item-header">
                <div class="list-item-title">Upload Berkas</div>
                <span class="badge <?= $uploadBerkas==100?'success':'warning' ?>"><?= $uploadBerkas ?>%</span>
              </div>
              <div class="meta">
                <span><i class="fas <?= $uploadBerkas==100?'fa-check-circle':'fa-hourglass-half' ?>"></i>
                  <?= $uploadBerkas==100?'Selesai':'Pending' ?>
                </span>
              </div>
            </div>

            <div class="list-item">
              <div class="list-item-header">
                <div class="list-item-title">Verifikasi Admin</div>
                <span class="badge <?= $verif==100?'success':'warning' ?>"><?= $verif ?>%</span>
              </div>
              <div class="meta">
                <span><i class="fas fa-clock"></i> <?= htmlspecialchars($sv) ?></span>
              </div>
            </div>
          </div>

          <div class="stats-row">
            <div class="stat-item">
              <div class="stat-value"><?= $total ?>%</div>
              <div class="stat-label">Progress Total</div>
            </div>
            <div class="stat-item">
              <div class="stat-value"><?= $doneCount ?>/3</div>
              <div class="stat-label">Tugas Selesai</div>
            </div>
          </div>

        </div>
      </div>

    </div>

  </div>
</div>
</body>
</html>
