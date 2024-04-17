<?php

require_once "db.php";

$id_nomor = $_GET["id_nomor"];

$res = $db->query("DELETE FROM nomor_pegawai WHERE id_nomor = '$id_nomor'");
header("Location: index.php");
