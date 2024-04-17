<?php

require_once "db.php";

$id_transaksi = $_GET["id_transaksi"];

$res = $db->query("DELETE FROM transaksi WHERE id_transaksi = '$id_transaksi'");
header("Location: index.php");
