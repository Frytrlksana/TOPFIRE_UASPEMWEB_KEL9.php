<?php
include 'conn.php';
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $idplayer = $_POST['id'];
    $jumlahdiamond = $_POST['diamond'];

    // Simpan data ke database
    $sql = "INSERT INTO pengguna (username, idplayer, jumlahdiamond) VALUES ('$username', '$idplayer', '$jumlahdiamond')";
    }
    
    $nopesanan = ""; // Inisialisasi variabel nomor pesanan
    $username = ""; // Inisialisasi variabel nomor pesanan
    $idplayer = ""; // Inisialisasi variabel nomor pesanan
    $jumlahdiamond = ""; // Inisialisasi variabel nomor pesanan

// Ambil nomor pesanan dari database
$sql = "SELECT * FROM pengguna ORDER BY idpengguna DESC LIMIT 1";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) { 
    $row = mysqli_fetch_assoc($result);
    $nopesanan = $row['nopesanan'];
    $username = $row['username'];
    $idplayer = $row['idplayer'];
    $jumlahdiamond = $row['jumlahdiamond'];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="pembayaran.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Document</title>
</head>
<body>
    <?php include 'navbar.php';?>
    <div class="container">
        <div class="box-dalam">
            <div class="box-judul">
                <h3>Pilih Metode Pembayaran</h3>
                <h4>Nomor Pesanan Anda: <span><?php echo $nopesanan; ?></span></h4>
            </div>
            <div class="box-satu">
                <div class="voucher-icon">
                    <i class="fas fa-ticket-alt"></i>
                </div>
                    <input type="text" placeholder="Voucher Fisik">
                    <form action="statuspembayaran.php" method="get" >
                        <input type="hidden" name="nopesanan" value="<?php echo $nopesanan; ?>">
                        <input type="hidden" name="username" value="<?php echo $username; ?>">
                        <input type="hidden" name="idplayer" value="<?php echo $idplayer; ?>">
                        <input type="hidden" name="jumlahdiamond" value="<?php echo $jumlahdiamond; ?>">

                        <button class="more-options-btn" ><i class="fas fa-chevron-circle-right"></i></button>
                    </form>
                </div>
            <div class="box-dua">
                <i class="fas fa-store"></i>
                <input type="text" placeholder="Indomart / Alfamart">
                <form action="statuspembayaran.php" method="get">
                    <input type="hidden" name="nopesanan" value="<?php echo $nopesanan; ?>">
                    <input type="hidden" name="username" value="<?php echo $username; ?>">
                    <input type="hidden" name="idplayer" value="<?php echo $idplayer; ?>">
                    <input type="hidden" name="jumlahdiamond" value="<?php echo $jumlahdiamond; ?>">
                    <button class="more-options-btn"><i class="fas fa-chevron-circle-right"></i></button>
                </form>
            </div>
            <div class="box-tiga">
                <i class="fas fa-money-bill"></i>
                <input type="text" placeholder="Aplikasi Dana">
                <form action="statuspembayaran.php" method="get">
                    <input type="hidden" name="nopesanan" value="<?php echo $nopesanan; ?>">
                    <input type="hidden" name="username" value="<?php echo $username; ?>">
                    <input type="hidden" name="idplayer" value="<?php echo $idplayer; ?>">
                    <input type="hidden" name="jumlahdiamond" value="<?php echo $jumlahdiamond; ?>">
                    <button class="more-options-btn"><i class="fas fa-chevron-circle-right"></i></button>
                </form>
            </div>
        </div>
    </div>  
</body>
</html>