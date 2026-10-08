<?php
session_start();
if (!isset($_SESSION['admin'])) { header("Location: login.php"); exit; }
include '../config/koneksi.php';

if (isset($_GET['hapus'])) {
    $id = (int) $_GET['hapus'];
    $r = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT gambar FROM warisan WHERE id=$id"));
    if ($r['gambar'] && file_exists('../images/' . $r['gambar'])) unlink('../images/' . $r['gambar']);
    mysqli_query($koneksi, "DELETE FROM warisan WHERE id=$id");
    header("Location: adminwarisan.php?pesan=hapus"); exit;
}

$edit = null;
if (isset($_GET['edit'])) {
    $id = (int) $_GET['edit'];
    $edit = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM warisan WHERE id=$id"));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama        = mysqli_real_escape_string($koneksi, trim($_POST['nama']));
    $deskripsi   = mysqli_real_escape_string($koneksi, trim($_POST['deskripsi']));
    $asal_daerah = mysqli_real_escape_string($koneksi, trim($_POST['asal_daerah']));

    $gambar = $_POST['gambar_lama'] ?? '';
    if (!empty($_FILES['gambar']['name'])) {
        $ext = pathinfo($_FILES['gambar']['name'], PATHINFO_EXTENSION);
        $gambar = time() . '.' . $ext;
        move_uploaded_file($_FILES['gambar']['tmp_name'], '../images/' . $gambar);
    }

    if (!empty($_POST['id_edit'])) {
        $id = (int) $_POST['id_edit'];
        mysqli_query($koneksi, "UPDATE warisan SET nama='$nama', deskripsi='$deskripsi', asal_daerah='$asal_daerah', gambar='$gambar' WHERE id=$id");
        header("Location: adminwarisan.php?pesan=edit"); exit;
    } else {
        mysqli_query($koneksi, "INSERT INTO warisan (nama, deskripsi, asal_daerah, gambar) VALUES ('$nama','$deskripsi','$asal_daerah','$gambar')");
        header("Location: adminwarisan.php?pesan=tambah"); exit;
    }
}

$data = mysqli_query($koneksi, "SELECT * FROM warisan ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Warisan — Admin YOGYAKARYA</title>
  <link rel="stylesheet" href="../style.php">
</head>
<body class="admin-page">
  <?php include 'sidebar.php'; ?>
  <div class="admin-content">
    <h2>Kelola Warisan Budaya</h2>

    <?php if (isset($_GET['pesan'])): ?>
      <p class="success"><?= $_GET['pesan'] === 'tambah' ? 'Data berhasil ditambahkan!' : ($_GET['pesan'] === 'edit' ? 'Data berhasil diperbarui!' : 'Data berhasil dihapus!') ?></p>
    <?php endif; ?>

    <div class="admin-form">
      <h3><?= $edit ? 'Edit Warisan' : 'Tambah Warisan' ?></h3>
      <form method="POST" enctype="multipart/form-data">
        <?php if ($edit): ?>
          <input type="hidden" name="id_edit" value="<?= $edit['id'] ?>">
          <input type="hidden" name="gambar_lama" value="<?= $edit['gambar'] ?>">
        <?php endif; ?>
        <label>Nama Warisan</label>
        <input type="text" name="nama" required value="<?= htmlspecialchars($edit['nama'] ?? '') ?>">
        <label>Deskripsi</label>
        <textarea name="deskripsi"><?= htmlspecialchars($edit['deskripsi'] ?? '') ?></textarea>
        <label>Asal Daerah</label>
        <input type="text" name="asal_daerah" value="<?= htmlspecialchars($edit['asal_daerah'] ?? '') ?>">
        <label>Gambar</label>
        <input type="file" name="gambar" accept="image/*">
        <?php if (!empty($edit['gambar'])): ?>
          <img src="../images/<?= $edit['gambar'] ?>" width="120">
        <?php endif; ?>
        <button type="submit" class="btn-primary"><?= $edit ? 'Simpan Perubahan' : 'Tambah Data' ?></button>
        <?php if ($edit): ?><a href="adminwarisan.php" class="btn-secondary">Batal</a><?php endif; ?>
      </form>
    </div>

    <table class="admin-table">
      <thead><tr><th>No</th><th>Gambar</th><th>Nama</th><th>Asal Daerah</th><th>Aksi</th></tr></thead>
      <tbody>
        <?php $no = 1; while ($row = mysqli_fetch_assoc($data)): ?>
        <tr>
          <td><?= $no++ ?></td>
          <td><?php if ($row['gambar']): ?>
           <img src="../images/<?= $row['gambar'] ?>" width="60" style="object-fit:cover;height:40px;"><?php else: ?>—<?php endif; ?></td>
          <td><?= htmlspecialchars($row['nama']) ?></td>
          <td><?= htmlspecialchars($row['asal_daerah']) ?></td>
          <td>
            <a href="adminwarisan.php?edit=<?= $row['id'] ?>" class="btn-edit">Edit</a>
            <a href="adminwarisan.php?hapus=<?= $row['id'] ?>" class="btn-hapus" onclick="return confirm('Yakin hapus?')">Hapus</a>
          </td>
        </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>
</body>
</html>