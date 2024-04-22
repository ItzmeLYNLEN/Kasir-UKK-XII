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

if (isset($_POST['delete'])) {
    $id = $_POST['id'];
    $delete = $conn->query("DELETE FROM user WHERE id_users = '$id'");
    if ($delete) {
        echo '<script>alert("data berhasil dihapus");
        location.replace("index.php")</script>';
    } else {
        echo '<script>alert("data gagal dihapus");
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
    <title>Admin</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
</head>

<body>

    <nav class="navbar navbar-expand-lg bg-body-secondary ">
        <div class="container ">
            <a class="navbar-brand fw-bold" href="#" style="color:#3434cf;">Warung Kita</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
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

            <div class="row justify-content-center mb-5">
                <div class="col-lg-10 pt-5">
                    <div class="card ">
                        <div class="card-body">
                            <div class="col-lg-4">
                                <input type="text" id="searchInput" class="form-control mb-3" placeholder="Cari...">
                            </div>
                            <table class=" table table-hover">
                                <thead>
                                    <tr class="text-center">
                                        <th>#</th>
                                        <th>Nama</th>
                                        <th>Username</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($users as $user) { ?>
                                        <tr>
                                            <td class="text-center"><?= $no++ ?></td>
                                            <td class="text-center"><?= $user['name'] ?></td>
                                            <td class="text-center"><?= $user['username'] ?></td>
                                            <td class="text-center">
                                                <a href="edit.php?id=<?= $user['id_users'] ?>" class="btn btn-warning text-white btn-sm">Ubah <i class="bi bi-pencil-fill"></i></a>
                                                <form action="" method="POST">
                                                    <input type="hidden" name="id" value="<?= $user['id_users'] ?>">
                                                    <button type="submit" name="delete" class="btn btn-danger text-white btn-sm">Hapus <i class="bi bi-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                document.getElementById("searchInput").addEventListener("keyup", function() {
                    var input, filter, table, tr, td, i, txtValue;
                    input = document.getElementById("searchInput");
                    filter = input.value.toUpperCase();
                    table = document.querySelector("table");
                    tr = table.getElementsByTagName("tr");
                    for (i = 0; i < tr.length; i++) {
                        td = tr[i].getElementsByTagName("td");
                        for (var j = 0; j < td.length; j++) {
                            if (td[j]) {
                                txtValue = td[j].textContent || td[j].innerText;
                                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                                    tr[i].style.display = "";
                                    break;
                                } else {
                                    tr[i].style.display = "none";
                                }
                            }
                        }
                    }
                });
            });
        </script>



        <source src="../bootstrap/js/bootstrap.bundle.min.js" type="">
</body>

</html>