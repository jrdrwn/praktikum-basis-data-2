<?php

require_once "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if ($_POST["aksi"] == "tambah") {
    $id_pelanggan = $_POST["id_pelanggan"];
    $nama_pelanggan = $_POST["nama_pelanggan"];

    $db->query("INSERT INTO pelanggan (id_pelanggan, nama_pelanggan) VALUES ('$id_pelanggan', '$nama_pelanggan')");
    header("Location: index.php");
  }
}
?>

<form action="" method="post">
  <input type="text" hidden name="aksi" value="tambah">
  <label for="id_pelanggan">id_pelanggan</label>
  <input type="text" name="id_pelanggan" id="id_pelanggan" required>
  <label for="nama_pelanggan">nama_pelanggan</label>
  <input type="text" name="nama_pelanggan" id="nama_pelanggan" required>
  <button type="submit">Simpan</button>
</form>