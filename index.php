<?php

include "koneksi.php";

$query = mysqli_query(
    $koneksi,
    "SELECT * FROM game ORDER BY id DESC"
);

?>

<!DOCTYPE html>

<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Louistore - Top Up Game</title>

    <link rel="stylesheet"
          href="style.css">

</head>

<body>


<!-- NAVBAR -->

<nav>

    <div class="container navbar">

        <a href="index.php"
           class="logo">

            <span>L</span>

            Louistore

        </a>


        <div class="menu">

            <a href="index.php">
                Home
            </a>

            <a href="#game">
                Game
            </a>

            <a href="admin.php">
                Admin
            </a>

        </div>

    </div>

</nav>



<!-- HERO -->

<section class="hero">

    <div class="container hero-content">

        <div>

            <div class="badge">
                ⚡ TOP UP GAME CEPAT
            </div>

            <h1>

                Top Up Game
                <br>

                <span>
                    Cepat & Aman
                </span>

            </h1>

            <p>

                Isi ulang game favoritmu
                dengan mudah, cepat,
                dan harga terjangkau.

            </p>


            <a href="#game"
               class="button">

                Mulai Top Up

            </a>

        </div>


        <div class="hero-image">

            🎮

        </div>

    </div>

</section>



<!-- GAME -->

<section class="game-section"
         id="game">

    <div class="container">

        <div class="section-title">

            <div>

                <small>
                    GAME POPULER
                </small>

                <h2>
                    Pilih Game
                </h2>

            </div>

            <p>
                Top up game favoritmu
            </p>

        </div>


        <div class="game-grid">


            <?php while ($game = mysqli_fetch_assoc($query)) { ?>


                <a
                    href="detail.php?id=<?= $game['id'] ?>"
                    class="game-card">


                    <img
                        src="<?= $game['gambar'] ?>"
                        alt="<?= $game['nama_game'] ?>">


                    <div class="game-info">

                        <small>
                            TOP UP
                        </small>

                        <h3>

                            <?= $game['nama_game'] ?>

                        </h3>

                        <p>

                            <?= $game['deskripsi'] ?>

                        </p>


                        <strong>

                            Top Up Sekarang →

                        </strong>

                    </div>

                </a>


            <?php } ?>


        </div>

    </div>

</section>



<footer>

    © 2026 Louistore
    — Top Up Game Indonesia

</footer>


</body>

</html>
