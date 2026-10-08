<?php
session_start();
if (!isset($_SESSION['admin'])) { header("Location: login.php"); exit; }
include '../config/koneksi.php';

$jml_destinasi = mysqli_fetch_row(mysqli_query($koneksi, "SELECT COUNT(*) FROM destinasi"))[0];
$jml_warisan   = mysqli_fetch_row(mysqli_query($koneksi, "SELECT COUNT(*) FROM warisan"))[0];
$jml_kuliner   = mysqli_fetch_row(mysqli_query($koneksi, "SELECT COUNT(*) FROM kuliner"))[0];
$jml_produk    = mysqli_fetch_row(mysqli_query($koneksi, "SELECT COUNT(*) FROM produk"))[0];
$jml_game      = mysqli_fetch_row(mysqli_query($koneksi, "SELECT COUNT(*) FROM game"))[0];
$jml_review    = mysqli_fetch_row(mysqli_query($koneksi, "SELECT COUNT(*) FROM review"))[0];
$jml_faq       = mysqli_fetch_row(mysqli_query($koneksi, "SELECT COUNT(*) FROM faq"))[0];
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard — Admin YOGYAKARYA</title>
  <link rel="stylesheet" href="../style.php">
</head>
<body class="admin-page">

  <?php include 'sidebar.php'; ?>

  <div class="admin-content">
    <h2>Dashboard</h2>

    <div class="stats-grid">
      <div class="stat-card">
        <h3><?= $jml_destinasi ?></h3>
        <p>Destinasi</p>
      </div>
      <div class="stat-card">
        <h3><?= $jml_warisan ?></h3>
        <p>Warisan</p>
      </div>
      <div class="stat-card">
        <h3><?= $jml_kuliner ?></h3>
        <p>Kuliner</p>
      </div>
      <div class="stat-card">
        <h3><?= $jml_produk ?></h3>
        <p>Produk</p>
      </div>
      <div class="stat-card">
        <h3><?= $jml_game ?></h3>
        <p>Game</p>
      </div>
      <div class="stat-card">
        <h3><?= $jml_review ?></h3>
        <p>Review</p>
      </div>
      <div class="stat-card">
        <h3><?= $jml_faq ?></h3>
        <p>FAQ</p>
      </div>
    </div>

    <!-- Review terbaru -->
    <h3 style="font-family:'Cormorant Garamond',serif;font-size:1.2rem;font-weight:400;color:#faf6f0;margin-bottom:16px;letter-spacing:1px;">Review Terbaru</h3>
    <table class="admin-table">
      <thead>
        <tr>
          <th>Nama</th>
          <th>Jenis</th>
          <th>Rating</th>
          <th>Komentar</th>
          <th>Tanggal</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $reviews = mysqli_query($koneksi, "SELECT * FROM review ORDER BY tanggal DESC LIMIT 5");
          while ($r = mysqli_fetch_assoc($reviews)):
        ?>
        <tr>
          <td><?= htmlspecialchars($r['nama_reviewer']) ?></td>
          <td><?= ucfirst($r['jenis']) ?></td>
          <td><?= str_repeat('★', $r['rating']) ?><?= str_repeat('☆', 5 - $r['rating']) ?></td>
          <td><?= htmlspecialchars(substr($r['komentar'], 0, 60)) ?>...</td>
          <td><?= date('d M Y', strtotime($r['tanggal'])) ?></td>
        </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>

</body>
</html>