<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';

// Check if POST data is not empty
if (!empty($_POST)) {
    // Post data not empty, insert a new record
    // Set-up the variables that are going to be inserted, we must check if the POST variables exist if not we can default them to blank
    $id = isset($_POST['id']) && !empty($_POST['id']) && $_POST['id'] != 'auto' ? $_POST['id'] : NULL;
    $nama_produk = isset($_POST['nama_produk']) ? $_POST['nama_produk'] : '';
    $harga = isset($_POST['harga']) ? $_POST['harga'] : '';
    $deskripsi = isset($_POST['deskripsi']) ? $_POST['deskripsi'] : '';
    $stok = isset($_POST['stok']) ? $_POST['stok'] : '';
    $tanggal_masuk = isset($_POST['tanggal_masuk']) ? $_POST['tanggal_masuk'] : '';
    $tanggal_kadaluarsa = isset($_POST['tanggal_kadaluarsa']) ? $_POST['tanggal_kadaluarsa'] : '';

    // Insert new record into the produk table
    $stmt = $pdo->prepare('INSERT INTO produk (id, nama_produk, harga, deskripsi, stok, tanggal_masuk, tanggal_kadaluarsa) VALUES (?, ?, ?, ?, ?, ?, ?)');
    $stmt->execute([$id, $nama_produk, $harga, $deskripsi, $stok, $tanggal_masuk, $tanggal_kadaluarsa]);
    
    // Output message
    $msg = 'Produk berhasil ditambahkan!';
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Tambah Produk</title>
<!-- AdminLTE CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="logout.php">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="index.php" class="brand-link">
            <span class="brand-text font-weight-light">AdminLTE</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item">
                        <a href="read.php" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="create.php" class="nav-link">
                            <i class="nav-icon fas fa-plus"></i>
                            <p>Tambah Produk</p>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Tambah Produk</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Form Tambah Produk</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form role="form" action="create.php" method="post">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="nama_produk">Nama Produk</label>
                                        <input type="text" class="form-control" id="nama_produk" name="nama_produk" placeholder="Masukkan Nama Produk">
                                    </div>
                                    <div class="form-group">
                                        <label for="harga">Harga</label>
                                        <input type="text" class="form-control" id="harga" name="harga" placeholder="Masukkan Harga">
                                    </div>
                                    <div class="form-group">
                                        <label for="deskripsi">Deskripsi</label>
                                        <input type="text" class="form-control" id="deskripsi" name="deskripsi" placeholder="Masukkan Deskripsi">
                                    </div>
                                    <div class="form-group">
                                        <label for="stok">Stok</label>
                                        <input type="text" class="form-control" id="stok" name="stok" placeholder="Masukkan Stok">
                                    </div>
                                    <div class="form-group">
                                        <label for="tanggal_masuk">Tanggal Masuk</label>
                                        <input type="date" class="form-control" id="tanggal_masuk" name="tanggal_masuk">
                                    </div>
                                    <div class="form-group">
                                        <label for="tanggal_kadaluarsa">Tanggal Kadaluarsa</label>
                                        <input type="date" class="form-control" id="tanggal_kadaluarsa" name="tanggal_kadaluarsa">
                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Tambah</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    if ($msg) {
    header("Location: read.php");
    exit();
}

    <!-- Main Footer -->
    <footer class="main-footer">
        <!-- To the right -->
        <div class="float-right d-none d-sm-inline">
            Anything you want
        </div>
        <!-- Default to the left -->
        <strong>Footer &copy; 2024</strong>
    </footer>
</div>
<!-- ./wrapper -->

<!-- AdminLTE JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/js/adminlte.min.js"></script>
</body>
</html>
<?php
// Mengalihkan pengguna ke halaman read.php setelah berhasil diupdate
if ($msg) {
    header("Location: read.php");
    exit();
}