<?php include 'config/koneksi.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tentang — YOGYAKARYA</title>
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
      <li><a href="kuliner.php">KULINER</a></li>
      <li><a href="review.php">REVIEW</a></li>
      <li><a href="faq.php">FAQ</a></li>
      <li><a href="tentang.php" class="active">TENTANG</a></li>
    </ul>
    <div class="hamburger" onclick="toggleMenu()">&#9776;</div>
  </nav>

  <!-- ============ JUDUL ============ -->
  <section class="page-header">
    <h1 class="page-title">Tentang</h1>
  </section>

  <!-- ============ PROFIL DEVELOPER ============ -->
  <section class="section">
    <div class="tentang-container">

      <?php
        // Data developer ditulis statis langsung di sini
        // Tidak pakai database karena data jarang berubah
        // --> Ganti semua nilai di bawah sesuai data asli tim kamu
        $developers = [
          [
            'nama'      => 'Anindita Eka Rahayu',
            'role'      => 'Programmer & Back-end',
            'nisn'       => '3084871864',
            'jurusan'     => 'Pengembangan Perangkat Lunak dan Gim',
            'deskripsi' => 'Bertanggung jawab atas desain dan konsep game Yodogo. Memiliki minat di bidang desain game edukatif berbasis budaya lokal.',
            'foto'      => 'images/Anindita.jpeg',
          ],
          [
            'nama'      => 'Mahamda Aklio N.',
            'role'      => 'Artist & Front-end',
            'nisn'       => '987654321',
            'jurusan'     => 'Informatika',
            'deskripsi' => 'Bertanggung jawab atas pengembangan game Jogjaksara menggunakan Unity. Berfokus pada game edukasi 2D berbasis aksara Jawa.',
            'foto'      => 'images/Mahamda.jpeg',
          ],
        ];

        // Loop tiap developer, tampilkan satu per satu
        foreach ($developers as $dev):
      ?>

      <div class="tentang-card">
        <div class="tentang-card-inner">

          <!-- Foto developer kiri -->
          <div class="tentang-img-wrap">
            <img 
              src="<?= htmlspecialchars($dev['foto']) ?>" 
              alt="<?= htmlspecialchars($dev['nama']) ?>"
            >
          </div>

          <!-- Info developer kanan -->
          <div class="tentang-info">
            <h2 class="tentang-nama">
              <?= htmlspecialchars($dev['nama']) ?>
            </h2>
            <p class="tentang-role">
              <?= htmlspecialchars($dev['role']) ?>
            </p>
            <p class="tentang-nisn">
              NISN: <?= htmlspecialchars($dev['nisn']) ?>
            </p>
            <p class="tentang-jurusan">
              <?= htmlspecialchars($dev['jurusan']) ?>
            </p>
            <p class="tentang-desc">
              <?= htmlspecialchars($dev['deskripsi']) ?>
            </p>
          </div>

        </div>
      </div>

      <?php endforeach; ?>

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