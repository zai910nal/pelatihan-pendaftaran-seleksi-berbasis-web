<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Detail Pendaftaran</title>
  <link rel="stylesheet" href="/codelingter/assets/css/ui-dashboard.css">
  <style>
    body{font-family:Arial;margin:20px}
    .box{max-width:700px;border:1px solid #ddd;padding:20px;border-radius:10px}
    .row{margin-bottom:10px}
    .lbl{font-weight:bold}
    .btn{display:inline-block;margin-top:10px;padding:8px 12px;border-radius:6px;color:#fff;text-decoration:none}
    .back{background:#64748b}
    .ok{background:#10b981}
    .no{background:#ef4444}
  </style>
</head>
<body>

<div class="box">
  <h2>Detail Pendaftaran</h2>

  <div class="row"><span class="lbl">Nama:</span> <?= htmlspecialchars($row->nama_lengkap) ?></div>
  <div class="row"><span class="lbl">Email:</span> <?= htmlspecialchars($row->email) ?></div>
  <div class="row"><span class="lbl">No HP:</span> <?= htmlspecialchars($row->no_hp) ?></div>
  <div class="row"><span class="lbl">Alamat:</span> <?= nl2br(htmlspecialchars($row->alamat)) ?></div>
  <div class="row"><span class="lbl">Pelatihan:</span> <?= htmlspecialchars($row->nama_pelatihan ?? '-') ?></div>
  <div class="row"><span class="lbl">Status:</span> <?= htmlspecialchars($row->status_verifikasi) ?></div>

  <div class="row">
  <span class="lbl">Berkas:</span>
  <?php if (!empty($berkas_list)): ?>
    <ul style="margin:8px 0 0 18px;">
      <?php foreach ($berkas_list as $b): ?>
        <li>
          <?= htmlspecialchars($b->nama_berkas) ?> —
          <b><?= htmlspecialchars($b->status_berkas) ?></b> —
          <a href="<?= base_url($b->file_path) ?>" target="_blank">Lihat</a>
        </li>
      <?php endforeach; ?>
    </ul>
  <?php else: ?>
    Tidak ada
  <?php endif; ?>
</div>


  <a class="btn back" href="<?= site_url('pelatihan/admin/verifikasi_list') ?>">Kembali</a>
  <a class="btn ok" href="<?= site_url('pelatihan/admin/verifikasi/'.$row->id_pendaftaran) ?>"
     onclick="return confirm('Verifikasi pendaftaran ini?')">Verifikasi</a>
  <a class="btn no" href="<?= site_url('pelatihan/admin/verifikasi_tolak/'.$row->id_pendaftaran) ?>"
     onclick="return confirm('Tolak pendaftaran ini?')">Tolak</a>
</div>

</body>
</html>
