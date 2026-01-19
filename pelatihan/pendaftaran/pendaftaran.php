<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Pendaftaran Pelatihan</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

<style>
    .sidebar{
  width:260px;
  background:linear-gradient(180deg,#0a4174,#062b4a);
  padding:22px;
  color:#fff;
}

.sidebar-header{
  display:flex;
  align-items:center;
  gap:12px;
  margin-bottom:26px;
}

.sidebar-header i{
  font-size:1.6rem;
  color:#7BBDE8;
}

.sidebar-header h3{
  font-size:1.3rem;
  font-weight:800;
  margin:0;
}

.nav-menu{
  list-style:none;
  padding:0;
  margin:0;
}

.nav-item{
  margin-bottom:12px;
}

.nav-link{
  display:flex;
  align-items:center;
  gap:14px;
  padding:14px 16px;
  border-radius:16px;
  text-decoration:none;
  color:#e5f3ff;
  font-weight:700;
  background:rgba(255,255,255,0.06);
  border:1px solid rgba(255,255,255,0.12);
  transition:all .25s ease;
}

.nav-link i{
  font-size:1.1rem;
  min-width:20px;
}

.nav-link:hover{
  background:rgba(123,189,232,0.25);
  transform:translateX(4px);
}

.nav-link.active{
  background:linear-gradient(135deg,#49769F,#4E8EA2);
  box-shadow:0 6px 16px rgba(0,0,0,0.25);
}

.logout{
  margin-top:28px;
  padding-top:18px;
  border-top:1px solid rgba(255,255,255,0.15);
}

    /* === Rapihin File Upload Section === */
.section-box{
  margin-top:18px;
  padding:18px;
  border-radius:16px;
  border:1px solid rgba(255,255,255,0.14);
  background:rgba(255,255,255,0.06);
}

.section-title{
  font-weight:800;
  color:#fff;
  display:flex;
  align-items:center;
  gap:10px;
  margin-bottom:14px;
}

/* grid 2 kolom lebih rapi */
.row-2{
  display:grid;
  grid-template-columns: 1fr 1fr;
  gap:18px;
  align-items:start;
}
@media(max-width: 900px){
  .row-2{ grid-template-columns: 1fr; }
}

/* label upload */
.file-label{
  font-size:13px;
  color:#cfe6f5;
  margin-bottom:8px;
}

/* custom file input */
.file-wrap{
  position:relative;
  display:flex;
  align-items:center;
  gap:12px;
  padding:10px 12px;
  border-radius:12px;
  border:1px solid rgba(255,255,255,0.16);
  background:rgba(255,255,255,0.10);
  overflow:hidden;
}

.file-wrap input[type="file"]{
  position:absolute;
  inset:0;
  opacity:0;
  cursor:pointer;
}

.file-btn{
  flex:0 0 auto;
  padding:10px 12px;
  border-radius:10px;
  background:rgba(78,142,162,0.95);
  color:#fff;
  font-weight:800;
  font-size:13px;
  border:1px solid rgba(255,255,255,0.12);
}

.file-name{
  flex:1;
  color:rgba(255,255,255,0.80);
  font-size:13px;
  white-space:nowrap;
  overflow:hidden;
  text-overflow:ellipsis;
}

.help-text{
  color:rgba(255,255,255,0.75);
  font-size:13px;
  margin:12px 0 0 0;
  line-height:1.5;
}

body{
    margin:0;
    font-family:'Poppins',sans-serif;
    background:linear-gradient(135deg,#001D39,#0A4174);
    min-height:100vh;
    display:flex;
    color:white;
}
.sidebar{
    width:260px;
    background:rgba(10,65,116,0.9);
    padding:25px;
}
.sidebar h3{ margin-bottom:30px; }
.sidebar a{
    display:flex; align-items:center; gap:10px;
    padding:10px; margin-bottom:10px;
    text-decoration:none; color:#BDD8E9;
    border-radius:10px;
}
.sidebar a.active,
.sidebar a:hover{
    background:rgba(123,189,232,0.4);
    color:white;
}
.content{ flex:1; padding:40px; }

.card{
    background:rgba(189,216,233,0.15);
    backdrop-filter:blur(20px);
    border-radius:20px;
    padding:30px;
    max-width:900px;
}
.form-group{ margin-bottom:16px; }

label{
    font-size:14px;
    color:#BDD8E9;
    display:block;
    margin-bottom:6px;
}
input, select, textarea{
    width:100%;
    padding:12px;
    border-radius:10px;
    border:none;
    background:rgba(255,255,255,0.15);
    color:black;
    font-family:'Poppins', sans-serif;
    font-size:14px;
}
textarea{
    height:48px;
    resize:none;
    line-height:1.4;
}
input::placeholder, textarea::placeholder{ color:#BDD8E9; }

.status-box{ margin:15px 0; }

.badge{
    padding:6px 14px;
    border-radius:12px;
    font-size:13px;
    display:inline-block;
}
.pending{ background:#6EA2B3; }
.verified{ background:#7BBDE8; }
.rejected{ background:#ef4444; }

button{
    margin-top:20px;
    padding:12px;
    width:100%;
    background:linear-gradient(135deg,#49769F,#4E8EA2);
    border:none;
    border-radius:12px;
    color:white;
    font-weight:600;
    cursor:pointer;
}
button:hover{
    background:linear-gradient(135deg,#4E8EA2,#6EA2B3);
}

.alert-success{
    background:rgba(59,178,115,0.3);
    padding:12px;
    border-radius:12px;
    margin-bottom:15px;
}

/* File input rapih */
input[type="file"]{
  width:100%;
  padding:10px;
  border-radius:10px;
  border:none;
  background:rgba(255,255,255,0.15);
  color:#BDD8E9;
}

/* Box section */
.section-box{
  margin-top:18px;
  padding:16px;
  border-radius:16px;
  border:1px solid rgba(255,255,255,0.15);
  background:rgba(255,255,255,0.06);
}
.section-title{
  font-weight:700;
  color:#fff;
  display:flex;
  align-items:center;
  gap:10px;
  margin-bottom:10px;
}
.help-text{
  color:rgba(255,255,255,0.75);
  font-size:13px;
  margin:8px 0 0 0;
  line-height:1.5;
}
.row-2{
  display:grid;
  grid-template-columns: 1fr 1fr;
  gap:14px;
}
@media(max-width: 900px){
  .row-2{ grid-template-columns: 1fr; }
}
</style>
</head>

<body>

<div class="sidebar">
  <div class="sidebar-header">
    <i class="fas fa-graduation-cap"></i>
    <h3>Peserta</h3>
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

      <li class="nav-item">
        <a href="<?= site_url('pelatihan/pendaftaran') ?>"
           class="nav-link <?= ($this->uri->segment(2) == 'pendaftaran') ? 'active' : '' ?>">
          <i class="fas fa-file-alt"></i>
          <span>Pendaftaran</span>
        </a>
      </li>

      <li class="nav-item">
        <a href="<?= site_url('pelatihan/jadwal_seleksi') ?>"
           class="nav-link <?= ($this->uri->segment(2) == 'jadwal_seleksi') ? 'active' : '' ?>">
          <i class="fas fa-calendar-alt"></i>
          <span>Jadwal Seleksi</span>
        </a>
      </li>

      <li class="nav-item">
        <a href="<?= site_url('pelatihan/hasil_seleksi') ?>"
           class="nav-link <?= ($this->uri->segment(2) == 'hasil_seleksi') ? 'active' : '' ?>">
          <i class="fas fa-chart-line"></i>
          <span>Hasil Seleksi</span>
        </a>
      </li>

    </ul>
  </nav>

  <div class="logout">
    <ul class="nav-menu">
      <li class="nav-item">
        <a href="<?= site_url('pelatihan/auth/logout') ?>" class="nav-link">
          <i class="fas fa-sign-out-alt"></i>
          <span>Logout</span>
        </a>
      </li>
    </ul>
  </div>
</div>


<!-- CONTENT -->
<div class="content">
  <div class="card">

    <div class="card">
      <h2>Formulir Pendaftaran Pelatihan</h2>

      <?php if ($this->session->flashdata('success')): ?>
          <div class="alert success"><?= $this->session->flashdata('success') ?></div>
      <?php endif; ?>

      <?php if ($this->session->flashdata('error')): ?>
          <div class="alert error"><?= $this->session->flashdata('error') ?></div>
      <?php endif; ?>

      <?php if (!empty($pendaftaran)): ?>
        <?php
          $status = $pendaftaran->status_verifikasi ?? 'Pending';
          $persen = (int)($pendaftaran->persentase_lulus ?? 0);
          if ($persen < 0) $persen = 0;
          if ($persen > 100) $persen = 100;

          $badgeClass = 'pending';
          if ($status === 'Terverifikasi') $badgeClass = 'verified';
          if ($status === 'Ditolak') $badgeClass = 'rejected';
        ?>

        <div class="status-box">
          <p><b>Status Verifikasi:</b>
            <span class="badge <?= $badgeClass ?>"><?= htmlspecialchars($status) ?></span>
          </p>

          <p style="margin-top:10px;">
            <b>Peluang Kelulusan:</b> <?= $persen ?>%
          </p>

          <div style="background:rgba(255,255,255,.12);border-radius:999px;height:10px;overflow:hidden;margin-top:6px;">
            <div style="height:100%;width:<?= $persen ?>%;background:linear-gradient(90deg,#7BBDE8,#4E8EA2);"></div>
          </div>
        </div>

        <hr>
      <?php endif; ?>

      <form method="post" action="<?= site_url('pelatihan/pendaftaran/simpan') ?>" enctype="multipart/form-data">

        <div class="form-group">
          <label>Pilih Pelatihan</label>
          <select name="id_pelatihan" required>
              <option value="">-- Pilih Pelatihan --</option>
              <?php foreach($pelatihan as $p): ?>
                  <option value="<?= $p->id_pelatihan ?>">
                      <?= $p->nama_pelatihan ?>
                  </option>
              <?php endforeach; ?>
          </select>
        </div>

        <div class="form-group">
          <label>Nama Lengkap</label>
          <input type="text" name="nama_lengkap" placeholder="Masukkan nama lengkap" required>
        </div>

        <div class="form-group">
          <label>Email</label>
          <input type="email" name="email" placeholder="contoh@email.com" required>
        </div>

        <div class="form-group">
          <label>No HP</label>
          <input type="text" name="no_hp" placeholder="08xxxxxxxxxx" required>
        </div>

        <div class="form-group">
          <label>Alamat</label>
          <textarea name="alamat" placeholder="Masukkan alamat lengkap" required></textarea>
        </div>

        <!-- ✅ BERKAS SYARAT (BARU) -->
        <div class="section-box">
  <div class="section-title">
    <i class="fas fa-paperclip"></i> Berkas Persyaratan
  </div>

  <div class="row-2">
    <div class="form-group">
      <div class="file-label">CV (PDF) <span style="opacity:.75;">(Wajib)</span></div>
      <div class="file-wrap">
        <span class="file-btn"><i class="fas fa-upload"></i> Pilih File</span>
        <span class="file-name" data-for="berkas_cv">Belum ada file dipilih</span>
        <input type="file" name="berkas_cv" id="berkas_cv" accept=".pdf" required>
      </div>
    </div>

    <div class="form-group">
      <div class="file-label">KTP (JPG/PNG/PDF) <span style="opacity:.75;">(Wajib)</span></div>
      <div class="file-wrap">
        <span class="file-btn"><i class="fas fa-upload"></i> Pilih File</span>
        <span class="file-name" data-for="berkas_ktp">Belum ada file dipilih</span>
        <input type="file" name="berkas_ktp" id="berkas_ktp" accept=".jpg,.jpeg,.png,.pdf" required>
      </div>
    </div>
  </div>

  <div class="row-2" style="margin-top:10px;">
    <div class="form-group">
      <div class="file-label">Ijazah / Surat Keterangan (PDF/JPG/PNG) <span style="opacity:.75;">(Opsional)</span></div>
      <div class="file-wrap">
        <span class="file-btn"><i class="fas fa-upload"></i> Pilih File</span>
        <span class="file-name" data-for="berkas_ijazah">Belum ada file dipilih</span>
        <input type="file" name="berkas_ijazah" id="berkas_ijazah" accept=".pdf,.jpg,.jpeg,.png">
      </div>
    </div>

    <div class="form-group">
      <div class="file-label">Pas Foto 3x4 (JPG/PNG) <span style="opacity:.75;">(Opsional)</span></div>
      <div class="file-wrap">
        <span class="file-btn"><i class="fas fa-upload"></i> Pilih File</span>
        <span class="file-name" data-for="berkas_foto">Belum ada file dipilih</span>
        <input type="file" name="berkas_foto" id="berkas_foto" accept=".jpg,.jpeg,.png">
      </div>
    </div>
  </div>

  <p class="help-text">
    <b>Catatan:</b> Maksimal ukuran per file disarankan <b>2MB</b>. Format yang diterima: <b>PDF / JPG / PNG</b>.
    File wajib harus diisi agar pendaftaran bisa diproses.
  </p>
</div>


        <button type="submit">Daftar Sekarang</button>
      </form>
    </div>

  </div>
</div>
<script>
  document.querySelectorAll('input[type="file"]').forEach(function(inp){
    inp.addEventListener('change', function(){
      const id = inp.getAttribute('id');
      const label = document.querySelector('.file-name[data-for="'+id+'"]');
      if (!label) return;

      if (inp.files && inp.files.length > 0) {
        label.textContent = inp.files[0].name;
      } else {
        label.textContent = 'Belum ada file dipilih';
      }
    });
  });
</script>

</body>
</html>
