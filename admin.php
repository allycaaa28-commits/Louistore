<?php

include "koneksi.php";


$query = mysqli_query(
    $koneksi,

    "SELECT
        pesanan.*,
        game.nama_game,
        produk.nominal

     FROM pesanan

     JOIN game
     ON pesanan.game_id = game.id

     JOIN produk
     ON pesanan.produk_id = produk.id

     ORDER BY pesanan.id DESC"
);

?>

<!DOCTYPE html>

<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>
        Admin Louistore
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

            Louistore Admin

        </a>


        <a href="index.php">

            Lihat Website

        </a>

    </div>

</nav>



<section class="admin-section">

    <div class="container">


        <div class="section-title">

            <div>

                <small>
                    DASHBOARD
                </small>

                <h2>
                    Pesanan Masuk
                </h2>

            </div>

        </div>



        <div class="table-container">

            <table>

                <thead>

                    <tr>

                        <th>
                            Invoice
                        </th>

                        <th>
                            Game
                        </th>

                        <th>
                            User ID
                        </th>

                        <th>
                            Nominal
                        </th>

                        <th>
                            Total
                        </th>

                        <th>
                            Status
                        </th>

                        <th>
                            Aksi
                        </th>

                    </tr>

                </thead>


                <tbody>


                <?php

                while (
                    $order =
                    mysqli_fetch_assoc($query)
                ) {

                ?>


                    <tr>

                        <td>

                            <?= $order['invoice'] ?>

                        </td>


                        <td>

                            <?= $order['nama_game'] ?>

                        </td>


                        <td>

                            <?= $order['user_id'] ?>

                            <?php if (
                                $order['server_id']
                            ): ?>

                                <br>

                                <small>

                                    Server:
                                    <?= $order['server_id'] ?>

                                </small>

                            <?php endif; ?>

                        </td>


                        <td>

                            <?= $order['nominal'] ?>

                        </td>


                        <td>

                            Rp

                            <?= number_format(
                                $order['total'],
                                0,
                                ',',
                                '.'
                            ) ?>

                        </td>


                        <td>

                            <span class="status">

                                <?= $order['status'] ?>

                            </span>

                        </td>


                        <td>


                            <form
                                action="proses_checkout.php"
                                method="POST">


                                <input
                                    type="hidden"
                                    name="invoice"
                                    value="<?= $order['invoice'] ?>">


                                <select
                                    name="status">

                                    <option>
                                        Pending
                                    </option>

                                    <option>
                                        Dibayar
                                    </option>

                                    <option>
                                        Diproses
                                    </option>

                                    <option>
                                        Selesai
                                    </option>

                                    <option>
                                        Gagal
                                    </option>

                                </select>


                                <button
                                    type="submit">

                                    Update

                                </button>


                            </form>


                        </td>

                    </tr>


                <?php } ?>


                </tbody>

            </table>

        </div>

    </div>

</section>


</body>

</html>
