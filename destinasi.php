<?php include 'config/koneksi.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Destinasi — YOGYAKARYA</title>
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
      <li><a href="destinasi.php" class="active">DESTINASI</a></li>
      <li><a href="permainan.php">GAME</a></li>
      <li><a href="kuliner.php">KULINER</a></li>
      <li><a href="review.php">REVIEW</a></li>
      <li><a href="faq.php">FAQ</a></li>
      <li><a href="tentang.php">TENTANG</a></li>
    </ul>
    <div class="hamburger" onclick="toggleMenu()">&#9776;</div>
  </nav>

  <!-- ============ JUDUL HALAMAN ============ -->
  <section class="page-header">
    <h1 class="page-title">DESTINASI</h1>
  </section>

  <!-- ============ GRID DESTINASI ============ -->
  <section class="section">
    <div class="card-grid-destinasi">
      <?php
        // Ambil semua data destinasi dari database
        $dest = mysqli_query($koneksi, "SELECT * FROM destinasi ORDER BY id ASC");

        while ($row = mysqli_fetch_assoc($dest)):
      ?>
      <div class="card-destinasi">

        <!-- Foto destinasi -->
        <div class="card-img-wrap">
          <img 
            src="images/<?= htmlspecialchars($row['gambar']) ?>" 
            alt="<?= htmlspecialchars($row['nama']) ?>"
          >
        </div>

        <!-- Isi card -->
        <div class="card-destinasi-body">

          <!-- Judul berwarna emas -->
          <h3 class="card-destinasi-judul">
            <?= htmlspecialchars($row['nama']) ?>
          </h3>

          <!-- Deskripsi singkat, potong jika terlalu panjang -->
          <p class="card-destinasi-desc">
            <?= htmlspecialchars(substr($row['deskripsi'], 0, 120)) ?> ...
          </p>

          <!-- Tombol baca selengkapnya -->
          <a 
            href="detail_wisata.php?id=<?= $row['id'] ?>" 
            class="btn-baca"
          >
            Baca Selengkapnya ....
          </a>

        </div>
      </div>
      <?php endwhile; ?>
    </div>
  </section>

  <!-- ============ WARISAN BUDAYA ============ -->
  <section class="page-header" id="warisan">
    <h1 class="page-title">WARISAN</h1>
  </section>

  <section class="section">
    <div class="card-grid-destinasi">
      <?php
        $warisan = mysqli_query($koneksi, "SELECT * FROM warisan ORDER BY id ASC");
        while ($row = mysqli_fetch_assoc($warisan)):
      ?>
      <div class="card-destinasi">
        <div class="card-img-wrap">
          <img src="images/<?= htmlspecialchars($row['gambar']) ?>" alt="<?= htmlspecialchars($row['nama']) ?>">
        </div>
        <div class="card-destinasi-body">
          <h3 class="card-destinasi-judul"><?= htmlspecialchars($row['nama']) ?></h3>
          <p class="card-destinasi-desc"><?= htmlspecialchars(substr($row['deskripsi'], 0, 120)) ?> ...</p>
          <a href="detail_warisan.php?id=<?= $row['id'] ?>" class="btn-baca">Baca Selengkapnya ....</a>
          
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
        <p>Tanah jawa yang masih meninggalkan adat jawa yang ada.</p>
      </div>
      <div class="footer-links">
        <h4>Navigasi</h4>
        <ul>
          <li><a href="beranda.php">Beranda</a></li>
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
    // Buka/tutup menu di HP
    function toggleMenu() {
      document.getElementById('navLinks').classList.toggle('open');
    }
  </script>

</body>
</html>