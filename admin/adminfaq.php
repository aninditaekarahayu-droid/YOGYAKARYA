<?php
session_start();
if (!isset($_SESSION['admin'])) { header("Location: login.php"); exit; }
include '../config/koneksi.php';

if (isset($_GET['hapus'])) {
    $id = (int) $_GET['hapus'];
    mysqli_query($koneksi, "DELETE FROM faq WHERE id=$id");
    header("Location: adminfaq.php?pesan=hapus"); exit;
}

$edit = null;
if (isset($_GET['edit'])) {
    $id = (int) $_GET['edit'];
    $edit = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM faq WHERE id=$id"));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pertanyaan = mysqli_real_escape_string($koneksi, trim($_POST['pertanyaan']));
    $jawaban    = mysqli_real_escape_string($koneksi, trim($_POST['jawaban']));
    $urutan     = (int) $_POST['urutan'];

    if (!empty($_POST['id_edit'])) {
        $id = (int) $_POST['id_edit'];
        mysqli_query($koneksi, "UPDATE faq SET pertanyaan='$pertanyaan', jawaban='$jawaban', urutan=$urutan WHERE id=$id");
        header("Location: adminfaq.php?pesan=edit"); exit;
    } else {
        mysqli_query($koneksi, "INSERT INTO faq (pertanyaan, jawaban, urutan) VALUES ('$pertanyaan','$jawaban',$urutan)");
        header("Location: adminfaq.php?pesan=tambah"); exit;
    }
}

$data = mysqli_query($koneksi, "SELECT * FROM faq ORDER BY urutan ASC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FAQ — Admin YOGYAKARYA</title>
  <link rel="stylesheet" href="../style.php">
</head>
<body class="admin-page">
  <?php include 'sidebar.php'; ?>
  <div class="admin-content">
    <h2>Kelola FAQ</h2>

    <?php if (isset($_GET['pesan'])): ?>
      <p class="success"><?= $_GET['pesan'] === 'tambah' ? 'FAQ berhasil ditambahkan!' : ($_GET['pesan'] === 'edit' ? 'FAQ berhasil diperbarui!' : 'FAQ berhasil dihapus!') ?></p>
    <?php endif; ?>

    <div class="admin-form">
      <h3><?= $edit ? 'Edit FAQ' : 'Tambah FAQ' ?></h3>
      <form method="POST">
        <?php if ($edit): ?>
          <input type="hidden" name="id_edit" value="<?= $edit['id'] ?>">
        <?php endif; ?>
        <label>Pertanyaan</label>
        <textarea name="pertanyaan" style="min-height:80px" required><?= htmlspecialchars($edit['pertanyaan'] ?? '') ?></textarea>
        <label>Jawaban</label>
        <textarea name="jawaban" style="min-height:120px" required><?= htmlspecialchars($edit['jawaban'] ?? '') ?></textarea>
        <label>Urutan Tampil</label>
        <input type="number" name="urutan" min="1" value="<?= $edit['urutan'] ?? 1 ?>">
        <button type="submit" class="btn-primary"><?= $edit ? 'Simpan Perubahan' : 'Tambah FAQ' ?></button>
        <?php if ($edit): ?><a href="adminfaq.php" class="btn-secondary">Batal</a><?php endif; ?>
      </form>
    </div>

    <table class="admin-table">
      <thead><tr><th>No</th><th>Urutan</th><th>Pertanyaan</th><th>Jawaban</th><th>Aksi</th></tr></thead>
      <tbody>
        <?php $no = 1; while ($row = mysqli_fetch_assoc($data)): ?>
        <tr>
          <td><?= $no++ ?></td>
          <td><?= $row['urutan'] ?></td>
          <td><?= htmlspecialchars(substr($row['pertanyaan'], 0, 60)) ?>...</td>
          <td><?= htmlspecialchars(substr($row['jawaban'], 0, 80)) ?>...</td>
          <td>
            <a href="adminfaq.php?edit=<?= $row['id'] ?>" class="btn-edit">Edit</a>
            <a href="adminfaq.php?hapus=<?= $row['id'] ?>" class="btn-hapus" onclick="return confirm('Yakin hapus FAQ ini?')">Hapus</a>
          </td>
        </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>
</body>
</html>