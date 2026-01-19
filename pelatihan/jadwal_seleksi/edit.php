<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit Jadwal Seleksi</title>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="/codelingter/assets/css/ui-dashboard.css">

<style>
  label{display:block;margin:10px 0 6px;color:#BDD8E9;font-weight:700}
  input,select{
    width:100%;padding:12px;border-radius:12px;border:none;
    background:rgba(255,255,255,.15);color:white
  }
  button{
    margin-top:15px;width:100%;padding:12px;border:none;border-radius:12px;
    background:#4E8EA2;color:#fff;font-weight:800;cursor:pointer
  }
  button:hover{filter:brightness(1.05)}
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
      <h1>Edit Jadwal Seleksi</h1>
      <p>Ubah jadwal seleksi peserta</p>
    </div>

    <div class="card">
      <div class="card-header">
        <h3 class="card-title"><i class="fas fa-pen"></i> Form Edit</h3>
        <span class="badge info">Admin</span>
      </div>

      <form method="post" action="<?= site_url('pelatihan/jadwal_seleksi/update/'.$jadwal->id_jadwal) ?>">

        <!-- optional: kalau kamu ingin tetap bisa ubah pendaftaran -->
        <?php if (!empty($pendaftaran)): ?>
          <label>Pendaftaran</label>
          <select name="id_pendaftaran" required>
            <?php foreach($pendaftaran as $d): ?>
              <option value="<?= $d->id_pendaftaran ?>"
                <?= ((int)$d->id_pendaftaran === (int)($jadwal->id_pendaftaran ?? 0)) ? 'selected' : '' ?>>
                #<?= $d->id_pendaftaran ?> - <?= htmlspecialchars($d->nama_lengkap) ?> (<?= htmlspecialchars($d->nama_pelatihan) ?>)
              </option>
            <?php endforeach; ?>
          </select>
        <?php endif; ?>

        <label>Tanggal Seleksi</label>
        <input type="date" name="tanggal_seleksi" value="<?= htmlspecialchars($jadwal->tanggal_seleksi ?? '') ?>" required>

        <label>Jam Seleksi</label>
        <input type="time" name="jam_seleksi" value="<?= htmlspecialchars($jadwal->jam_seleksi ?? '') ?>">

        <label>Lokasi</label>
        <input type="text" name="lokasi" value="<?= htmlspecialchars($jadwal->lokasi ?? '') ?>" required>

        <label>Status Hadir</label>
        <?php $hadir = strtolower($jadwal->status_hadir ?? 'belum'); ?>
        <select name="status_hadir">
          <option value="belum" <?= ($hadir === 'belum') ? 'selected' : '' ?>>Belum</option>
          <option value="sudah" <?= ($hadir === 'sudah') ? 'selected' : '' ?>>Sudah</option>
        </select>

        <button type="submit"><i class="fas fa-save"></i> Update</button>
      </form>
    </div>

  </div>
</div>
</body>
</html>
