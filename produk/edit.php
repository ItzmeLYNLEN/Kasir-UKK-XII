<?php

include '../koneksi.php';

session_start();
if (!isset($_SESSION['user'])) {
    echo '<script>alert("login dlu ka");
    location.replace("../login.php")</script>';
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $produks = $conn->query("SELECT * FROM products WHERE id_product = '$id'")->fetch_assoc();
}

if (isset($_POST['update'])) {
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $direktori = "berkas/";
    $photo = $_FILES['image']['name'];
    move_uploaded_file($_FILES['image']['tmp_name'], $direktori . $photo);

    $simpan = $conn->query("UPDATE products SET name = '$nama', price = '$harga', stock = '$stok', image = '$photo'
    WHERE id_product = '$id'");

    if ($simpan) {
        echo '<script>alert("data diupdate");
        location.replace("index.php")</script>';
    } else {
        echo '<script>alert("data gagal diupdate");
        location.replace("index.php")</script>';
    }
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit | Produk</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-secondary ">
        <div class="container ">
            <a class="navbar-brand fw-bold" style="color:#3434cf; font-size: 24px;" href="#">Warung Kita</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php">Produk</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../admin">Admin</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../order">Pesan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../report">Laporan</a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="../logout.php">Keluar</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container pt-5">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-center">Tambah Produk</h3>
                    </div>
                    <div class="card-body">
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-grup mb-3">
                                        <label class="form-label" for="">Nama</label>
                                        <input type="text" required name="nama" placeholder="Nama" class="form-control" value="<?= $produks['name'] ?>">
                                    </div>
                                    <div class="form-grup mb-3">
                                        <label class="form-label" for="">Harga</label>
                                        <input type="text" required name="harga" placeholder="harga" class="form-control" value="<?= $produks['price'] ?>">
                                    </div>
                                    <div class="form-grup mb-3">
                                        <label class="form-label" for="">stok</label>
                                        <input type="text" required name="stok" placeholder="stok" class="form-control" value="<?= $produks['stock'] ?>">
                                    </div>
                                    <div class="form-grup mb-3">
                                        <label class="form-label" for="">Thumbnail</label>
                                        <input type="file" id="image" required name="image" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group text-end">
                                <button type="submit" name="update" class="btn btn-success btn-lg w-100 mt-4">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>