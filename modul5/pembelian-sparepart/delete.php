<?php

require_once "db.php";

$id_pembelian_sparepart = $_GET["id_pembelian_sparepart"];

$res = $db->query("DELETE FROM pembelian_sparepart WHERE id_pembelian_sparepart = '$id_pembelian_sparepart'");
header("Location: index.php");
