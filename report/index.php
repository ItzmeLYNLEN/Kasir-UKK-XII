<?php
include '../koneksi.php';

$report = $conn->query("SELECT * FROM tbl_order")



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report</title>
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
                        <a class="nav-link " href="../produk">Produk</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../admin">Admin</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../order">Pesan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php">Laporan</a>
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

    <div class="row justify-content-center mb-5">
        <div class="col-lg-10 pt-5">
            <h3 class="text-center">Riwayat</h3>
            <div class="card">
                <div class="card-body">
                    <div class="col-lg-4">
                        <input type="text" id="searchInput" class="form-control mb-3" placeholder="Cari...">
                    </div>
                    <table class="table table-hover">
                        <thead>
                            <tr class="text-center">
                                <th>#</th>
                                <th>No Order</th>
                                <th>Produk</th>
                                <th>Jumlah</th>
                                <th>Tanggal</th>
                                <th>Nama Pelanggan</th>
                                <th>Tipe Pesan</th>
                                <th>Total Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($report as $user) {
                                $productId = $user['id_product'];
                                $product = $conn->query("SELECT * FROM products WHERE id_product = '$productId'")->fetch_assoc();
                            ?>
                                <tr>
                                    <td class="text-center"><?= $no++ ?></td>
                                    <td class="text-center"><?= $user['no_order'] ?></td>
                                    <td class="text-center"><?= isset($product['name']) ? $product['name'] : 'produk tidak diketahui' ?></td>
                                    <td class="text-center"><?= $user['qty'] ?></td>
                                    <td class="text-center"><?= $user['tanggal'] ?></td>
                                    <td class="text-center"><?= $user['customer_name'] ?></td>
                                    <td class="text-center"><?= $user['order_type'] ?></td>
                                    <td class="text-center"><?= $user['total_harga'] ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
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


    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>