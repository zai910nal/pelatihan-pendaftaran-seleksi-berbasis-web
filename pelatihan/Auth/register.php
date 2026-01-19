<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register Peserta</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <style>
    *{margin:0;padding:0;box-sizing:border-box}
    body{
      font-family:'Poppins',sans-serif;
      background: linear-gradient(135deg, #001D39, #0A4174);
      min-height:100vh;
      display:flex;
      align-items:center;
      justify-content:center;
      padding:24px;
      color:#fff;
    }
    .card{
      width:480px;
      background: rgba(189, 216, 233, 0.15);
      backdrop-filter: blur(25px);
      border-radius: 20px;
      padding: 28px;
      box-shadow: 0 20px 40px rgba(0,0,0,.3);
    }
    h2{font-size:24px;margin-bottom:6px;text-align:center}
    p.sub{color:#BDD8E9;text-align:center;margin-bottom:18px}
    .alert{
      padding:10px 12px;border-radius:10px;margin-bottom:12px;
      background: rgba(239,68,68,0.25);
    }
    label{display:block;font-size:13px;color:#BDD8E9;margin:10px 0 6px}
    input, textarea{
      width:100%;
      padding:12px;
      border-radius:10px;
      border:none;
      background: rgba(255,255,255,0.15);
      color:#fff;
      outline:none;
    }
    textarea{resize:none;height:70px}
    input::placeholder, textarea::placeholder{color:rgba(255,255,255,0.6)}
    button{
      width:100%;
      margin-top:14px;
      padding:12px;
      border:none;
      border-radius:12px;
      color:#fff;
      font-weight:700;
      cursor:pointer;
      background: linear-gradient(135deg, #49769F, #4E8EA2);
    }
    button:hover{background: linear-gradient(135deg, #4E8EA2, #6EA2B3)}
    .link{margin-top:12px;text-align:center;color:#BDD8E9}
    .link a{color:#7BBDE8;text-decoration:none}
  </style>
</head>
<body>

  <div class="card">
    <h2>Register Peserta</h2>
    <p class="sub">Buat akun peserta untuk login</p>

    <?php if ($this->session->flashdata('error')): ?>
      <div class="alert"><?= $this->session->flashdata('error'); ?></div>
    <?php endif; ?>

    <form method="post" action="<?= site_url('pelatihan/auth/proses_register') ?>">
      <label>Username</label>
      <input type="text" name="username" placeholder="contoh: peserta123" required>

      <label>Password</label>
      <input type="password" name="password" placeholder="buat password" required>

      <label>Nama Lengkap</label>
      <input type="text" name="nama_lengkap" placeholder="nama lengkap" required>

      <label>Email</label>
      <input type="email" name="email" placeholder="contoh@email.com" required>

      <label>No HP (opsional)</label>
      <input type="text" name="no_hp" placeholder="08xxxx">

      <label>Alamat (opsional)</label>
      <textarea name="alamat" placeholder="alamat lengkap"></textarea>

      <button type="submit">Daftar</button>
    </form>

    <div class="link">
      Sudah punya akun? <a href="<?= site_url('pelatihan/auth/login') ?>">Login</a>
    </div>
  </div>

</body>
</html>
