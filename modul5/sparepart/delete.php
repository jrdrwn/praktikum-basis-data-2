<?php

require_once "db.php";

$id_sparepart = $_GET["id_sparepart"];

$res = $db->query("DELETE FROM sparepart WHERE id_sparepart = '$id_sparepart'");
header("Location: index.php");
