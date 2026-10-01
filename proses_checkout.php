<?php

include "koneksi.php";


$invoice = $_POST['invoice'];

$status = $_POST['status'];


$statusValid = [
    "Pending",
    "Dibayar",
    "Diproses",
    "Selesai",
    "Gagal"
];


if (!in_array($status, $statusValid)) {

    die("Status tidak valid.");

}


$query = mysqli_prepare(
    $koneksi,

    "UPDATE pesanan
     SET status = ?
     WHERE invoice = ?"
);


mysqli_stmt_bind_param(
    $query,
    "ss",
    $status,
    $invoice
);


mysqli_stmt_execute($query);


header("Location: admin.php");

exit;

?>
