<?php

$host = "localhost";
$username = "root";
$password = "";
$dbname = "bengkel_mobil";

$db = new mysqli($host, $username, $password, $dbname);

if ($db->connect_error) {
  echo "Connection failed";
  exit;
}
