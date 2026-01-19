<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Jadwal Seleksi</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="/codelingter/assets/css/ui-dashboard.css">

  <style>
    .alert{
      padding:12px 14px;border-radius:12px;margin:0 0 14px 0;font-weight:700;
      border:1px solid rgba(255,255,255,0.18);backdrop-filter: blur(10px);
    }
    .alert.success{ background: rgba(16,185,129,0.18); color:#d1fae5; }
    .alert.error{ background: rgba(239,68,68,0.18); color:#fee2e2; }

    .meta-row{ display:flex; gap:14px; flex-wrap:wrap; margin-top:8px; opacity:.92; }

    .btn-action{
      display:inline-flex; gap:8px; align-items:center;
      padding:9px 12px; border-radius:12px;
      background: rgba(255,255,255,0.10);
      color:#fff; font-weight:800; text-decoration:none;
      border:1px solid rgba(255,255,255,0.14);
      margin-left:8px;
    }
    .btn-action:hover{ background: rgba(255,255,255,0.16); }
    .btn-done{ background: rgba(16,185,129,0.20); border-color: rgba(16,185,129,0.25); }
    .btn-done:hover{ background: rgba(16,185,129,0.26); }
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
        <li class="nav-item">
          <a href="<?= site_url('pelatihan/pelatihan') ?>" class="nav-link">
            <i class="fas fa-home"></i><span>Dashboard</span>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?= site_url('pelatihan/pendaftaran') ?>" class="nav-link">
            <i class="fas fa-user-plus"></i><span>Pendaftaran</span>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?= site_url('pelatihan/jadwal_seleksi') ?>" class="nav-link active">
            <i class="fas fa-calendar-alt"></i><span>Jadwal Seleksi</span>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?= site_url('pelatihan/hasil_seleksi') ?>" class="nav-link">
            <i class="fas fa-chart-line"></i><span>Hasil Seleksi</span>
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
      <h1>Jadwal Seleksi</h1>
      <p>Jadwal seleksi sesuai pendaftaran kamu</p>
    </div>

    <?php if ($this->session->flashdata('success')): ?>
      <div class="alert success"><?= $this->session->flashdata('success') ?></div>
    <?php endif; ?>
    <?php if ($this->session->flashdata('error')): ?>
      <div class="alert error"><?= $this->session->flashdata('error') ?></div>
    <?php endif; ?>

    <div class="card">
      <div class="card-header">
        <h3 class="card-title"><i class="fas fa-calendar-check"></i> Jadwal Kamu</h3>
        <span class="badge info"><i class="fas fa-info-circle"></i> Info</span>
      </div>

      <div class="list">
        <?php if (!empty($jadwal)): ?>
          <?php foreach ($jadwal as $j): ?>
            <?php
              $tglRaw   = $j->tanggal_seleksi ?? '';
              $tglTs    = $tglRaw ? strtotime($tglRaw) : null;
              $tglView  = $tglTs ? date('d M Y', $tglTs) : '-';

              $jamRaw   = $j->jam_seleksi ?? '';
              $jamView  = $jamRaw ? date('H:i', strtotime($jamRaw)).' WIB' : '-';

              $lokasi   = $j->lokasi ?? '-';
              $pelatihan= $j->nama_pelatihan ?? 'Pelatihan';

              $statusHadir = strtolower($j->status_hadir ?? 'belum');

              // Badge jadwal: MENUNGGU / TERJADWAL / LEWAT
              $today = strtotime(date('Y-m-d'));
              if (!$tglTs) { $badgeClass='warning'; $badgeText='MENUNGGU'; }
              elseif ($tglTs >= $today) { $badgeClass='info'; $badgeText='TERJADWAL'; }
              else { $badgeClass='success'; $badgeText='LEWAT'; }
            ?>

            <div class="list-item">
              <div class="list-item-header">
                <div class="list-item-title">
                  <i class="fas fa-bookmark" style="opacity:.85;"></i>
                  <?= htmlspecialchars($pelatihan) ?>
                </div>

                <div style="display:flex; align-items:center;">
                  <span class="badge <?= $badgeClass ?>"><?= $badgeText ?></span>

                  <?php if ($statusHadir === 'sudah'): ?>
                    <span class="badge success" style="margin-left:8px;">
                      <i class="fas fa-check"></i> SELESAI
                    </span>
                  <?php else: ?>
                    <a class="btn-action btn-done"
                       href="<?= site_url('pelatihan/jadwal_seleksi/selesai/'.$j->id_jadwal) ?>"
                       onclick="return confirm('Yakin kamu sudah mengikuti seleksi?')">
                      <i class="fas fa-check-circle"></i> Saya sudah seleksi
                    </a>
                  <?php endif; ?>
                </div>
              </div>

              <div class="meta-row">
                <span><i class="fas fa-calendar"></i> <?= $tglView ?></span>
                <span><i class="fas fa-clock"></i> <?= $jamView ?></span>
                <span><i class="fas fa-map-marker-alt"></i> <?= htmlspecialchars($lokasi) ?></span>
              </div>

              <div class="list-item-meta" style="margin-top:8px;">
                <?php if ($statusHadir === 'sudah'): ?>
                  <span><i class="fas fa-check"></i> Status: Sudah seleksi</span>
                <?php else: ?>
                  <span><i class="fas fa-hourglass-half"></i> Status: Belum seleksi</span>
                <?php endif; ?>
              </div>
            </div>

          <?php endforeach; ?>
        <?php else: ?>
          <div class="card" style="margin:0;">
            <div class="card-header" style="margin-bottom:.75rem;">
              <h3 class="card-title"><i class="fas fa-circle-exclamation"></i> Belum ada jadwal</h3>
            </div>
            <p style="opacity:.85;">Jadwal seleksi kamu belum diterbitkan oleh admin/panitia.</p>
          </div>
        <?php endif; ?>
      </div>
    </div>

  </div>
</div>

</body>
</html>
