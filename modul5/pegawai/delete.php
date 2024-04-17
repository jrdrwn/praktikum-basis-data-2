<?php

require_once "db.php";

$id_pegawai = $_GET["id_pegawai"];

$res = $db->query("CALL DeletePegawai('$id_pegawai')");
// $res = $db->query("DELETE FROM pegawai WHERE id_pegawai = '$id_pegawai'");
header("Location: index.php");
