<?php
session_start();
if (!isset($_SESSION['admin'])) { header("Location: login.php"); exit; }
include '../config/koneksi.php';

if (isset($_GET['hapus'])) {
    $id = (int) $_GET['hapus'];
    mysqli_query($koneksi, "DELETE FROM game WHERE id=$id");
    header("Location: game.php?pesan=hapus"); exit;
}

$edit = null;
if (isset($_GET['edit'])) {
    $id = (int) $_GET['edit'];
    $edit = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM game WHERE id=$id"));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama          = mysqli_real_escape_string($koneksi, trim($_POST['nama']));
    $jenis         = $_POST['jenis'];
    $deskripsi     = mysqli_real_escape_string($koneksi, trim($_POST['deskripsi']));
    $cara_main     = mysqli_real_escape_string($koneksi, trim($_POST['cara_main']));
    $jumlah_pemain = mysqli_real_escape_string($koneksi, trim($_POST['jumlah_pemain']));
    $folder_game   = mysqli_real_escape_string($koneksi, trim($_POST['folder_game']));

    $thumbnail = $_POST['thumbnail_lama'] ?? '-';
    if (!empty($_FILES['thumbnail']['name'])) {
        $ext = pathinfo($_FILES['thumbnail']['name'], PATHINFO_EXTENSION);
        $thumbnail = time() . '.' . $ext;
        move_uploaded_file($_FILES['thumbnail']['tmp_name'], '../images/' . $thumbnail);
    }

    if (!empty($_POST['id_edit'])) {
        $id = (int) $_POST['id_edit'];
        mysqli_query($koneksi, "UPDATE game SET nama='$nama', jenis='$jenis', deskripsi='$deskripsi', cara_main='$cara_main', jumlah_pemain='$jumlah_pemain', folder_game='$folder_game', thumbnail='$thumbnail' WHERE id=$id");
        header("Location: game.php?pesan=edit"); exit;
    } else {
        mysqli_query($koneksi, "INSERT INTO game (nama, jenis, deskripsi, cara_main, jumlah_pemain, folder_game, thumbnail) VALUES ('$nama','$jenis','$deskripsi','$cara_main','$jumlah_pemain','$folder_game','$thumbnail')");
        header("Location: game.php?pesan=tambah"); exit;
    }
}

$data = mysqli_query($koneksi, "SELECT * FROM game ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Game — Admin YOGYAKARYA</title>
  <link rel="stylesheet" href="../style.php">
</head>
<body class="admin-page">
  <?php include 'sidebar.php'; ?>
  <div class="admin-content">
    <h2>Kelola Game</h2>

    <?php if (isset($_GET['pesan'])): ?>
      <p class="success"><?= $_GET['pesan'] === 'tambah' ? 'Data berhasil ditambahkan!' : ($_GET['pesan'] === 'edit' ? 'Data berhasil diperbarui!' : 'Data berhasil dihapus!') ?></p>
    <?php endif; ?>

    <div class="admin-form">
      <h3><?= $edit ? 'Edit Game' : 'Tambah Game' ?></h3>
      <form method="POST" enctype="multipart/form-data">
        <?php if ($edit): ?>
          <input type="hidden" name="id_edit" value="<?= $edit['id'] ?>">
          <input type="hidden" name="thumbnail_lama" value="<?= $edit['thumbnail'] ?>">
        <?php endif; ?>

        <label>Nama Game</label>
        <input type="text" name="nama" required value="<?= htmlspecialchars($edit['nama'] ?? '') ?>">

        <label>Jenis</label>
        <select name="jenis">
          <option value="board_game" <?= ($edit['jenis'] ?? '') === 'board_game' ? 'selected' : '' ?>>Board Game</option>
          <option value="digital"    <?= ($edit['jenis'] ?? '') === 'digital'    ? 'selected' : '' ?>>Digital</option>
        </select>

        <label>Deskripsi</label>
        <textarea name="deskripsi"><?= htmlspecialchars($edit['deskripsi'] ?? '') ?></textarea>

        <label>Cara Main (untuk board game)</label>
        <textarea name="cara_main" style="min-height:120px"><?= htmlspecialchars($edit['cara_main'] ?? '') ?></textarea>

        <label>Jumlah Pemain (untuk board game)</label>
        <input type="text" name="jumlah_pemain" value="<?= htmlspecialchars($edit['jumlah_pemain'] ?? '') ?>" placeholder="contoh: 2-4 pemain">

        <label>Folder Game (untuk game digital, contoh: jogjaksara)</label>
        <input type="text" name="folder_game" value="<?= htmlspecialchars($edit['folder_game'] ?? '-') ?>">

        <label>Thumbnail</label>
        <input type="file" name="thumbnail" accept="image/*">
        <?php if (!empty($edit['thumbnail']) && $edit['thumbnail'] !== '-'): ?>
          <img src="../images/<?= $edit['thumbnail'] ?>" width="120">
        <?php endif; ?>

        <button type="submit" class="btn-primary"><?= $edit ? 'Simpan Perubahan' : 'Tambah Data' ?></button>
        <?php if ($edit): ?><a href="game.php" class="btn-secondary">Batal</a><?php endif; ?>
      </form>
    </div>

    <table class="admin-table">
      <thead><tr><th>No</th><th>Thumbnail</th><th>Nama</th><th>Jenis</th><th>Pemain</th><th>Aksi</th></tr></thead>
      <tbody>
        <?php $no = 1; while ($row = mysqli_fetch_assoc($data)): ?>
        <tr>
          <td><?= $no++ ?></td>
          <td><?php if ($row['thumbnail'] && $row['thumbnail'] !== '-'): ?>
            <img src="../images/<?= $row['thumbnail'] ?>" width="60" style="object-fit:cover;height:40px;"><?php else: ?>—<?php endif; ?></td>
          <td><?= htmlspecialchars($row['nama']) ?></td>
          <td><?= $row['jenis'] === 'board_game' ? 'Board Game' : 'Digital' ?></td>
          <td><?= htmlspecialchars($row['jumlah_pemain'] ?: '-') ?></td>
          <td>
            <a href="game.php?edit=<?= $row['id'] ?>" class="btn-edit">Edit</a>
            <a href="game.php?hapus=<?= $row['id'] ?>" class="btn-hapus" onclick="return confirm('Yakin hapus?')">Hapus</a>
          </td>
        </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>
</body>
</html>