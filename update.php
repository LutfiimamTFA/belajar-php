<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';

// Check if the product id exists
if (isset($_GET['id'])) {
    if (!empty($_POST)) {
        // Set-up the variables to update
        $id = isset($_POST['id']) ? $_POST['id'] : NULL;
        $nama_produk = isset($_POST['nama_produk']) ? $_POST['nama_produk'] : '';
        $harga = isset($_POST['harga']) ? $_POST['harga'] : '';
        $deskripsi = isset($_POST['deskripsi']) ? $_POST['deskripsi'] : '';
        $stok = isset($_POST['stok']) ? $_POST['stok'] : '';
        $tanggal_masuk = isset($_POST['tanggal_masuk']) ? $_POST['tanggal_masuk'] : '';
        $tanggal_kadaluarsa = isset($_POST['tanggal_kadaluarsa']) ? $_POST['tanggal_kadaluarsa'] : '';

        // Update the record
        $stmt = $pdo->prepare('UPDATE produk SET nama_produk = ?, harga = ?, deskripsi = ?, stok = ?, tanggal_masuk = ?, tanggal_kadaluarsa = ? WHERE id = ?');
        $stmt->execute([$nama_produk, $harga, $deskripsi, $stok, $tanggal_masuk, $tanggal_kadaluarsa, $id]);
        
        // Output message
        $msg = 'Produk berhasil diperbarui!';
    }
    
    // Get the product from the produk table
    $stmt = $pdo->prepare('SELECT * FROM produk WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$product) {
        exit('Produk dengan ID tersebut tidak ditemukan!');
    }
} else {
    exit('ID tidak spesifik!');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Produk</title>
    <!-- AdminLTE CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/css/adminlte.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Update Produk #<?=$product['id']?></h1>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Form Update Produk</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form role="form" action="update.php?id=<?=$product['id']?>" method="post">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="id">ID</label>
                                            <input type="text" class="form-control" id="id" name="id" value="<?=$product['id']?>" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="nama_produk">Nama Produk</label>
                                            <input type="text" class="form-control" id="nama_produk" name="nama_produk" value="<?=$product['nama_produk']?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="harga">Harga</label>
                                            <input type="text" class="form-control" id="harga" name="harga" value="<?=$product['harga']?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="deskripsi">Deskripsi</label>
                                            <input type="text" class="form-control" id="deskripsi" name="deskripsi" value="<?=$product['deskripsi']?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="stok">Stok</label>
                                            <input type="text" class="form-control" id="stok" name="stok" value="<?=$product['stok']?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="tanggal_masuk">Tanggal Masuk</label>
                                            <input type="date" class="form-control" id="tanggal_masuk" name="tanggal_masuk" value="<?=$product['tanggal_masuk']?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="tanggal_kadaluarsa">Tanggal Kadaluarsa</label>
                                            <input type="date" class="form-control" id="tanggal_kadaluarsa" name="tanggal_kadaluarsa" value="<?=$product['tanggal_kadaluarsa']?>">
                                        </div>
                                    </div>
                                    <!-- /.card-body -->
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">Update</button>
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
    </div>
    <!-- ./wrapper -->

    <!-- AdminLTE JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/js/adminlte.min.js"></script>

</body>
</html>
<?php
ob_start(); // Mulai penangkapan output

// Mulai konten PHP Anda di sini

?>

