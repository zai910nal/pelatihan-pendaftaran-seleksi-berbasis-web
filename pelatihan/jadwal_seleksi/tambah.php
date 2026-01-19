<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Tambah Jadwal Seleksi</title>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="/codelingter/assets/css/ui-dashboard.css">

<style>
  label{display:block;margin:10px 0 6px;color:#BDD8E9;font-weight:700}
  input,select{
    width:100%;padding:12px;border-radius:12px;border:none;
    background:rgba(255,255,255,.15);color:black
  }
  button{
    margin-top:15px;width:100%;padding:12px;border:none;border-radius:12px;
    background:#4E8EA2;color:#fff;font-weight:800;cursor:pointer
  }
  button:hover{filter:brightness(1.05)}
  .alert{padding:12px 14px;border-radius:12px;margin:0 0 14px 0;font-weight:700;border:1px solid rgba(255,255,255,0.18)}
  .alert.error{background: rgba(239,68,68,0.18); color:#fee2e2;}
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
          <a href="<?= site_url('pelatihan/pelatihan') ?>" class="nav-link">
            <i class="fas fa-home"></i><span>Dashboard</span>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?= site_url('pelatihan/jadwal_seleksi/kelola') ?>" class="nav-link active">
            <i class="fas fa-calendar-alt"></i><span>Kelola Jadwal</span>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?= site_url('pelatihan/auth/logout') ?>" class="nav-link">
            <i class="fas fa-sign-out-alt"></i><span>Logout</span>
          </a>
        </li>
      </ul>
    </nav>
  </div>

  <!-- CONTENT -->
  <div class="content">
    <div class="content-header">
      <h1>Tambah Jadwal Seleksi</h1>
      <p>Jadwal dibuat per peserta/pendaftaran</p>
    </div>

    <?php if ($this->session->flashdata('error')): ?>
      <div class="alert error"><?= $this->session->flashdata('error') ?></div>
    <?php endif; ?>

    <div class="card">
      <div class="card-header">
        <h3 class="card-title"><i class="fas fa-plus"></i> Form Jadwal</h3>
        <span class="badge info">Admin</span>
      </div>

      <form method="post" action="<?= site_url('pelatihan/jadwal_seleksi/simpan') ?>">
        <label>Pilih Peserta (berdasarkan pendaftaran)</label>
        <select name="id_pendaftaran" required>
          <option value="">-- Pilih Peserta --</option>
          <?php if (!empty($pendaftaran)): foreach($pendaftaran as $d): ?>
            <option value="<?= $d->id_pendaftaran ?>">
              #<?= $d->id_pendaftaran ?> - <?= htmlspecialchars($d->nama_lengkap) ?> (<?= htmlspecialchars($d->nama_pelatihan) ?>)
            </option>
          <?php endforeach; endif; ?>
        </select>

        <label>Tanggal Seleksi</label>
        <input type="date" name="tanggal_seleksi" required>

        <label>Jam Seleksi (opsional)</label>
        <input type="time" name="jam_seleksi">

        <label>Lokasi</label>
        <input type="text" name="lokasi" placeholder="Contoh: Ruang Lab / Zoom" required>

        <button type="submit"><i class="fas fa-save"></i> Simpan</button>
      </form>
    </div>
  </div>

</div>
</body>
</html>
