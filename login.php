<?php
include 'functions.php';
session_start();

// Validasi login
if (isset($_SESSION['username'])) {
    header("Location: index.php"); // Jika sudah login, arahkan ke halaman yang sesuai
    exit();
}

if (isset($_POST['submit'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $sql = "SELECT * FROM login WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    if ($result->num_rows > 0) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['username'] = $row['username'];
        header("Location: login.php"); // Arahkan ke halaman selamat datang
        exit();
    } else {
        $error_message = "Username atau password Anda salah. Silakan coba lagi.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Login</title>
</head>

<body>
    <h1>Form Login</h1>
    <form action="" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <button type="submit" name="submit">Login</button>
    </form>
    <?php if (isset($error_message)): ?>
        <p>
            <?php echo $error_message; ?>
        </p>
    <?php endif; ?>
</body>

</html>