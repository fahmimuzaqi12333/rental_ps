<?php
session_start();

// Periksa apakah pengguna sudah login, jika iya, arahkan ke halaman beranda
if (isset($_SESSION['username'])) {
    header("Location: navbar.php");
    exit();
}

// Periksa apakah form login disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data formulir
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Pastikan username dan password sesuai dengan yang diharapkan
    if ($username == 'salmon' && $password == '123') {
        // Simpan nama pengguna dalam sesi
        $_SESSION['username'] = $username;

        // Redirect ke halaman beranda setelah login berhasil
        header("Location: navbar.php");
        exit();
    } else {
        // Jika username atau password tidak sesuai, tampilkan pesan error
        $error_message = "Username atau password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            margin-top: 100px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        input {
            width: 100%;
            padding: 8px;
            margin: 5px 0 15px 0;
            display: inline-block;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        button {
            background-color: #4caf50;
            color: white;
            padding: 10px 15px;
            border: none;
            cursor: pointer;
            width: 100%;
        }

        button:hover {
            opacity: 0.8;
        }

        .error {
            color: red;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <?php
        // Tampilkan pesan error jika ada
        if (isset($error_message)) {
            echo "<p class='error'>$error_message</p>";
        }
        ?>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="username"><b>Username</b></label>
            <input type="text" placeholder="Enter Username" name="username" required>

            <label for="password"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="password" required>

            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>