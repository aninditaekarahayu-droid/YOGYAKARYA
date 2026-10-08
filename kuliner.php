<?php include 'config/koneksi.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kuliner — YOGYAKARYA</title>
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

  <!-- ============ KULINER ============ -->
  <section class="page-header">
    <h1 class="page-title">KULINER</h1>
  </section>

  <section class="section">
    <div class="card-grid-destinasi">
      <?php
        // Ambil semua data kuliner
        $kuliner = mysqli_query($koneksi, "SELECT * FROM kuliner ORDER BY id ASC");
        while ($row = mysqli_fetch_assoc($kuliner)):
      ?>
      <div class="card-destinasi">
        <div class="card-img-wrap">
          <img 
            src="images/<?= htmlspecialchars($row['gambar']) ?>" 
            alt="<?= htmlspecialchars($row['nama']) ?>"
          >
        </div>
        <div class="card-destinasi-body">
          <h3 class="card-destinasi-judul">
            <?= htmlspecialchars($row['nama']) ?>
          </h3>
          <p class="card-destinasi-desc">
            <?= htmlspecialchars(substr($row['deskripsi'], 0, 120)) ?> ...
          </p>
          <!-- 
            Tombol ini ke detail kuliner
            Membawa id kuliner lewat URL
          -->
          <a href="detail_kuliner.php?id=<?= $row['id'] ?>" class="btn-baca">
            Berikut Resepnya ...
          </a>
        </div>
      </div>
      <?php endwhile; ?>
    </div>
  </section>

  <!-- ============ PRODUK ============ -->
  <section class="page-header">
    <h1 class="page-title">PRODUK</h1>
  </section>

  <section class="section">
    <div class="card-grid-destinasi">
      <?php
        // Ambil semua data produk
        $produk = mysqli_query($koneksi, "SELECT * FROM produk ORDER BY id ASC");
        while ($row = mysqli_fetch_assoc($produk)):
      ?>
      <div class="card-destinasi">
        <div class="card-img-wrap">
          <img 
            src="images/<?= htmlspecialchars($row['gambar']) ?>" 
            alt="<?= htmlspecialchars($row['nama']) ?>"
          >
        </div>
        <div class="card-produk-bottom">
          <!-- Nama produk kiri, tombol review kanan -->
          <span class="card-destinasi-judul">
            <?= htmlspecialchars($row['nama']) ?>
          </span>
          <a 
            href="review.php?jenis=produk&id=<?= $row['id'] ?>" 
            class="btn-review"
          >
            Berikan Review
          </a>
        </div>
      </div>
      <?php endwhile; ?>
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