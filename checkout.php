<?php

include "koneksi.php";


if ($_SERVER['REQUEST_METHOD'] !== 'POST') {

    header("Location: index.php");

    exit;

}


$game_id = $_POST['game_id'];

$produk_id = $_POST['produk_id'];

$user_id = $_POST['user_id'];

$server_id = $_POST['server_id'] ?? '';

$nama = $_POST['nama'];

$email = $_POST['email'];

$pembayaran = $_POST['pembayaran'];



$query = mysqli_query(
    $koneksi,

    "SELECT
        produk.*,
        game.nama_game

     FROM produk

     JOIN game
     ON produk.game_id = game.id

     WHERE produk.id = '$produk_id'
     AND produk.game_id = '$game_id'"
);


$data = mysqli_fetch_assoc($query);


if (!$data) {

    die("Produk tidak ditemukan.");

}


$invoice =
    "LS" .
    date("YmdHis") .
    rand(100,999);


$total = $data['harga'];



$sql = "

INSERT INTO pesanan

(
    invoice,
    game_id,
    produk_id,
    user_id,
    server_id,
    nama,
    email,
    pembayaran,
    total
)

VALUES

(
    '$invoice',
    '$game_id',
    '$produk_id',
    '$user_id',
    '$server_id',
    '$nama',
    '$email',
    '$pembayaran',
    '$total'
)

";


mysqli_query(
    $koneksi,
    $sql
);

?>

<!DOCTYPE html>

<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>
        Checkout - Louistore
    </title>

    <link rel="stylesheet"
          href="style.css">

</head>

<body>


<nav>

    <div class="container navbar">

        <a href="index.php"
           class="logo">

            <span>L</span>

            Louistore

        </a>

    </div>

</nav>



<section class="checkout-section">

    <div class="container">


        <div class="checkout-box">


            <div class="success-icon">

                ✓

            </div>


            <div class="badge">

                PESANAN BERHASIL

            </div>


            <h1>

                Menunggu Pembayaran

            </h1>


            <p>

                Silakan lakukan pembayaran
                sesuai nominal yang tertera.

            </p>



            <div class="invoice">

                <span>
                    Invoice
                </span>

                <strong>

                    <?= $invoice ?>

                </strong>

            </div>



            <div class="order-detail">

                <p>

                    Game

                    <strong>

                        <?= $data['nama_game'] ?>

                    </strong>

                </p>


                <p>

                    Nominal

                    <strong>

                        <?= $data['nominal'] ?>

                    </strong>

                </p>


                <p>

                    User ID

                    <strong>

                        <?= $user_id ?>

                    </strong>

                </p>


                <?php if ($server_id): ?>

                    <p>

                        Server ID

                        <strong>

                            <?= $server_id ?>

                        </strong>

                    </p>

                <?php endif; ?>


                <p>

                    Pembayaran

                    <strong>

                        <?= $pembayaran ?>

                    </strong>

                </p>


                <p>

                    Total

                    <strong>

                        Rp

                        <?= number_format(
                            $total,
                            0,
                            ',',
                            '.'
                        ) ?>

                    </strong>

                </p>

            </div>



            <div class="payment-info">

                <strong>
                    Instruksi Pembayaran
                </strong>

                <p>

                    Ini adalah halaman simulasi
                    pembayaran. Untuk website
                    produksi, bagian ini bisa
                    dihubungkan ke payment gateway
                    seperti QRIS.

                </p>

            </div>


            <a
                href="index.php"
                class="button">

                Kembali ke Home

            </a>


        </div>

    </div>

</section>


</body>

</html>
