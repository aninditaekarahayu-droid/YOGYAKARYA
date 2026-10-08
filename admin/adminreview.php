<?php
session_start();
if (!isset($_SESSION['admin'])) { header("Location: login.php"); exit; }
include '../config/koneksi.php';

// Hanya bisa hapus, tidak bisa edit review
if (isset($_GET['hapus'])) {
    $id = (int) $_GET['hapus'];
    mysqli_query($koneksi, "DELETE FROM review WHERE id=$id");
    header("Location: adminreview.php?pesan=hapus"); exit;
}

$data = mysqli_query($koneksi, "SELECT * FROM review ORDER BY tanggal DESC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Review — Admin YOGYAKARYA</title>
  <link rel="stylesheet" href="../style.php">
</head>
<body class="admin-page">
  <?php include 'sidebar.php'; ?>
  <div class="admin-content">
    <h2>Moderasi Review</h2>

    <?php if (isset($_GET['pesan'])): ?>
      <p class="success">Review berhasil dihapus!</p>
    <?php endif; ?>

    <table class="admin-table">
      <thead>
        <tr>
          <th>No</th>
          <th>Nama</th>
          <th>Jenis</th>
          <th>Rating</th>
          <th>Komentar</th>
          <th>Tanggal</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php $no = 1; while ($row = mysqli_fetch_assoc($data)): ?>
        <tr>
          <td><?= $no++ ?></td>
          <td><?= htmlspecialchars($row['nama_reviewer']) ?></td>
          <td><?= ucfirst($row['jenis']) ?></td>
          <td>
            <?php for ($i = 1; $i <= 5; $i++): ?>
              <span style="color:<?= $i <= $row['rating'] ? '#C9A84C' : '#ccc' ?>">★</span>
            <?php endfor; ?>
          </td>
          <td><?= htmlspecialchars(substr($row['komentar'], 0, 80)) ?>...</td>
          <td><?= date('d M Y', strtotime($row['tanggal'])) ?></td>
          <td>
            <a href="adminreview.php?hapus=<?= $row['id'] ?>" class="btn-hapus" onclick="return confirm('Yakin hapus review ini?')">Hapus</a>
          </td>
        </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>
</body>
</html>