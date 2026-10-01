<?php

session_start();

include "koneksi.php";


// ===============================
// INISIALISASI KERANJANG
// ===============================

if (!isset($_SESSION['keranjang'])) {
    $_SESSION['keranjang'] = [];
}


// ===============================
// TAMBAH PRODUK
// ===============================

if (isset($_GET['tambah'])) {

    $produk_id = (int) $_GET['tambah'];

    $query = mysqli_query(
        $koneksi,
        "SELECT
            produk.*,
            game.nama_game
         FROM produk
         JOIN game
         ON produk.game_id = game.id
         WHERE produk.id = '$produk_id'"
    );

    $produk = mysqli_fetch_assoc($query);


    if ($produk) {

        $item = [
            'produk_id'  => $produk['id'],
            'game_id'    => $produk['game_id'],
            'nama_game'  => $produk['nama_game'],
            'nominal'    => $produk['nominal'],
            'harga'      => $produk['harga']
        ];


        $_SESSION['keranjang'][] = $item;
    }


    header("Location: keranjang.php");

    exit;
}


// ===============================
// HAPUS PRODUK
// ===============================

if (isset($_GET['hapus'])) {

    $index = (int) $_GET['hapus'];


    if (isset($_SESSION['keranjang'][$index])) {

        unset(
            $_SESSION['keranjang'][$index]
        );

        $_SESSION['keranjang'] =
            array_values(
                $_SESSION['keranjang']
            );
    }


    header("Location: keranjang.php");

    exit;
}


// ===============================
// KOSONGKAN KERANJANG
// ===============================

if (isset($_GET['kosongkan'])) {

    $_SESSION['keranjang'] = [];

    header("Location: keranjang.php");

    exit;
}


// ===============================
// HITUNG TOTAL
// ===============================

$total = 0;

foreach (
    $_SESSION['keranjang']
    as $item
) {

    $total += $item['harga'];

}

?>

<!DOCTYPE html>

<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>
        Keranjang - Louistore
    </title>


    <link
        rel="stylesheet"
        href="style.css">

</head>


<body>


<!-- NAVBAR -->

<nav>

    <div class="container navbar">


        <a
            href="index.php"
            class="logo">

            <span>
                L
            </span>

            Louistore

        </a>


        <div class="menu">

            <a href="index.php">
                Home
            </a>

            <a href="index.php#game">
                Game
            </a>

            <a href="keranjang.php">
                🛒 Keranjang
            </a>

        </div>


    </div>

</nav>



<!-- KERANJANG -->

<section class="cart-section">


    <div class="container">


        <div class="section-title">


            <div>

                <small>
                    SHOPPING CART
                </small>

                <h2>
                    Keranjang Top Up
                </h2>

            </div>


            <span>

                <?= count(
                    $_SESSION['keranjang']
                ) ?>

                Item

            </span>


        </div>



        <?php if (
            empty($_SESSION['keranjang'])
        ): ?>


            <!-- KERANJANG KOSONG -->

            <div class="empty-cart">


                <div class="empty-icon">
                    🛒
                </div>


                <h2>
                    Keranjang masih kosong
                </h2>


                <p>

                    Kamu belum memilih
                    nominal top up.

                </p>


                <a
                    href="index.php#game"
                    class="button">

                    Pilih Game

                </a>


            </div>


        <?php else: ?>


            <!-- LIST KERANJANG -->

            <div class="cart-layout">


                <div class="cart-list">


                    <?php

                    foreach (
                        $_SESSION['keranjang']
                        as $index => $item
                    ):

                    ?>


                        <div class="cart-item">


                            <div
                                class="cart-icon">

                                🎮

                            </div>


                            <div
                                class="cart-info">


                                <small>

                                    <?= htmlspecialchars(
                                        $item['nama_game']
                                    ) ?>

                                </small>


                                <h3>

                                    <?= htmlspecialchars(
                                        $item['nominal']
                                    ) ?>

                                </h3>


                                <strong>

                                    Rp

                                    <?= number_format(
                                        $item['harga'],
                                        0,
                                        ',',
                                        '.'
                                    ) ?>

                                </strong>


                            </div>


                            <a
                                href="keranjang.php?hapus=<?= $index ?>"
                                class="hapus">

                                Hapus

                            </a>


                        </div>


                    <?php endforeach; ?>


                    <a
                        href="keranjang.php?kosongkan=1"
                        class="clear-cart">

                        Kosongkan Keranjang

                    </a>


                </div>



                <!-- RINGKASAN -->

                <div class="cart-summary">


                    <h3>
                        Ringkasan Pesanan
                    </h3>


                    <div class="summary-row">

                        <span>
                            Jumlah Item
                        </span>

                        <strong>

                            <?= count(
                                $_SESSION['keranjang']
                            ) ?>

                        </strong>

                    </div>


                    <div class="summary-row">

                        <span>
                            Subtotal
                        </span>

                        <strong>

                            Rp

                            <?= number_format(
                                $total,
                                0,
                                ',',
                                '.'
                            ) ?>

                        </strong>

                    </div>


                    <hr>


                    <div class="summary-total">

                        <span>
                            Total
                        </span>

                        <strong>

                            Rp

                            <?= number_format(
                                $total,
                                0,
                                ',',
                                '.'
                            ) ?>

                        </strong>

                    </div>


                    <a
                        href="checkout.php"
                        class="button checkout-button">

                        Lanjut Checkout →

                    </a>


                </div>


            </div>


        <?php endif; ?>


    </div>

</section>



<footer>

    © 2026 Louistore
    — Top Up Game

</footer>


</body>

</html>
