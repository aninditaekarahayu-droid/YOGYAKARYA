<?php include 'config/koneksi.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>YOGYAKARYA</title>
  <link rel="stylesheet" href="style.php">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
</head>
<script>
document.addEventListener("DOMContentLoaded", function () {
  const hero = document.querySelector('.hero');

  const images = [
    'images/Hero.png',
    'images/Hero2.png',
    'images/Hero3.png'
  ];

  let index = 0;

  setInterval(() => {
    index = (index + 1) % images.length;
    hero.style.backgroundImage = `url('${images[index]}')`;
  }, 4000);
});
</script>
<body>
    <style>
    .hero {
        background: url('http://pplgrolas.my.id/3084871864/yogyakarya/images/Hero.png') center/cover no-repeat;
        height: 620px;
    }
    </style>
  <!-- ============ NAVBAR ============ -->
  <nav class="navbar">
    <div class="nav-logo">
    <img src="images/logo.png" alt="Yogyakarya" height="40">
    <h3 class="navbar-title">Yogyakarya</h3>
    </div>
    <ul class="nav-links" id="navLinks">
      <li><a href="beranda.php" class="active">BERANDA</a></li>
      <li><a href="destinasi.php">DESTINASI</a></li>
      <li><a href="permainan.php">GAME</a></li>
      <li><a href="kuliner.php">KULINER</a></li>
      <li><a href="review.php">REVIEW</a></li>
      <li><a href="faq.php">FAQ</a></li>
      <li><a href="tentang.php">TENTANG</a></li>
    </ul>
    <div class="hamburger" onclick="toggleMenu()">&#9776;</div>
  </nav>

  <!-- ============ HERO ============ -->
  <section class="hero">
    <div class="hero-overlay"></div>
    <div class="hero-content">
      <a href="#sejarah" class="btn-jelajahi">JELAJAHI</a>
    </div>
  </section>

  <!-- ============ SEJARAH ============ -->
  <section class="section" id="sejarah">
    <h2 class="section-title">SEJARAH</h2>
    <p class="sejarah-text">
      Sejarah Yogyakarta berakar dari 
      <a href="#" class="link-emas">Perjanjian Giyanti</a> 
      13 Februari 1755, yang membagi Kerajaan Mataram Islam, di mana Pangeran Mangkubumi mendirikan Kesultanan Ngayogyakarta Hadiningrat dan bergelar Sultan Hamengku Buwono I. Ibukota resmi dipindahkan ke Keraton Yogyakarta pada 7 Oktober 1756, dan wilayah ini diakui sebagai Daerah Istimewa (DIY) yang bergabung dengan RI pada 5 September 1945.
    </p>
  </section>

  <!-- ============ DESTINASI ============ -->
  <section class="section" id="destinasi">
    <h2 class="section-title">DESTINASI</h2>
    <div class="card-grid">
      <?php
        $dest = mysqli_query($koneksi, "SELECT * FROM destinasi LIMIT 4");
        while ($row = mysqli_fetch_assoc($dest)):
      ?>
      <div class="card">
        <img src="images/<?= htmlspecialchars($row['gambar']) ?>" alt="<?= htmlspecialchars($row['nama']) ?>">
        <div class="card-label"><?= htmlspecialchars($row['nama']) ?></div>
      </div>
      <?php endwhile; ?>
    </div>
    <div class="section-center">
      <a href="destinasi.php" class="btn-selengkapnya">SELENGKAPNYA</a>
    </div>
  </section>

  <!-- ============ WARISAN BUDAYA ============ -->
  <section class="section" id="warisan">
    <h2 class="section-title">WARISAN</h2>
    <div class="card-grid">
      <?php
        $warisan = mysqli_query($koneksi, "SELECT * FROM warisan LIMIT 4");
        while ($row = mysqli_fetch_assoc($warisan)):
      ?>
      <div class="card">
        <img src="images/<?= htmlspecialchars($row['gambar']) ?>" alt="<?= htmlspecialchars($row['nama']) ?>">
        <div class="card-label"><?= htmlspecialchars($row['nama']) ?></div>
      </div>
      <?php endwhile; ?>
    </div>
    <div class="section-center">
      <a href="destinasi.php#warisan" class="btn-selengkapnya">SELENGKAPNYA</a>
    </div>
  </section>

  <!-- ============ GAME ============ -->
  <section class="section" id="game">
    <h2 class="section-title">GAME</h2>
    <div class="card-grid">
      <?php
        $game = mysqli_query($koneksi, "SELECT * FROM game LIMIT 2");
        while ($row = mysqli_fetch_assoc($game)):
      ?>
      <div class="card">
        <img src="images/<?= htmlspecialchars($row['thumbnail']) ?>" alt="<?= htmlspecialchars($row['nama']) ?>">
        <div class="card-label"><?= strtoupper(htmlspecialchars($row['nama'])) ?></div>
      </div>
      <?php endwhile; ?>
      <a href="permainan.php" class="btn-selengkapnya">Selengkapnya</a>
    </div>
  </section>

  <!-- ============ KULINER ============ -->
  <section class="section" id="kuliner">
    <h2 class="section-title">KULINER</h2>
    <div class="card-grid">
      <?php
        $kuliner = mysqli_query($koneksi, "SELECT * FROM kuliner LIMIT 4");
        while ($row = mysqli_fetch_assoc($kuliner)):
      ?>
      <div class="card">
        <img src="images/<?= htmlspecialchars($row['gambar']) ?>" alt="<?= htmlspecialchars($row['nama']) ?>">
        <div class="card-label"><?= strtoupper(htmlspecialchars($row['nama'])) ?></div>
      </div>
      <?php endwhile; ?>
    </div>
  </section>

  <!-- ============ PRODUK ============ -->
    <section class="section" id="produk">
    <h2 class="section-title">PRODUK</h2>
    <div class="card-grid">
        <?php
        $produk = mysqli_query($koneksi, "SELECT * FROM produk LIMIT 4");
        while ($row = mysqli_fetch_assoc($produk)):
        ?>
        <div class="card">
        <img src="images/<?= htmlspecialchars($row['gambar']) ?>" alt="<?= htmlspecialchars($row['nama']) ?>">
        <div class="card-produk-bottom">
            <span class="card-label-produk"><?= htmlspecialchars($row['nama']) ?></span>
            <a href="review.php?jenis=produk&id=<?= $row['id'] ?>" class="btn-review">Berikan Review</a>
            <a href="https://wa.me/<?= $row['no_wa'] ?>" target="_blank" class="btn-wa">
            Hubungi
        </a>
        </div>
        </div>
        <?php endwhile; ?>
    </div>
    </section>

  <!-- ============ REVIEW ============ -->
  <section class="section" id="review">
    <h2 class="section-title">Review</h2>

    <!-- 3 Review Produk -->
    <h3 class="review-sub-title"></h3>
    <div class="review-preview">
      <?php
        $reviews_produk = mysqli_query($koneksi, "SELECT * FROM review WHERE jenis='produk' ORDER BY tanggal DESC LIMIT 3");
        $total_produk   = mysqli_fetch_row(mysqli_query($koneksi, "SELECT COUNT(*) FROM review WHERE jenis='produk'"))[0];
        while ($row = mysqli_fetch_assoc($reviews_produk)):
          $ref = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT nama FROM produk WHERE id=" . (int)$row['id_referensi']));
      ?>
      <div class="review-item">
        <div class="review-header">
          <p class="review-nama"><?= htmlspecialchars($row['nama_reviewer']) ?></p>
          <span class="review-jenis"><?= strtoupper($row['jenis']) ?></span>
        </div>
        <?php if ($ref): ?>
          <p class="review-ref">&#128722; <?= htmlspecialchars($ref['nama']) ?></p>
        <?php endif; ?>
        <div class="review-stars">
          <?php for ($i = 1; $i <= 5; $i++): ?>
            <span class="<?= $i <= $row['rating'] ? 'star-on' : 'star-off' ?>">&#9733;</span>
          <?php endfor; ?>
        </div>
        <p class="review-komentar"><?= htmlspecialchars($row['komentar']) ?></p>
        <p class="review-tanggal"><?= date('d M Y', strtotime($row['tanggal'])) ?></p>
      </div>
      <?php endwhile; ?>
    </div>

    <!-- Tombol selengkapnya produk kalau lebih dari 3 -->
    <?php if ($total_produk > 3): ?>
      <div class="review-more">
        <a href="review.php?filter=produk" class="review-more-btn">
          Lihat semua <?= $total_produk ?> review produk &#8594;
        </a>
      </div>
    <?php endif; ?>

    <!-- 3 Review Game -->
    <h3 class="review-sub-title" style="margin-top:40px"></h3>
    <div class="review-preview">
      <?php
        $reviews_game = mysqli_query($koneksi, "SELECT * FROM review WHERE jenis='game' ORDER BY tanggal DESC LIMIT 3");
        $total_game   = mysqli_fetch_row(mysqli_query($koneksi, "SELECT COUNT(*) FROM review WHERE jenis='game'"))[0];
        while ($row = mysqli_fetch_assoc($reviews_game)):
          $ref = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT nama FROM game WHERE id=" . (int)$row['id_referensi']));
      ?>
      <div class="review-item">
        <div class="review-header">
          <p class="review-nama"><?= htmlspecialchars($row['nama_reviewer']) ?></p>
          <span class="review-jenis"><?= strtoupper($row['jenis']) ?></span>
        </div>
        <?php if ($ref): ?>
          <p class="review-ref">&#127918; <?= htmlspecialchars($ref['nama']) ?></p>
        <?php endif; ?>
        <div class="review-stars">
          <?php for ($i = 1; $i <= 5; $i++): ?>
            <span class="<?= $i <= $row['rating'] ? 'star-on' : 'star-off' ?>">&#9733;</span>
          <?php endfor; ?>
        </div>
        <p class="review-komentar"><?= htmlspecialchars($row['komentar']) ?></p>
        <p class="review-tanggal"><?= date('d M Y', strtotime($row['tanggal'])) ?></p>
      </div>
      <?php endwhile; ?>
    </div>

    <!-- Tombol selengkapnya game kalau lebih dari 3 -->
    <?php if ($total_game > 3): ?>
      <div class="review-more">
        <a href="review.php?filter=game" class="review-more-btn">
          Lihat semua <?= $total_game ?> review game &#8594;
        </a>
      </div>
    <?php endif; ?>

    <!-- 3 Review Lainnya -->
  <h3 class="review-sub-title" style="margin-top:40px">Review Lainnya</h3>
  <div class="review-preview">
    <?php
      $reviews_lainnya = mysqli_query($koneksi, "SELECT * FROM review WHERE jenis='lainnya' ORDER BY tanggal DESC LIMIT 3");
      $total_lainnya   = mysqli_fetch_row(mysqli_query($koneksi, "SELECT COUNT(*) FROM review WHERE jenis='lainnya'"))[0];

      while ($row = mysqli_fetch_assoc($reviews_lainnya)):
    ?>
    <div class="review-item">
      <div class="review-header">
        <p class="review-nama"><?= htmlspecialchars($row['nama_reviewer']) ?></p>
        <span class="review-jenis">LAINNYA</span>
      </div>

      <!-- TANPA REFERENSI -->

      <div class="review-stars">
        <?php for ($i = 1; $i <= 5; $i++): ?>
          <span class="<?= $i <= $row['rating'] ? 'star-on' : 'star-off' ?>">&#9733;</span>
        <?php endfor; ?>
      </div>

      <p class="review-komentar"><?= htmlspecialchars($row['komentar']) ?></p>
      <p class="review-tanggal"><?= date('d M Y', strtotime($row['tanggal'])) ?></p>
    </div>
    <?php endwhile; ?>
  </div>

  <?php if ($total_lainnya > 3): ?>
    <div class="review-more">
      <a href="review.php?filter=lainnya" class="review-more-btn">
        Lihat semua <?= $total_lainnya ?> review lainnya &#8594;
      </a>
    </div>
  <?php endif; ?>

  </section>

  <!-- ============ FAQ ============ -->
  <section class="section" id="faq">
    <h2 class="section-title">FAQ</h2>
    <div class="faq-container">

      <?php
        // ambil total faq
        $total_faq_query = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM faq");
        $total_faq = mysqli_fetch_assoc($total_faq_query)['total'];

        // ambil hanya 3 faq pertama
        $faq = mysqli_query($koneksi, "SELECT * FROM faq ORDER BY urutan ASC LIMIT 3");
        $no = 1;

        while ($row = mysqli_fetch_assoc($faq)):
      ?>
        <div class="faq-item">
          <button class="faq-question" onclick="toggleFaq(this)">
            <span><?= $no++?>. <?= htmlspecialchars($row['pertanyaan']) ?></span>
            <span class="faq-icon">&#9660;</span>
          </button>
          <div class="faq-answer">
            <p><?= htmlspecialchars($row['jawaban']) ?></p>
          </div>
        </div>
      <?php endwhile; ?>

    </div>

    <?php if ($total_faq > 3): ?>
      <div class="review-more">
        <a href="faq.php" class="review-more-btn">
          Lihat semua FAQ &#8594;
        </a>
      </div>
    <?php endif; ?>

  </section>

  <!-- ============ TENTANG DEVELOPER ============ -->
  <section class="section" id="tentang">
    <div class="tentang-bar">
      <h2 class="section-title" style="margin:0">Tentang Developer</h2>
      <a href="tentang.php" class="btn-selengkapnya">Selengkapnya</a>
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

    function toggleFaq(btn) {
      const answer = btn.nextElementSibling;
      const icon = btn.querySelector('.faq-icon');
      const isOpen = answer.style.display === 'block';
      // Tutup semua
      document.querySelectorAll('.faq-answer').forEach(a => a.style.display = 'none');
      document.querySelectorAll('.faq-icon').forEach(i => i.style.transform = 'rotate(0deg)');
      // Buka yang diklik jika belum terbuka
      if (!isOpen) {
        answer.style.display = 'block';
        icon.style.transform = 'rotate(180deg)';
      }
    }
  </script>

</body>
</html>