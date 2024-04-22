<?php

include '../koneksi.php';

session_start();
if (!isset($_SESSION['user'])) {
    echo "<script>alert('Mohon login terlebih dahulu')
  location.replace('login.php')</script>";
}

$produks = $conn->query("SELECT * FROM products");

if (isset($_POST['simpan_cust'])) {
    $_SESSION['nama_cust'] = $_POST['nama_cust'];
    $_SESSION['no_order'] = $_POST['no_order'];
    $_SESSION['order_type'] = $_POST['order_type'];
} else {
}

$nomer = isset($_SESSION['no_order']) ? $_SESSION['no_order'] : '';
$harga = $conn->query("SELECT * FROM products")->fetch_assoc();

if (isset($_POST['pesan'])) {
    $nama_cust = htmlspecialchars($_SESSION['nama_cust']);
    $no_order = htmlspecialchars($_SESSION['no_order']);
    $user = htmlspecialchars($_SESSION['id_user']);
    $order_type = htmlspecialchars($_SESSION['order_type']);
    $id_produk = $_POST['id_product'];
    $price = $_POST['price'];
    $qty = $_POST['qty'];
    $jumlah = $price * $qty;

    $simpan = $conn->query("INSERT INTO tbl_order VALUES(NULL,'$no_order','$user','$qty','1','0','0',NULL,'$id_produk','$nama_cust','$order_type','$price','$jumlah')");

    if ($simpan > 0) {
        echo "<script>
        location.replace('')</script>";
    }
}

if (isset($_POST['delete'])) {
    $id = $_POST['id'];
    $delete = $conn->query("DELETE FROM tbl_order WHERE id_order = '$id'");
    if ($delete) {
        echo '<script>alert("Pesanan berhasil dihapus");
        location.replace("index.php")</script>';
    } else {
        echo '<script>alert("Pesanan gagal dihapus");
        location.replace("index.php")</script>';
    }
}



