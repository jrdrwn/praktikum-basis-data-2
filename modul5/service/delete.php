<?php

require_once "db.php";

$id_service = $_GET["id_service"];

$res = $db->query("DELETE FROM service WHERE id_service = '$id_service'");
header("Location: index.php");
