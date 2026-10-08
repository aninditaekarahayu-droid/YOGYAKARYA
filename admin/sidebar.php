<div class="admin-sidebar">
  <h3>Yogyakarya</h3>
  <nav>
    <a href="admindex.php"   <?= basename($_SERVER['PHP_SELF']) == 'admindex.php'   ? 'class="active"' : '' ?>>Dashboard</a>
    <a href="wisata.php"  <?= basename($_SERVER['PHP_SELF']) == 'wisata.php'  ? 'class="active"' : '' ?>>Destinasi</a>
    <a href="adminwarisan.php" <?= basename($_SERVER['PHP_SELF']) == 'adminwarisan.php' ? 'class="active"' : '' ?>>Warisan</a>
    <a href="adminkuliner.php" <?= basename($_SERVER['PHP_SELF']) == 'adminkuliner.php' ? 'class="active"' : '' ?>>Kuliner</a>
    <a href="adminproduk.php"  <?= basename($_SERVER['PHP_SELF']) == 'adminproduk.php'  ? 'class="active"' : '' ?>>Produk</a>
    <a href="game.php"    <?= basename($_SERVER['PHP_SELF']) == 'game.php'    ? 'class="active"' : '' ?>>Game</a>
    <a href="adminreview.php"  <?= basename($_SERVER['PHP_SELF']) == 'adminreview.php'  ? 'class="active"' : '' ?>>Review</a>
    <a href="adminfaq.php"     <?= basename($_SERVER['PHP_SELF']) == 'adminfaq.php'     ? 'class="active"' : '' ?>>FAQ</a>
    <a href="../beranda.php">Lihat Website</a>
    <a href="logout.php">Logout</a>
  </nav>
</div>