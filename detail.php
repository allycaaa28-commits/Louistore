<?php

include "koneksi.php";


$id = $_GET['id'] ?? 0;


$gameQuery = mysqli_query(
    $koneksi,
    "SELECT * FROM game WHERE id = '$id'"
);


$game = mysqli_fetch_assoc($gameQuery);


if (!$game) {

    die("Game tidak ditemukan.");

}


$produkQuery = mysqli_query(
    $koneksi,
    "SELECT * FROM produk
     WHERE game_id = '$id'
     ORDER BY harga ASC"
);

?>

<!DOCTYPE html>

<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>

        <?= $game['nama_game'] ?>

        - Louistore

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

        <a href="index.php">
            ← Kembali
        </a>

    </div>

</nav>



<section class="detail-section">

    <div class="container detail-grid">


        <!-- GAMBAR GAME -->

        <div class="detail-image">

            <img
                src="<?= $game['gambar'] ?>"
                alt="<?= $game['nama_game'] ?>">

        </div>



        <!-- FORM -->

        <div class="detail-content">

            <div class="badge">

                TOP UP

                <?= strtoupper(
                    $game['nama_game']
                ) ?>

            </div>


            <h1>

                <?= $game['nama_game'] ?>

            </h1>


            <p>

                <?= $game['deskripsi'] ?>

            </p>


            <form
                action="checkout.php"
                method="POST">


                <input
                    type="hidden"
                    name="game_id"
                    value="<?= $game['id'] ?>">



                <label>

                    User ID

                    <input
                        type="text"
                        name="user_id"
                        placeholder="Masukkan User ID"
                        required>

                </label>


                <label>

                    Server ID

                    <input
                        type="text"
                        name="server_id"
                        placeholder="Masukkan Server ID">

                </label>


                <label>

                    Nama

                    <input
                        type="text"
                        name="nama"
                        placeholder="Nama kamu"
                        required>

                </label>


                <label>

                    Email

                    <input
                        type="email"
                        name="email"
                        placeholder="email@gmail.com"
                        required>

                </label>



                <h3>
                    Pilih Nominal
                </h3>


                <div class="nominal-grid">


                    <?php

                    while (
                        $produk =
                        mysqli_fetch_assoc(
                            $produkQuery
                        )
                    ) {

                    ?>


                        <label
                            class="nominal">


                            <input
                                type="radio"
                                name="produk_id"
                                value="<?= $produk['id'] ?>"
                                required>


                            <div>

                                <strong>

                                    <?= $produk['nominal'] ?>

                                </strong>

                                <span>

                                    Rp

                                    <?= number_format(
                                        $produk['harga'],
                                        0,
                                        ',',
                                        '.'
                                    ) ?>

                                </span>

                            </div>


                        </label>


                    <?php } ?>


                </div>



                <label>

                    Metode Pembayaran

                    <select
                        name="pembayaran"
                        required>

                        <option value="">
                            Pilih pembayaran
                        </option>

                        <option value="QRIS">
                            QRIS
                        </option>

                        <option value="DANA">
                            DANA
                        </option>

                        <option value="GoPay">
                            GoPay
                        </option>

                        <option value="OVO">
                            OVO
                        </option>

                        <option value="Bank">
                            Transfer Bank
                        </option>

                    </select>

                </label>



                <button
                    type="submit"
                    class="button">

                    Lanjut Checkout →

                </button>


            </form>

        </div>

    </div>

</section>


</body>

</html>
