<?php
include 'conn.php';
session_start();

// Ambil nomor pesanan dari database
$sql = "SELECT * FROM produk";
$result = mysqli_query($conn, $sql);


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Riwayat Pembelian</title>
  <link rel="stylesheet" href="chatalog.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="container">
        <center><div style="color: orange;margin-top: 10px;font-size:27px;">List Harga Diamond</div></center>
            <center>
                <?php 
                    while($data = mysqli_fetch_assoc($result)){
                ?>
                    <div class="box-satu">
                        <div class="box-kiri">
                            <img src="img/logo.png" alt="Gambar" class="gambar">
                            <span><?= $data['jumlahdiamond'] ?></span>
                        </div>
                        <div class="box-kanan">Rp <?= number_format($data['totalharga']); ?></div>
                    </div>
                <?php } ?>
            </center>
    </div>
</body>
</html>
