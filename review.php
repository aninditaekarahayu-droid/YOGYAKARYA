<?php include 'config/koneksi.php';

// Tangkap jenis dan id dari URL kalau ada
// Contoh: review.php?jenis=produk&id=2
$jenis = isset($_GET['jenis']) ? $_GET['jenis'] : '';
$id_ref = isset($_GET['id']) ? (int) $_GET['id'] : 0;

// Pesan sukses setelah submit
$pesan = isset($_GET['sukses']) ? 'Review berhasil dikirim! Terima kasih.' : '';
$error = '';

// Proses form saat submit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nama     = mysqli_real_escape_string($koneksi, trim($_POST['nama']));
  $jenis_post = $_POST['jenis'];

if ($jenis_post === 'lainnya') {
  $id_post = 0; // tidak pakai referensi
  } else {
    $id_post = (int) $_POST['id_referensi'];
  }
  $komentar = mysqli_real_escape_string($koneksi, trim($_POST['komentar']));
  $rating   = (int) $_POST['rating'];

  // Validasi: semua field harus diisi
  if (empty($nama) || empty($komentar) || $rating < 1) {
    $error = 'Mohon isi semua field dan pilih rating bintang.';
  } else {
    $sql = "INSERT INTO review (nama_reviewer, jenis, id_referensi, komentar, rating)
            VALUES ('$nama', '$jenis_post', $id_post, '$komentar', $rating)";
    mysqli_query($koneksi, $sql);
    // Redirect supaya tidak double submit saat refresh
    header("Location: review.php?sukses=1");
    exit;
  }
}

// Ambil semua review untuk ditampilkan
$filter = isset($_GET['filter']) ? $_GET['filter'] : '';
if ($filter === 'produk') {
  $reviews = mysqli_query($koneksi, "SELECT * FROM review WHERE jenis='produk' ORDER BY tanggal DESC");
} elseif ($filter === 'game') {
  $reviews = mysqli_query($koneksi, "SELECT * FROM review WHERE jenis='game' ORDER BY tanggal DESC");
} elseif ($filter === 'lainnya') {
  $reviews = mysqli_query($koneksi, "SELECT * FROM review WHERE jenis='lainnya' ORDER BY tanggal DESC");
} else {
  $reviews = mysqli_query($koneksi, "SELECT * FROM review ORDER BY tanggal DESC");
}

