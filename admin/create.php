<?php 

include '../koneksi.php';

session_start();
if (!isset($_SESSION['user'])) {
    echo "<script>alert('Mohon login terlebih dahulu')
    location.replace('../index.php')</script>";
}

$users = $conn->query("SELECT * FROM user");

if (isset($_POST['simpan'])) {
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $simpan = $conn->query("INSERT INTO user VALUES 
    (NULL, '$nama','$username','$password')");

    if ($simpan) {
        echo '<script>alert("Data Berhasil Disimpan");
    location.replace("index.php");</script>';
    } else {
        echo '<script>alert("Kurang jago Nyimpennya Luwh");
    location.replace("index.php");</script>';
    }
}




?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Admin</title>
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
                        <a class="nav-link" href="../produk">Produk</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php">Admin</a>
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
                        <h3 class="text-center">Tambah Admin</h3>
                    </div>
                    <div class="card-body">
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-grup mb-3">
                                        <label class="form-label" for="">Nama</label>
                                        <input type="text" required name="nama" placeholder="Nama" class="form-control">
                                    </div>
                                    <div class="form-grup mb-3">
                                        <label class="form-label" for="">Username</label>
                                        <input type="text" required name="username" placeholder="Username" class="form-control">
                                    </div>
                                    <div class="form-grup mb-3">
                                        <label class="form-label" for="">Password</label>
                                        <input type="text" required name="password" placeholder="Password" class="form-control">
                                    </div>
                                    <div class="form-group text-end">
                                        <button type="submit" name="simpan" class="btn btn-success btn-lg w-100 mt-4">Tambah</button>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <source src="../bootstrap/js/bootstrap.bundle.min.js" type="">

    
</body>
</html>