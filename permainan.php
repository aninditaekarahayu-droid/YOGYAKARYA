<?php include 'config/koneksi.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Game — YOGYAKARYA</title>
  <link rel="stylesheet" href="css/style.php">
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

  <!-- ============ JUDUL ============ -->
  <section class="page-header">
    <h1 class="page-title">GAME</h1>
  </section>

  <!-- ============ DAFTAR GAME ============ -->
  <section class="section">
    <?php
      // Ambil semua game, board_game duluan baru digital
      $game = mysqli_query($koneksi, "SELECT * FROM game ORDER BY FIELD(jenis, 'board_game', 'digital')");
      while ($row = mysqli_fetch_assoc($game)):
    ?>

    <div class="card-game-row">

      <!-- Gambar di kiri -->
      <div class="card-game-img">
        <img 
          src="images/<?= htmlspecialchars($row['thumbnail']) ?>" 
          alt="<?= htmlspecialchars($row['nama']) ?>"
        >
        <!-- Nama game di bawah foto -->
        <p class="card-game-nama"><?= strtoupper(htmlspecialchars($row['nama'])) ?></p>
      </div>

      <!-- Deskripsi di kanan -->
      <div class="card-game-desc">
        <p><?= nl2br(htmlspecialchars($row['deskripsi'])) ?></p>

        <?php if ($row['jenis'] === 'board_game'): ?>
          <!-- 
            Board game: tampilkan cara main + info pemain
            Tidak ada embed Unity, hanya teks penjelasan
          -->
          <?php if (!empty($row['cara_main'])): ?>
          <div class="game-cara-main">
            <h4>Cara Bermain</h4>
            <p><?= nl2br(htmlspecialchars($row['cara_main'])) ?></p>
          </div>
          <?php endif; ?>

          <?php if (!empty($row['jumlah_pemain'])): ?>
          <p class="game-info">
            &#128101; <?= htmlspecialchars($row['jumlah_pemain']) ?>
          </p>
          <?php endif; ?>

        <?php else: ?>
          <!-- 
            Game digital (Jogjaksara): tampilkan tombol main
            yang mengarah ke folder Unity WebGL
          -->
          <a 
            href="game/<?= htmlspecialchars($row['JogjaAksara.apk']) ?>" 
            class="btn-main-game" 
            download="game/JogjaAksara.apk<?= htmlspecialchars($row['JogjaAksara.apk']) ?>"
            target="_blank"
          >
            Download Sekarang
          </a>
          <!-- target="_blank" = buka di tab baru -->

        <?php endif; ?>

        <!-- Tombol baca selengkapnya untuk semua game -->
        <a href="detail_game.php?id=<?= $row['id'] ?>" class="btn-baca">
          Baca Selengkapnya ....
        </a>

      </div>
    </div>

    <?php endwhile; ?>
  </section>

  <!-- ============ FOOTER ============ -->
   <main>
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
        </main>

  <script>
    function toggleMenu() {
      document.getElementById('navLinks').classList.toggle('open');
    }
  </script>

</body>
</html>