// Ambil daftar produk dan game untuk dropdown
$list_produk = mysqli_query($koneksi, "SELECT id, nama FROM produk");
$list_game   = mysqli_query($koneksi, "SELECT id, nama FROM game");
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Review — YOGYAKARYA</title>
  <link rel="stylesheet" href="style.php">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Lato:wght@300;400;700 &display=swap" rel="stylesheet">
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
      <li><a href="review.php" class="active">REVIEW</a></li>
      <li><a href="faq.php">FAQ</a></li>
      <li><a href="tentang.php">TENTANG</a></li>
    </ul>
    <div class="hamburger" onclick="toggleMenu()">&#9776;</div>
  </nav>

  <!-- ============ JUDUL ============ -->
  <section class="page-header">
    <h1 class="page-title">Review Pengguna</h1>
  </section>

  <!-- ============ FORM REVIEW ============ -->
  <section class="section">
    <div class="review-form-wrap">

      <!-- Pesan sukses -->
      <?php if ($pesan): ?>
        <p class="pesan-sukses"><?= $pesan ?></p>
      <?php endif; ?>

      <!-- Pesan error -->
      <?php if ($error): ?>
        <p class="pesan-error"><?= $error ?></p>
      <?php endif; ?>

      <form method="POST" action="review.php">

        <!-- Nama -->
        <input 
          type="text" 
          name="nama" 
          placeholder="Nama kamu" 
          class="input-review"
          required
        >

        <!-- Pilih jenis: produk atau game -->
        <select 
          name="jenis" 
          class="input-review" 
          id="selectJenis"
          onchange="updateDropdown(this.value)"
        >
          <option value="produk" <?= $jenis === 'produk' ? 'selected' : '' ?>>Produk</option>
          <option value="game"   <?= $jenis === 'game'   ? 'selected' : '' ?>>Game</option>
          <option value="lainnya" <?= $jenis === 'lainnya' ? 'selected' : '' ?>>Lainnya</option>
        </select>

        <!-- Dropdown produk (muncul kalau jenis = produk) -->
        <select name="id_referensi" class="input-review" id="dropdownProduk">
          <?php 
            mysqli_data_seek($list_produk, 0);
            while ($p = mysqli_fetch_assoc($list_produk)): 
          ?>
            <option value="<?= $p['id'] ?>" <?= $id_ref == $p['id'] ? 'selected' : '' ?>>
              <?= htmlspecialchars($p['nama']) ?>
            </option>
          <?php endwhile; ?>
        </select>

        <!-- Dropdown game (muncul kalau jenis = game) -->
        <select name="id_referensi" class="input-review" id="dropdownGame" style="display:none">
          <?php 
            mysqli_data_seek($list_game, 0);
            while ($g = mysqli_fetch_assoc($list_game)): 
          ?>
            <option value="<?= $g['id'] ?>" <?= $id_ref == $g['id'] ? 'selected' : '' ?>>
              <?= htmlspecialchars($g['nama']) ?>
            </option>
          <?php endwhile; ?>
          
        </select>

        <!-- Rating bintang interaktif -->
        <!-- 
          Menggunakan radio button tersembunyi + label bintang
          Urutan terbalik (5 ke 1) untuk trik CSS hover
        -->
        <div class="star-rating">
          <input type="radio" name="rating" id="star5" value="5">
          <label for="star5">&#9733;</label>
          <input type="radio" name="rating" id="star4" value="4">
          <label for="star4">&#9733;</label>
          <input type="radio" name="rating" id="star3" value="3">
          <label for="star3">&#9733;</label>
          <input type="radio" name="rating" id="star2" value="2">
          <label for="star2">&#9733;</label>
          <input type="radio" name="rating" id="star1" value="1">
          <label for="star1">&#9733;</label>
        </div>

        <!-- Komentar -->
        <textarea 
          name="komentar" 
          placeholder="Tulis ulasanmu di sini..." 
          class="input-review textarea-review"
          rows="6"
          required
        ></textarea>

        <button type="submit" class="btn-primary btn-submit-review">
          Kirim Review
        </button>

      </form>
    </div>
  </section>

  <!-- ============ DAFTAR REVIEW ============ -->
  <?php if (mysqli_num_rows($reviews) > 0): ?>
  <section class="section">
    <h2 class="section-title">Ulasan Terbaru</h2>
    <div class="review-list">
      <?php while ($r = mysqli_fetch_assoc($reviews)): ?>
      <div class="review-card">
        <div class="review-header">
          <span class="review-nama"><?= htmlspecialchars($r['nama_reviewer']) ?></span>
          <span class="review-jenis">
            <?= $r['jenis'] === 'lainnya' ? 'Lainnya' : ucfirst($r['jenis']) ?>
          </span>
          <!-- ucfirst() = huruf pertama kapital: produk → Produk -->
        </div>

        <!-- TAMBAH INI: Nama produk/game yang direview -->
        <?php
          if ($r['jenis'] === 'produk') {
            $ref = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT nama FROM produk WHERE id=" . (int)$r['id_referensi']));
          } elseif ($r['jenis'] === 'game') {
            $ref = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT nama FROM game WHERE id=" . (int)$r['id_referensi']));
          } else {
            $ref = null; // lainnya tidak punya referensi
          }
        ?>
        <?php if ($ref): ?>
          <p class="review-ref">
            <?= $r['jenis'] === 'produk' ? '&#128722;' : '&#127918;' ?>
            <?= htmlspecialchars($ref['nama']) ?>
          </p>
        <?php endif; ?>

        <!-- Tampilkan bintang sesuai rating -->
        <div class="review-stars">
          <?php for ($i = 1; $i <= 5; $i++): ?>
            <span class="<?= $i <= $r['rating'] ? 'star-on' : 'star-off' ?>">&#9733;</span>
          <?php endfor; ?>
        </div>
        <p class="review-komentar"><?= htmlspecialchars($r['komentar']) ?></p>
        <p class="review-tanggal">
          <?= date('d M Y', strtotime($r['tanggal'])) ?>
          <!-- date() mengubah format tanggal: 2025-01-15 → 15 Jan 2025 -->
        </p>
      </div>
      <?php endwhile; ?>
    </div>
  </section>
  <?php endif; ?>

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

    // Ganti dropdown produk/game sesuai pilihan jenis
    function updateDropdown(jenis) {
    const produk = document.getElementById('dropdownProduk');
    const game   = document.getElementById('dropdownGame');

    if (jenis === 'produk') {
      produk.style.display = 'block';
      produk.name = 'id_referensi';

      game.style.display = 'none';
      game.name = '';

    } else if (jenis === 'game') {
      game.style.display = 'block';
      game.name = 'id_referensi';

      produk.style.display = 'none';
      produk.name = '';

    } else {
      // lainnya → gak pakai dropdown
      produk.style.display = 'none';
      produk.name = '';

      game.style.display = 'none';
      game.name = '';
    }
  }

    // Jalankan saat halaman load kalau sudah ada jenis dari URL
    window.onload = function() {
      const jenis = document.getElementById('selectJenis').value;
      updateDropdown(jenis);
    }
  </script>

</body>
</html>