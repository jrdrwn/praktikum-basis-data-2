<?php

require_once "db.php";

$id_pelanggan = $_GET["id_pelanggan"];

$res = $db->query("DELETE FROM pelanggan WHERE id_pelanggan = '$id_pelanggan'");
header("Location: index.php");
