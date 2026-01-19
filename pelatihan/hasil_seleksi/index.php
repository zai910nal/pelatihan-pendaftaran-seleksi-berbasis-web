<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hasil Seleksi</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="/codelingter/assets/css/ui-dashboard.css">

  <style>
    .result-grid{
      display:grid;
      grid-template-columns: 1fr 1.2fr;
      gap: 18px;
    }
    @media(max-width: 1000px){
      .result-grid{ grid-template-columns: 1fr; }
    }
    .muted{ color: rgba(255,255,255,0.70); }

    .kv{
      display:grid;
      grid-template-columns: 170px 1fr;
      gap: 10px;
      margin-top: 10px;
      font-size: 14px;
    }
    .kv div{ padding: 6px 0; border-bottom: 1px solid rgba(255,255,255,0.10); }

    .progress-shell{
      height: 10px;
      background: rgba(255,255,255,0.12);
      border-radius: 999px;
      overflow:hidden;
      margin-top: 10px;
    }
    .progress-fill{
      height: 100%;
      background: linear-gradient(90deg, rgba(123,189,232,1), rgba(78,142,162,1));
      width: 0%;
    }

    .notif-wrap{ display:flex; flex-direction:column; gap: 12px; }
    .notif-item{
      background: rgba(255,255,255,0.08);
      border: 1px solid rgba(255,255,255,0.14);
      border-radius: 14px;
      padding: 12px 14px;
    }
    .notif-head{
      display:flex;
      align-items:center;
      justify-content:space-between;
      gap: 12px;
      margin-bottom: 8px;
    }
    .notif-title{ font-weight: 800; display:flex; align-items:center; gap:8px; }
    .notif-date{ font-size: 13px; color: rgba(255,255,255,0.70); display:flex; align-items:center; gap:8px; }
    .notif-body{ white-space: pre-wrap; line-height: 1.55; color: rgba(255,255,255,0.88); }

    .empty-box{
      padding: 14px;
      border-radius: 14px;
      border: 1px dashed rgba(255,255,255,0.22);
      background: rgba(255,255,255,0.06);
      color: rgba(255,255,255,0.75);
      display:flex;
      align-items:center;
      gap: 10px;
      font-weight: 700;
    }

    /* ✅ tambahan supaya badge danger pasti ada */
    .badge.danger{
      background: rgba(239,68,68,0.22);
      border: 1px solid rgba(239,68,68,0.30);
      color: #fff;
    }
  </style>
</head>
<body>

