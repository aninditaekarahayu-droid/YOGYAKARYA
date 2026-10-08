<?php
include 'config/koneksi.php';

// Ambil id dari URL
$id = (int) $_GET['id'];

// Ambil 1 data game sesuai id
$result = mysqli_query($koneksi, "SELECT * FROM game WHERE id = $id");
$row = mysqli_fetch_assoc($result);

// Kalau tidak ditemukan, kembali ke permainan
if (!$row) {
  header("Location: permainan.php");
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
      <li><a href="permainan.php" class="active">GAME</a></li>
      <li><a href="kuliner.php">KULINER</a></li>
      <li><a href="review.php">REVIEW</a></li>
      <li><a href="faq.php">FAQ</a></li>
      <li><a href="tentang.php">TENTANG</a></li>
    </ul>
    <div class="hamburger" onclick="toggleMenu()">&#9776;</div>
  </nav>

  <!-- ============ DETAIL GAME ============ -->
  <section class="section detail-section">

    <a href="permainan.php" class="btn-kembali">&#8592; Kembali</a>

    <div class="detail-img-wrap">
      <img 
        src="images/<?= htmlspecialchars($row['thumbnail']) ?>" 
        alt="<?= htmlspecialchars($row['nama']) ?>"
      >
    </div>

    <div class="detail-body">

      <h1 class="detail-judul">
        <?= strtoupper(htmlspecialchars($row['nama'])) ?>
      </h1>

      <!-- Badge jenis game -->
      <span class="detail-kategori">
        <?= $row['jenis'] === 'board_game' ? 'Board Game' : 'Game Digital' ?>
      </span>

      <!-- Deskripsi lengkap -->
      <p class="detail-deskripsi">
        <?= nl2br(htmlspecialchars($row['deskripsi'])) ?>
      </p>

      <?php if ($row['jenis'] === 'board_game'): ?>

        <!-- Info board game -->
        <?php if (!empty($row['jumlah_pemain'])): ?>
        <p class="game-info">&#128101; Pemain: <?= htmlspecialchars($row['jumlah_pemain']) ?></p>
        <?php endif; ?>

        <!-- Cara main board game -->
        <?php if (!empty($row['cara_main'])): ?>
        <div class="detail-cara-main">
          <h3>Cara Bermain</h3>
          <p><?= nl2br(htmlspecialchars($row['cara_main'])) ?></p>
        </div>
        <?php endif; ?>

        <!-- Tombol review untuk board game -->
        <a href="review.php?jenis=game&id=<?= $row['id'] ?>" class="btn-primary">
          Berikan Review
        </a>

      <?php else: ?>

        <!-- Tombol main untuk game digital Unity -->
        <a 
            href="game/<?= htmlspecialchars($row['JogjaAksara.apk']) ?>" 
            class="btn-main-game" 
            download="game/<?= htmlspecialchars($row['JogjaAksara.apk']) ?>"
            target="_blank"
          >
          &#9654; Download Sekarang
        </a>

        <!-- Tombol review untuk game digital -->
        <a href="review.php?jenis=game&id=<?= $row['id'] ?>" class="btn-secondary">
          Berikan Review
        </a>

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