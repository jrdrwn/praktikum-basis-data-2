<?php

require_once "db.php";

$id_pembelian_service = $_GET["id_pembelian_service"];

$res = $db->query("DELETE FROM pembelian_service WHERE id_pembelian_service = '$id_pembelian_service'");
header("Location: index.php");
