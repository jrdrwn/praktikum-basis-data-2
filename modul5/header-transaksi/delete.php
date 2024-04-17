<?php

require_once "db.php";

$id_header = $_GET["id_header"];

$res = $db->query("DELETE FROM header_transaksi WHERE id_header = '$id_header'");
header("Location: index.php");