$total = $conn->query("SELECT * FROM tbl_order JOIN products ON tbl_order.id_product = products.id_product WHERE no_order = '$nomer'");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesan</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-secondary ">
        <div class="container ">
            <a class="navbar-brand fw-bold" style="color:#3434cf;" href="#">Warung Kita</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="../produk">Produk</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="../admin">Admin</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php">Pesan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../report">Laporan</a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <?= $_SESSION['user']['username'] ?>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="../logout.php">Keluar</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>




    <form action="" method="post">
        <div class="row justify-content-center">
            <div class="card mt-5" style="width: 48rem;">
                <h3 class="text-center pt-2">ISI DATA PELANGGAN</h3>
                <div class="card-body">
                    <div class="col-lg-12 ">
                        <div class="d-flex mb-2">
                            <div class="col-lg-2 ">
                                <label for="nama_cust">Pelanggan :</label>
                            </div>
                            <div class="col-lg-10 me-2">
                                <input type="text" name="nama_cust" id="nama_cust" class="form-control" required>
                            </div>
                        </div>
                        <div class="d-flex mb-2">
                            <div class="col-lg-2 ">
                                <label for="no_order">No Pesanan :</label>
                            </div>
                            <div class="col-lg-10 me-2">
                                <input type="text" name="no_order" id="no_order" class="form-control" required>
                            </div>
                        </div>
                        <div class="d-flex mb-2">
                            <div class="col-lg-2 ">
                                <label for="order_type" required>Tipe Pesanan :</label>
                            </div>
                            <div class="col-lg-10 me-2">
                                <select name="order_type" id="order_type" class="form-control" required>
                                    <option value="">Pilih tipe</option>
                                    <option value="Dine_In">dine in</option>
                                    <option value="To_Go">to go</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" name="simpan_cust" class="btn btn-success w-100">Simpan Data</button>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </form>



    <div class="container pt-5">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h3 class="text-center">Pelanggan</h3>
                        <div class="d-flex mb-2">
                            <div class="col-lg-2 ">
                                <label for="nama_cust">Pelanggan </label>
                            </div>
                            <div class="col-lg-10 me-2">
                                <input type="text" class="form-control" value="<?= $_SESSION['nama_cust'] ?? '' ?>" readonly>
                            </div>
                        </div>
                        <div class="d-flex mb-2">
                            <div class="col-lg-2 ">
                                <label for="nama_cust" class="text-center">No Pesanan </label>
                            </div>
                            <div class="col-lg-10 me-2">
                                <input type="text" class="form-control" value="<?= $_SESSION['no_order'] ?? '' ?>" readonly>
                            </div>
                        </div>
                        <div class="d-flex mb-2">
                            <div class="col-lg-2 ">
                                <label for="nama_cust">Tipe Pesanan </label>
                            </div>
                            <div class="col-lg-10 me-2">
                                <input type="text" class="form-control" value="<?= $_SESSION['order_type'] ?? '' ?>" readonly>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container pt-5">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="card">
                    <h3 class="text-center pt-3">Menu</h3>
                    <div class="card-body">
                    <div class="col-lg-4">
                        <input type="text" id="searchInput" class="form-control mb-3" placeholder="Cari...">
                    </div>
                        <table class=" table table-hover">
                            <thead>
                                <tr>
                                    <th>Thumbnail</th>
                                    <th>Nama</th>
                                    <th>Harga</th>
                                    <th>Stok</th>
                                    <th>Jumlah</th>
                                    <th class="text-center">Pesan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($produks as $produk) { ?>
                                    <tr>
                                        <td><img src="../produk/berkas/<?= $produk['image'] ?>" style="height:100px;"> </td>
                                        <td><?= $produk['name'] ?></td>
                                        <td><?= number_format($produk['price']) ?></td>
                                        <td><?= $produk['stock'] ?></td>
                                        <td>
                                            <form action="" method="post">
                                                <input type="number" name="qty" id="qty<?= $produk['id_product'] ?>" class="form-control" value="0" min="1" required>
                                        </td>
                                        <td class="text-center">
                                            <input type="hidden" name="id_product" value="<?= $produk['id_product'] ?>">
                                            <input type="hidden" name="price" value="<?= $produk['price'] ?>">
                                            <button type="submit" name="pesan" class="btn btn-warning text-white btn-sm" onclick="return validateQty(<?= $produk['stock'] ?>, <?= $produk['id_product'] ?>)">Tambah</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php } ?>

                                <script>
                                    function validateQty(stock, productId) {
                                        var qtyInput = document.getElementById('qty' + productId);
                                        var qty = parseInt(qtyInput.value);
                                        if (qty > stock) {
                                            alert("Maaf, qty yang diminta melebihi stock yang tersedia.");
                                            return false; // Menghentikan pengiriman form
                                        }
                                        return true; // Mengizinkan pengiriman form
                                    }
                                </script>
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


    <div class="container pt-5">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="card ">
                    <h3 class="text-center pt-3">Pesanan</h3>
                    <div class="card-body">
                        <table class=" table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>No Pesan</th>
                                    <th>Nama Produk</th>
                                    <th>Jumlah</th>
                                    <th>Harga</th>
                                    <th>Batalkan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($total as $produk) { ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $produk['no_order'] ?></td>
                                        <td><?php
                                            $id = $produk['id_product'];
                                            $name = $conn->query("SELECT * FROM products WHERE id_product = '$id'")->fetch_assoc();
                                            echo $name['name']; ?></td>
                                        <td><?= $produk['qty'] ?></td>
                                        <td>
                                            <?php $totalprice = $produk['price'] * $produk['qty'];
                                            echo  number_format($totalprice);
                                            ?></td>
                                        <td>
                                            <form action="" method="POST">
                                                <input type="hidden" name="id" value="<?= $produk['id_order'] ?>">
                                                <button type="submit" name="delete" class="btn btn-danger text-white btn-sm">Batal </button>
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

    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <form action="" method="post">
                            <h4><?php
                                if (isset($_SESSION['no_order'])) {
                                    $no_order = $_SESSION['no_order'];


                                    $query = "SELECT * FROM tbl_order JOIN products ON tbl_order.id_product = products.id_product WHERE no_order = '$no_order'";
                                    $result = $conn->query($query);


                                    if ($result) {
                                        $totalharga = 0;
                                        foreach ($result as $bayar) {

                                            $totalharga += $bayar['total_harga'];
                                        }
                                        echo "Total Biaya : " . number_format($totalharga);
                                    } else {

                                        echo "Gagal mengambil total harga pesanan";
                                    }
                                } else {

                                    echo "Nomor pesanan tidak tersedia";
                                }
                                ?></h4>
                            <h4>Tunai :
                                <input class="form-control" type="number" name="bayar" id="bayar">
                                <button class="btn btn-dark w-100 mt-3" type="submit" name="perhitungan">BAYAR</button>
                        </form>
                        </h4>
                        <h4>Kembali :
                            <?php
                            if (isset($_POST['bayar'])) {
                                $price = $_POST['bayar'];
                                $total = $totalharga;

                                if ($price >= $total) {

                                    $kembali = $price - $total;
                                    $_SESSION['kembali'] = $kembali;
                                    echo "Rp." . number_format($kembali);
                                } else {
                                    echo "Jumlah tunai tidak mencukupi";
                                }
                            } ?>
                        </h4>


                        <?php

                        if (isset($_POST['selesai'])) {
                            $results = $conn->query("SELECT * FROM tbl_order JOIN products ON tbl_order.id_product = products.id_product WHERE no_order = '$nomer'");

                            foreach ($results as $row) {
                                $nomor_order = $_SESSION['no_order'];
                                $price = $row['total_harga'];
                                $kembali = $_SESSION['kembali'];

                                $selesai = $conn->query("UPDATE tbl_order SET bayar = '$price', kembalian = '$kembali' WHERE no_order = '$nomor_order'");

                                if ($selesai > 0) {
                                    $newstock = $row['stock'] - $row['qty']; // Perhitungan stock dilakukan di dalam perulangan foreach
                                    $id = $row['id_product'];

                                    $conn->query("UPDATE products SET stock = '$newstock' WHERE id_product = '$id'");
                                    echo '<script>alert("Pesanan Selesai")
                        location.replace("")</script>';
                                    $_SESSION['nama_cust'] = "Tidak diketahui";
                                    $_SESSION['no_order'] = "Tidak diketahui";
                                    $_SESSION['order_type'] = "Tidak diketahui";
                                }
                            }
                        }


                        ?>
                        <form action="" method="post">
                            <button type="submit" name="selesai" class="btn btn-primary w-100">SELESAI</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>