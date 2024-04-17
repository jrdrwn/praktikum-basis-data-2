<?php

require_once "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if ($_POST["aksi"] == "tambah") {
    $id_service = $_POST["id_service"];
    $nama_service = $_POST["nama_service"];
    $lama_pengerjaan = $_POST["lama_pengerjaan"];
    $harga = $_POST["harga"];

    $db->query("INSERT INTO service (id_service, nama_service, lama_pengerjaan, harga) VALUES ('$id_service', '$nama_service', '$lama_pengerjaan', '$harga')");
    header("Location: index.php");
  }
}
?>

<form action="" method="post">
  <input type="text" hidden name="aksi" value="tambah">
  <label for="id_service">id_service</label>
  <input type="text" name="id_service" id="id_service" required>
  <label for="nama_service">nama_service</label>
  <input type="text" name="nama_service" id="nama_service" required>
  <label for="lama_pengerjaan">lama_pengerjaan</label>
  <input type="number" name="lama_pengerjaan" id="lama_pengerjaan" required>
  <label for="harga">harga</label>
  <input type="number" name="harga" id="harga" required>
  <button type="submit">Simpan</button>
</form>