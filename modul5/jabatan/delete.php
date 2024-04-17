<?php

require_once "db.php";

$id_jabatan = $_GET["id_jabatan"];

$res = $db->query("DELETE FROM jabatan WHERE id_jabatan = '$id_jabatan'");
header("Location: index.php");