<div class="container">

  <!-- SIDEBAR PESERTA -->
  <div class="sidebar">
    <div class="sidebar-header">
      <i class="fas fa-graduation-cap"></i>
      <h3>Peserta</h3>
    </div>

    <nav>
      <ul class="nav-menu">
        <li class="nav-item"><a href="<?= site_url('pelatihan/pelatihan') ?>" class="nav-link"><i class="fas fa-home"></i><span>Dashboard</span></a></li>
        <li class="nav-item"><a href="<?= site_url('pelatihan/pendaftaran') ?>" class="nav-link"><i class="fas fa-user-plus"></i><span>Pendaftaran</span></a></li>
        <li class="nav-item"><a href="<?= site_url('pelatihan/jadwal_seleksi') ?>" class="nav-link"><i class="fas fa-calendar-alt"></i><span>Jadwal Seleksi</span></a></li>
        <li class="nav-item"><a href="<?= site_url('pelatihan/hasil_seleksi') ?>" class="nav-link active"><i class="fas fa-chart-line"></i><span>Hasil Seleksi</span></a></li>
      </ul>
    </nav>

    <div class="logout">
      <ul class="nav-menu">
        <li class="nav-item"><a href="<?= site_url('pelatihan/auth/logout') ?>" class="nav-link"><i class="fas fa-sign-out-alt"></i><span>Logout</span></a></li>
      </ul>
    </div>
  </div>

  <!-- CONTENT -->
  <div class="content">
    <div class="content-header">
      <h1>Hasil Seleksi</h1>
      <p>Pengumuman hasil seleksi berdasarkan pendaftaran Anda</p>
    </div>

    <div class="result-grid">

      <!-- STATUS SELEKSI -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title"><i class="fas fa-award"></i> Status Seleksi</h3>
          <span class="badge info">Update</span>
        </div>

        <?php if (!empty($pendaftaran)): ?>
          <?php
            $raw = strtolower(trim($pendaftaran->status_seleksi ?? 'menunggu'));
            if ($raw === '' || $raw === 'null') $raw = 'menunggu';

            // default
            $badgeClass = 'warning';
            $badgeText  = 'MENUNGGU TES';
            $headline   = 'Menunggu Tes';
            $desc       = 'Pantau jadwal seleksi dan hasil seleksi.';

            if (in_array($raw, ['lulus','diterima','pass'])) {
              $badgeClass = 'success';
              $badgeText  = 'LULUS';
              $headline   = 'Selamat! Anda Lulus';
              $desc       = 'Silakan lanjut mengikuti tahapan berikutnya sesuai jadwal.';
            } elseif (in_array($raw, ['tidak lulus','gagal','ditolak','fail'])) {
              $badgeClass = 'danger';
              $badgeText  = 'TIDAK LULUS';
              $headline   = 'Belum Lulus';
              $desc       = 'Terima kasih sudah mendaftar. Tetap semangat dan coba lagi.';
            }

            $persen = (int)($pendaftaran->persentase_lulus ?? 0);
            if ($persen < 0) $persen = 0;
            if ($persen > 100) $persen = 100;
          ?>

          <h2 style="margin:8px 0 6px;"><?= htmlspecialchars($headline) ?></h2>
          <p class="muted" style="margin:0;"><?= htmlspecialchars($desc) ?></p>

          <div style="margin-top:14px;">
            <span class="badge <?= $badgeClass ?>"><?= htmlspecialchars($badgeText) ?></span>
          </div>

          <div class="muted" style="margin-top:14px; font-weight:800;">
            Peluang / Nilai: <?= $persen ?>%
          </div>
          <div class="progress-shell">
            <div class="progress-fill" style="width:<?= $persen ?>%;"></div>
          </div>

        <?php else: ?>
          <div class="empty-box">
            <i class="fas fa-circle-info"></i>
            Belum ada pendaftaran. Silakan daftar pelatihan terlebih dahulu.
          </div>
        <?php endif; ?>
      </div>

      <!-- RINGKASAN + NOTIFIKASI -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title"><i class="fas fa-clipboard-list"></i> Ringkasan & Notifikasi</h3>
          <span class="badge info">Info</span>
        </div>

        <?php if (!empty($pendaftaran)): ?>
          <?php
            // ⚠️ nama_pelatihan mungkin tidak ada kalau model belum join
            $namaPel = $pendaftaran->nama_pelatihan ?? null;
            if (!$namaPel) {
              $namaPel = !empty($pendaftaran->id_pelatihan)
                ? 'Pelatihan (ID: '.$pendaftaran->id_pelatihan.')'
                : '-';
            }

            $statusVer = strtolower(trim($pendaftaran->status_verifikasi ?? 'menunggu'));
            if ($statusVer === '' || $statusVer === 'null') $statusVer = 'menunggu';

            $badgeVerClass = 'warning';
            $badgeVerText  = 'MENUNGGU';

            if (in_array($statusVer, ['diterima','terverifikasi','verified','approve','approved'])) {
              $badgeVerClass = 'success'; $badgeVerText = 'TERVERIFIKASI';
            } elseif (in_array($statusVer, ['ditolak','rejected','reject'])) {
              $badgeVerClass = 'danger'; $badgeVerText = 'DITOLAK';
            }
          ?>

          <div class="kv">
            <div class="muted"><b>Pelatihan</b></div><div><?= htmlspecialchars($namaPel) ?></div>
            <div class="muted"><b>Tanggal Daftar</b></div><div><?= htmlspecialchars($pendaftaran->tanggal_daftar ?? '-') ?></div>
            <div class="muted"><b>Status Verifikasi</b></div>
            <div><span class="badge <?= $badgeVerClass ?>"><?= htmlspecialchars($badgeVerText) ?></span></div>
          </div>

          <div style="height:10px;"></div>
          <hr style="border-color: rgba(255,255,255,0.12);">
        <?php endif; ?>

        <h3 style="margin: 0 0 10px; display:flex; align-items:center; gap:10px;">
          <i class="fas fa-bell"></i> Notifikasi
        </h3>

        <div class="notif-wrap">
          <?php if (empty($notifikasi)): ?>
            <div class="empty-box">
              <i class="fas fa-circle-info"></i>
              Belum ada notifikasi.
            </div>
          <?php else: ?>
            <?php foreach ($notifikasi as $n): ?>
              <?php
                $tgl = '-';
                if (!empty($n->created_at)) $tgl = date('d M Y H:i', strtotime($n->created_at));
                elseif (!empty($n->tanggal)) $tgl = date('d M Y', strtotime($n->tanggal));
              ?>
              <div class="notif-item">
                <div class="notif-head">
                  <div class="notif-title">
                    <i class="fas fa-paper-plane"></i> Pesan Seleksi
                  </div>
                  <div class="notif-date">
                    <i class="fas fa-clock"></i> <?= $tgl ?>
                  </div>
                </div>

                <div class="notif-body">
                  <?= nl2br(htmlspecialchars($n->isi_notifikasi ?? '')) ?>
                </div>
              </div>
            <?php endforeach; ?>
          <?php endif; ?>
        </div>

      </div>

    </div>
  </div>

</div>
</body>
</html>
