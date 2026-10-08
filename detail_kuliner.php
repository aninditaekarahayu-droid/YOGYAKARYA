<?php
include 'config/koneksi.php';

// Ambil id dari URL, pastikan angka saja
$id = (int) $_GET['id'];

// Ambil 1 data kuliner sesuai id
$result = mysqli_query($koneksi, "SELECT * FROM kuliner WHERE id = $id");
$row = mysqli_fetch_assoc($result);

// Kalau id tidak ada, kembali ke kuliner
if (!$row) {
  header("Location: kuliner.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= htmlspecialchars($row['nama']) ?> — YOGYAKARYA</title>
  <link rel="stylesheet" href="style.php">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
</head>
<body>

  <!-- ============ NAVBAR ============ -->
  <nav class="navbar">
    <div class="nav-logo">
      <img src="images/logo.png" alt="Yogyakarya" height="40">
      <h3 class="navbar-title">Yogyakarya</h3>
    </div>
    <ul class="nav-links" id="navLinks">
      <li><a href="beranda.php">BERANDA</a></li>
      <li><a href="destinasi.php">DESTINASI</a></li>
      <li><a href="permainan.php">GAME</a></li>
      <li><a href="kuliner.php" class="active">KULINER</a></li>
      <li><a href="review.php">REVIEW</a></li>
      <li><a href="faq.php">FAQ</a></li>
      <li><a href="tentang.php">TENTANG</a></li>
    </ul>
    <div class="hamburger" onclick="toggleMenu()">&#9776;</div>
  </nav>

  <!-- ============ DETAIL KULINER ============ -->
  <section class="section detail-section">

    <a href="kuliner.php" class="btn-kembali">&#8592; Kembali</a>

    <div class="detail-img-wrap">
      <img 
        src="images/<?= htmlspecialchars($row['gambar']) ?>" 
        alt="<?= htmlspecialchars($row['nama']) ?>"
      >
    </div>

    <div class="detail-body">
      <h1 class="detail-judul"><?= htmlspecialchars($row['nama']) ?></h1>

      <p class="detail-deskripsi">
        <?= nl2br(htmlspecialchars($row['deskripsi'])) ?>
      </p>

      <!-- Resep hanya tampil kalau ada isinya -->
      <?php if (!empty($row['resep'])): ?>
      <div class="detail-resep">
        <h3 class="detail-resep-judul">Resep</h3>
        <p><?= nl2br(htmlspecialchars($row['resep'])) ?></p>
      </div>
      <?php endif; ?>

    </div>
  </section>

  <!-- ============ FOOTER ============ -->
  <footer class="footer">
    <div class="footer-content">
      <div class="footer-brand">
        <h3>&#10022; YOGYAKARYA</h3>
        <p>Pesona budaya yang tak pernah pudar</p>
      </div>
      <div class="footer-links">
        <h4>Navigasi</h4>
        <ul>
          <li><a href="destinasi.php">Destinasi</a></li>
          <li><a href="permainan.php">Game</a></li>
          <li><a href="kuliner.php">Kuliner</a></li>
          <li><a href="review.php">Review</a></li>
          <li><a href="faq.php">FAQ</a></li>
          <li><a href="tentang.php">Tentang</a></li>
        </ul>
      </div>
      
    <!-- Info -->
    <div class="footer-links">
      <h4>Informasi</h4>
      <ul>
        <li><a href="faq.php">FAQ</a></li>
        <li><a href="tentang.php">Tentang Developer</a></li>
        <li><a href="admin/login.php">Admin</a></li>
      </ul>
    </div>
    </div>
    <div class="footer-bottom">
      <p>&copy; 2026 Yogyakarya. All rights reserved.</p>
    </div>
  </footer>

  <script>
    function toggleMenu() {
      document.getElementById('navLinks').classList.toggle('open');
    }
  </script>

</body>
</html>