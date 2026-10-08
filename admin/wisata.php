<?php
session_start();
if (!isset($_SESSION['admin'])) { header("Location: login.php"); exit; }
include '../config/koneksi.php';

// HAPUS
if (isset($_GET['hapus'])) {
    $id = (int) $_GET['hapus'];
    // Ambil nama gambar dulu untuk dihapus dari folder
    $r = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT gambar FROM destinasi WHERE id=$id"));
    if ($r['gambar'] && file_exists('../images/' . $r['gambar'])) {
        unlink('../images/' . $r['gambar']);
    }
    mysqli_query($koneksi, "DELETE FROM destinasi WHERE id=$id");
    header("Location: wisata.php?pesan=hapus"); exit;
}

// AMBIL DATA UNTUK EDIT
$edit = null;
if (isset($_GET['edit'])) {
    $id = (int) $_GET['edit'];
    $edit = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM destinasi WHERE id=$id"));
}

// PROSES FORM (INSERT atau UPDATE)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama      = mysqli_real_escape_string($koneksi, trim($_POST['nama']));
    $deskripsi = mysqli_real_escape_string($koneksi, trim($_POST['deskripsi']));
    $lokasi    = mysqli_real_escape_string($koneksi, trim($_POST['lokasi']));
    $kategori  = mysqli_real_escape_string($koneksi, trim($_POST['kategori']));

    // Upload gambar
    $gambar = $_POST['gambar_lama'] ?? '';
    if (!empty($_FILES['gambar']['name'])) {
        $ext    = pathinfo($_FILES['gambar']['name'], PATHINFO_EXTENSION);
        $gambar = time() . '.' . $ext;
        // Simpan langsung ke images/ tanpa subfolder
        move_uploaded_file($_FILES['gambar']['tmp_name'], '../images/' . $gambar);
    }
    if (!empty($_POST['id_edit'])) {
        $id = (int) $_POST['id_edit'];
        mysqli_query($koneksi, "UPDATE destinasi SET nama='$nama', deskripsi='$deskripsi', lokasi='$lokasi', gambar='$gambar', kategori='$kategori' WHERE id=$id");
        header("Location: wisata.php?pesan=edit"); exit;
    } else {
        mysqli_query($koneksi, "INSERT INTO destinasi (nama, deskripsi, lokasi, gambar, kategori) VALUES ('$nama','$deskripsi','$lokasi','$gambar','$kategori')");
        header("Location: wisata.php?pesan=tambah"); exit;
    }
}

$data = mysqli_query($koneksi, "SELECT * FROM destinasi ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Destinasi — Admin YOGYAKARYA</title>
  <link rel="stylesheet" href="../style.php">
</head>
<body class="admin-page">

  <?php include 'sidebar.php'; ?>

  <div class="admin-content">
    <h2>Kelola Destinasi</h2>

    <?php if (isset($_GET['pesan'])): ?>
      <p class="success">
        <?= $_GET['pesan'] === 'tambah' ? 'Data berhasil ditambahkan!' : ($_GET['pesan'] === 'edit' ? 'Data berhasil diperbarui!' : 'Data berhasil dihapus!') ?>
      </p>
    <?php endif; ?>

    <!-- FORM TAMBAH / EDIT -->
    <div class="admin-form">
      <h3><?= $edit ? 'Edit Destinasi' : 'Tambah Destinasi' ?></h3>
      <form method="POST" enctype="multipart/form-data">
        <?php if ($edit): ?>
          <input type="hidden" name="id_edit" value="<?= $edit['id'] ?>">
          <input type="hidden" name="gambar_lama" value="<?= $edit['gambar'] ?>">
        <?php endif; ?>

        <label>Nama Tempat</label>
        <input type="text" name="nama" required value="<?= htmlspecialchars($edit['nama'] ?? '') ?>">

        <label>Deskripsi</label>
        <textarea name="deskripsi"><?= htmlspecialchars($edit['deskripsi'] ?? '') ?></textarea>

        <label>Lokasi</label>
        <input type="text" name="lokasi" value="<?= htmlspecialchars($edit['lokasi'] ?? '') ?>">

        <label>Kategori (alam / sejarah / budaya)</label>
        <input type="text" name="kategori" value="<?= htmlspecialchars($edit['kategori'] ?? '') ?>">

        <label>Gambar</label>
        <input type="file" name="gambar" accept="image/*">
        <?php if (!empty($edit['gambar'])): ?>
          <img src="../images/<?= $edit['gambar'] ?>" width="120">
        <?php endif; ?>

        <button type="submit" class="btn-primary">
          <?= $edit ? 'Simpan Perubahan' : 'Tambah Data' ?>
        </button>
        <?php if ($edit): ?>
          <a href="wisata.php" class="btn-secondary">Batal</a>
        <?php endif; ?>
      </form>
    </div>

    <!-- TABEL DATA -->
    <table class="admin-table">
      <thead>
        <tr>
          <th>No</th>
          <th>Gambar</th>
          <th>Nama</th>
          <th>Lokasi</th>
          <th>Kategori</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php $no = 1; while ($row = mysqli_fetch_assoc($data)): ?>
        <tr>
          <td><?= $no++ ?></td>
          <td>
            <?php if ($row['gambar']): ?>
              <img src="../images/<?= $row['gambar'] ?>" width="60" style="object-fit:cover;height:40px;">
            <?php else: ?>—<?php endif; ?>
          </td>
          <td><?= htmlspecialchars($row['nama']) ?></td>
          <td><?= htmlspecialchars($row['lokasi']) ?></td>
          <td><?= htmlspecialchars($row['kategori']) ?></td>
          <td>
            <a href="wisata.php?edit=<?= $row['id'] ?>" class="btn-edit">Edit</a>
            <a href="wisata.php?hapus=<?= $row['id'] ?>" class="btn-hapus" onclick="return confirm('Yakin hapus?')">Hapus</a>
          </td>
        </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>

</body>
</html>