<?php
    include 'conn.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="statuspembayaran.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Document</title>
</head>
<body>
    <?php include 'navbar.php';
    $totalharga = '';
    $nopesanan = isset($_GET['nopesanan']) ? $_GET['nopesanan'] : '';
    $username = isset($_GET['username']) ? $_GET['username'] : '';
    $idplayer = isset($_GET['idplayer']) ? $_GET['idplayer'] : '';
    $jumlahdiamond = isset($_GET['jumlahdiamond']) ? $_GET['jumlahdiamond'] : '';
    $jmlh = str_replace("+", " ", $jumlahdiamond);


    // Ambil jumlah diamond dari database
    $sql = "SELECT * FROM produk where jumlahdiamond = '" . $jmlh . "'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) { 
        $row = mysqli_fetch_assoc($result);
        $totalharga = $row['totalharga'];
        $jumlahdiamond = $row['jumlahdiamond'];
    }

    // Ambil nomor pesanan dari database
    $sql = "SELECT nopesanan FROM pengguna ORDER BY idpengguna DESC LIMIT 1";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) { 
        $row = mysqli_fetch_assoc($result);
        $nopesanan = $row['nopesanan'];
    }


    ?>

    <div class="container">
        <div class="box-dalam">
            <div class="box-judul">
                <h3>STATUS TRANSAKSI BERHASIL</h3>
            </div>

            <div class="box-satu">
                <span>NO PESANAN : <?php echo $nopesanan; ?></span>
            </div>
            <div class="box-dua">   
                <span>USERNAME : <?php echo $username; ?></span>
            </div>
            <div class="box-tiga">
                <span>PLAYER ID : <?php echo $idplayer; ?></span>
            </div>
            <div class="box-empat">
                <span>TOTAL DIAMOND : <?php echo $jumlahdiamond; ?></span>
            </div>
            <div class="box-empat">
                <span>TOTAL HARGA : Rp <?php echo number_format($totalharga); ?></span>
            </div>
        </div>
    </div>  
</body>
</html>
