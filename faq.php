<?php include 'config/koneksi.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FAQ — YOGYAKARYA</title>
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
      <li><a href="faq.php" class="active">FAQ</a></li>
      <li><a href="tentang.php">TENTANG</a></li>
    </ul>
    <div class="hamburger" onclick="toggleMenu()">&#9776;</div>
  </nav>

  <!-- ============ JUDUL ============ -->
  <section class="page-header">
    <h1 class="page-title">FAQ</h1>
  </section>

  <!-- ============ ACCORDION FAQ ============ -->
  <section class="section">
    <div class="faq-container">
      <?php
        // Ambil semua FAQ urut berdasarkan kolom urutan
        $faq = mysqli_query($koneksi, "SELECT * FROM faq ORDER BY urutan ASC");
        $no = 1;
        while ($row = mysqli_fetch_assoc($faq)):
      ?>
      <div class="faq-item">
        <button class="faq-question" onclick="toggleFaq(this)">
          <span><?= $no++ ?>. <?= htmlspecialchars($row['pertanyaan']) ?></span>
          <span class="faq-icon">&#9660;</span>
          <!-- &#9660; = simbol panah bawah ▼ -->
        </button>
        <!-- Jawaban tersembunyi, muncul saat tombol diklik -->
        <div class="faq-answer">
          <p><?= nl2br(htmlspecialchars($row['jawaban'])) ?></p>
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

    function toggleFaq(btn) {
      const answer = btn.nextElementSibling;
      const icon   = btn.querySelector('.faq-icon');
      const isOpen = answer.style.display === 'block';

      // Tutup semua FAQ dulu
      document.querySelectorAll('.faq-answer').forEach(a => a.style.display = 'none');
      document.querySelectorAll('.faq-icon').forEach(i => i.style.transform = 'rotate(0deg)');

      // Kalau belum terbuka, buka sekarang
      if (!isOpen) {
        answer.style.display = 'block';
        icon.style.transform  = 'rotate(180deg)';
        // Panah berputar 180° jadi ▲ menandai FAQ terbuka
      }
    }
  </script>

</body>
</html>