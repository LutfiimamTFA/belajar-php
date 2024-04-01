<?php
session_start();

// Koneksi ke database (sesuaikan dengan pengaturan database Anda)
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'barang';

$koneksi = mysqli_connect($host, $username, $password, $database);

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Fungsi untuk memeriksa login
function login($username, $password, $koneksi) {
    $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($koneksi, $query);
    if (mysqli_num_rows($result) == 1) {
        return true;
    } else {
        return false;
    }
}

// Proses login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    if (login($username, $password, $koneksi)) {
        $_SESSION['username'] = $username;
        header("Location: read.php"); // Redirect ke halaman CRUD setelah login berhasil
    } else {
        $error = "Username atau password salah.";
    }
}

// Proses logout
if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: login.php"); // Redirect ke halaman login setelah logout
}

mysqli_close($koneksi);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <!-- AdminLTE CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/css/adminlte.min.css">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body class="hold-transition login-page" style="background-image: url('https://source.unsplash.com/1600x900/?nature'); background-size: cover;">
<div class="login-box">
    <div class="login-logo">
        <a href="#"><b>LOGIN</b>
    </div>
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <h1><i class="fas fa-user-lock"></i></h1>
            <p class="h5">Sign in to start your session</p>
        </div>
        <div class="card-body">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Username" name="username" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" placeholder="Password" name="password" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                    </div>
                </div>
            </form>
            <?php if (isset($error)): ?>
                <div class="alert alert-danger mt-3" role="alert"><?php echo $error; ?></div>
            <?php endif; ?>
        </div>
    </div>
</div>
<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/js/adminlte.min.js"></script>
</body>
</html>
