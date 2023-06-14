<?php
include 'conn.php';
session_start();

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $idplayer = $_POST['id'];
    $jumlahdiamond = $_POST['diamond'];
    $nopesanan = generateRandomNumber();

    // Cek koneksi
    if (!$conn) {
        die("Koneksi database gagal: " . mysqli_connect_error());
    }

    // Prepared statement untuk menghindari serangan SQL Injection
    $stmt = mysqli_prepare($conn, "INSERT INTO pengguna (username, idplayer, jumlahdiamond, nopesanan) VALUES (?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "ssss", $username, $idplayer, $jumlahdiamond, $nopesanan);

    // Eksekusi prepared statement
    if (mysqli_stmt_execute($stmt)) {
        $message = "Pesanan Berhasil Disimpan, Silahkan Melakukan Pembayaran.";
        echo "<script>alert('$message'); window.location.href = 'pembayaran.php?nopesanan=$nopesanan';</script>";
    } else {
        $message = "Error: " . mysqli_stmt_error($stmt);
        echo "<script>alert('$message');</script>";
    }
    

    // Tutup statement dan koneksi
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
function generateRandomNumber() {
    $length = 8;
    $characters = '0123456789';
    $randomNumber = '';

    for ($i = 0; $i < $length; $i++) {
        $randomNumber .= $characters[rand(0, strlen($characters) - 1)];
    }

    return $randomNumber;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="container">
        <div class="box-kiri">
            <div class="container-kiri">
                <div class="atas">
                    <img src="img/gambar1.jpg" alt="" height="40px" width="auto">
                    <div class="judul">
                        <h5>GARENA<br>FREE <span>FIRE</span></h5>
                    </div>
                </div>
                <div class="bawah">
                    <p>
                        Hari gini masih bingung mau topup dimana? Duh gak banget deh! Gunain aja fitur top up game dari 
                        Top Fire. Cukup klik linknya, lalu pilih nominal top up dan bayar sesuai nominal. Gampang banget kan
                    </p>
                </div>
            </div>
        </div>
        <div class="box-kanan">
            <div class="sub-box sub-box-satu">
                <div class="sub-box-title-satu">
                    <h4>USERNAME</h4> 
                </div>
                <div class="sub-box-content-satu">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                        <input type="text" name="username" id="Email / No" placeholder="USERNAME">
                </div>
            </div>
            <div class="sub-box sub-box-dua">
                <div class="sub-box-title-dua">
                    <h4>PLAYER ID</h4>
                </div>
                <div class="sub-box-content-dua">
                    <input type="text" name="id" id="id" placeholder="PLAYER ID">
                </div>
            </div>
            <div class="sub-box sub-box-tiga">
                <div class="sub-box-title-tiga">
                    <h4>PILIH JUMLAH</h4>
                </div>
                <div class="sub-box-content-tiga">
                    <div class="button-container">
                        <div class="button-row">
                            <input type="radio" name="diamond" value="5 Diamond" onclick="selectButton(1)">
                            <label for="diamond">5 Diamond</label>
                            <input type="radio" name="diamond" value="17 Diamond" onclick="selectButton(2)">
                            <label for="diamond">17 Diamond</label>
                            <input type="radio" name="diamond" value="75 Diamond" onclick="selectButton(3)">
                            <label for="diamond">75 Diamond</label>
                            <input type="radio" name="diamond" value="140 Diamond" onclick="selectButton(4)">
                            <label for="diamond">140 Diamond</label>
                            <input type="radio" name="diamond" value="355 Diamond" onclick="selectButton(5)">
                            <label for="diamond">355 Diamond</label>
                        </div>
                        <div class="button-row">
                            <input type="radio" name="diamond" value="720 Diamond" onclick="selectButton(6)">
                            <label for="diamond">720 Diamond</label>
                            <input type="radio" name="diamond" value="1450 Diamond" onclick="selectButton(7)">
                            <label for="diamond">1,450 Diamond</label>
                            <input type="radio" name="diamond" value="2180 Diamond" onclick="selectButton(8)">
                            <label for="diamond">2,180 Diamond</label>
                            <input type="radio" name="diamond" value="3640 Diamond" onclick="selectButton(9)">
                            <label for="diamond">3,640 Diamond</label>
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" class="sub-box sub-box-empat">
                <span>Submit</span>
                <i class="fas fa-chevron-circle-right"></i>
            </button>
        </form>
    </div>
</div>
<?php
    if (!empty($message)) {
        echo "<p>" . $message . "</p>";
    }
?>
</body>
</html>
