<?php
session_start();
if (isset($_SESSION['admin'])) {
    header("Location: admindex.php");
    exit;
}
$error = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = $_POST['username'];
    $pass = $_POST['password'];
    if ($user === "admin" && $pass === "jogja123") {
        $_SESSION['admin'] = true;
        header("Location: admindex.php");
        exit;
    } else {
        $error = "Username atau password salah!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Admin — YOGYAKARYA</title>
  <link rel="stylesheet" href="../style.php">
</head>
<body class="login-page">
  <div class="login-box">
    <h2>YOGYAKARYA</h2>
    <p>Admin Panel</p>
    <?php if ($error): ?>
      <p class="error"><?= $error ?></p>
    <?php endif; ?>
    <form method="POST">
      <input type="text" name="username" placeholder="Username" required>
      <input type="password" name="password" placeholder="Password" required>
      <button type="submit" class="btn-primary">Masuk</button>
    </form>
  </div>
</body>
</html>