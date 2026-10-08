<?php
session_start();
if (!isset($_SESSION['admin'])) { header("Location: login.php"); exit; }
include '../config/koneksi.php';

if (isset($_GET['hapus'])) {
    $id = (int) $_GET['hapus'];
    $r = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT gambar FROM produk WHERE id=$id"));
    if ($r['gambar'] && file_exists('../images/' . $r['gambar'])) unlink('../images/' . $r['gambar']);
    mysqli_query($koneksi, "DELETE FROM produk WHERE id=$id");
    header("Location: adminproduk.php?pesan=hapus"); exit;
}

$edit = null;
if (isset($_GET['edit'])) {
    $id = (int) $_GET['edit'];
    $edit = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM produk WHERE id=$id"));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama      = mysqli_real_escape_string($koneksi, trim($_POST['nama']));
    $deskripsi = mysqli_real_escape_string($koneksi, trim($_POST['deskripsi']));
    $harga     = (float) $_POST['harga'];
    $stok      = (int) $_POST['stok'];
    $no_wa     = mysqli_real_escape_string($koneksi, trim($_POST['no_wa']));

    $gambar = $_POST['gambar_lama'] ?? '';
    if (!empty($_FILES['gambar']['name'])) {
        $ext = pathinfo($_FILES['gambar']['name'], PATHINFO_EXTENSION);
        $gambar = time() . '.' . $ext;
        move_uploaded_file($_FILES['gambar']['tmp_name'], '../images/' . $gambar);
    }

    if (!empty($_POST['id_edit'])) {
        $id = (int) $_POST['id_edit'];
        mysqli_query($koneksi, "UPDATE produk SET nama='$nama', deskripsi='$deskripsi', harga=$harga, stok=$stok, no_wa='$no_wa', gambar='$gambar' WHERE id=$id");
        header("Location: adminproduk.php?pesan=edit"); exit;
    } else {
        mysqli_query($koneksi, "INSERT INTO produk (nama, deskripsi, harga, stok, no_wa, gambar) VALUES ('$nama','$deskripsi',$harga,$stok,'$no_wa','$gambar')");
        header("Location: adminproduk.php?pesan=tambah"); exit;
    }
}

$data = mysqli_query($koneksi, "SELECT * FROM produk ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Produk — Admin YOGYAKARYA</title>
  <link rel="stylesheet" href="../style.php">
</head>
<body class="admin-page">
  <?php include 'sidebar.php'; ?>
  <div class="admin-content">
    <h2>Kelola Produk</h2>

    <?php if (isset($_GET['pesan'])): ?>
      <p class="success"><?= $_GET['pesan'] === 'tambah' ? 'Data berhasil ditambahkan!' : ($_GET['pesan'] === 'edit' ? 'Data berhasil diperbarui!' : 'Data berhasil dihapus!') ?></p>
    <?php endif; ?>

    <div class="admin-form">
      <h3><?= $edit ? 'Edit Produk' : 'Tambah Produk' ?></h3>
      <form method="POST" enctype="multipart/form-data">
        <?php if ($edit): ?>
          <input type="hidden" name="id_edit" value="<?= $edit['id'] ?>">
          <input type="hidden" name="gambar_lama" value="<?= $edit['gambar'] ?>">
        <?php endif; ?>
        <label>Nama Produk</label>
        <input type="text" name="nama" required value="<?= htmlspecialchars($edit['nama'] ?? '') ?>">
        <label>Deskripsi</label>
        <textarea name="deskripsi"><?= htmlspecialchars($edit['deskripsi'] ?? '') ?></textarea>
        <label>Harga (Rp)</label>
        <input type="number" name="harga" min="0" value="<?= $edit['harga'] ?? 0 ?>">
        <label>Stok</label>
        <input type="number" name="stok" min="0" value="<?= $edit['stok'] ?? 0 ?>">
        <label>Nomor WhatsApp</label>
        <input type="text" name="no_wa" placeholder="628xxxx" value="<?= htmlspecialchars($edit['no_wa'] ?? '') ?>">
        <label>Gambar</label>
        <input type="file" name="gambar" accept="image/*">
        <?php if (!empty($edit['gambar'])): ?>
          <img src="../images/<?= $edit['gambar'] ?>" width="120">
        <?php endif; ?>
        <button type="submit" class="btn-primary"><?= $edit ? 'Simpan Perubahan' : 'Tambah Data' ?></button>
        <?php if ($edit): ?><a href="adminproduk.php" class="btn-secondary">Batal</a><?php endif; ?>
      </form>
    </div>

    <table class="admin-table">
      <thead><tr><th>No</th><th>Gambar</th><th>Nama</th><th>Harga</th><th>Stok</th><th>No WA</th><th>Aksi</th></tr></thead>
      <tbody>
        <?php $no = 1; while ($row = mysqli_fetch_assoc($data)): ?>
        <tr>
          <td><?= $no++ ?></td>
          <td><?php if ($row['gambar']): ?><img src="../images/<?= $row['gambar'] ?>" width="60" style="object-fit:cover;height:40px;"><?php else: ?>—<?php endif; ?></td>
          <td><?= htmlspecialchars($row['nama']) ?></td>
          <td>Rp <?= number_format($row['harga'], 0, ',', '.') ?></td>
          <td><?= $row['stok'] ?></td>
          <td><?= $row['no_wa'] ?></td>
          <td>
            <a href="adminproduk.php?edit=<?= $row['id'] ?>" class="btn-edit">Edit</a>
            <a href="adminproduk.php?hapus=<?= $row['id'] ?>" class="btn-hapus" onclick="return confirm('Yakin hapus?')">Hapus</a>
          </td>
        </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>
</body>
</html>