<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Admin</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
 <link rel="stylesheet" href="/codelingter/assets/css/ui-dashboard.css">

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
            <i class="fas fa-home"></i>
            <span>Dashboard</span>
          </a>
        </li>

   <nav>
  <ul class="nav-menu">

    <li class="nav-item">
      <a href="<?= site_url('pelatihan/admin/verifikasi_list') ?>" class="nav-link <?= ($this->uri->segment(3) == 'formulir') ? 'active' : '' ?>">
        <i class="fas fa-file-signature"></i><span>Kelola Formulir</span>
      </a>
    </li>

    <li class="nav-item">
      <a href="<?= site_url('pelatihan/jadwal_seleksi/kelola') ?>" class="nav-link <?= ($this->uri->segment(3) == 'jadwal') ? 'active' : '' ?>">
        <i class="fas fa-calendar-alt"></i><span>Kelola Jadwal</span>
      </a>
    </li>

    <li class="nav-item">
      <a href="<?= site_url('pelatihan/berkas/kelola') ?>" class="nav-link <?= ($this->uri->segment(3) == 'berkas') ? 'active' : '' ?>">
        <i class="fas fa-folder-open"></i><span>Kelola Berkas</span>
      </a>
    </li>

    <li class="nav-item">
      <a href="<?= site_url('pelatihan/hasil_seleksi/kirim') ?>" class="nav-link <?= ($this->uri->segment(3) == 'hasil') ? 'active' : '' ?>">
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
    <div class="card">
  <div class="card-header">
    <h3 class="card-title"><i class="fas fa-bolt"></i> Aksi Cepat</h3>
    <span class="badge info">Admin</span>
  </div>

  <div class="list">
    <a class="list-item" href="<?= site_url('pelatihan/admin/verifikasi_list') ?>" style="text-decoration:none; color:inherit;">
      <div class="list-item-header">
        <div class="list-item-title">Kelola Formulir Pendaftaran</div>
        <span class="badge warning">Verifikasi</span>
      </div>
      <div class="list-item-meta">
        <span><i class="fas fa-check-circle"></i> Validasi data peserta</span>
      </div>
    </a>

    <a class="list-item" href="<?= site_url('pelatihan/jadwal_seleksi/kelola') ?>" style="text-decoration:none; color:inherit;">
      <div class="list-item-header">
        <div class="list-item-title">Kelola Jadwal Seleksi</div>
        <span class="badge info">Atur</span>
      </div>
      <div class="list-item-meta">
        <span><i class="fas fa-calendar-plus"></i> Tambah & ubah jadwal</span>
      </div>
    </a>

    <a class="list-item" href="<?= site_url('pelatihan/berkas/kelola') ?>" style="text-decoration:none; color:inherit;">
      <div class="list-item-header">
        <div class="list-item-title">Kelola Berkas Peserta</div>
        <span class="badge info">Cek</span>
      </div>
      <div class="list-item-meta">
        <span><i class="fas fa-file-circle-check"></i> Verifikasi CV/KTP/dll</span>
      </div>
    </a>

    <a class="list-item" href="<?= site_url('pelatihan/hasil_seleksi/kirim') ?>" style="text-decoration:none; color:inherit;">
      <div class="list-item-header">
        <div class="list-item-title">Kirim Hasil Seleksi</div>
        <span class="badge success">Publish</span>
      </div>
      <div class="list-item-meta">
        <span><i class="fas fa-paper-plane"></i> Input nilai & umumkan hasil</span>
      </div>
    </a>
  </div>
</div>
</body>
</html>
