<?php

require_once "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if ($_POST["aksi"] == "tambah") {
    $id_sparepart = $_POST["id_sparepart"];
    $nama_sparepart = $_POST["nama_sparepart"];
    $stok = $_POST["stok"];
    $jenis_sparepart = $_POST["jenis_sparepart"];
    $harga = $_POST["harga"];

    $db->query("INSERT INTO sparepart (id_sparepart, nama_sparepart, stok, jenis_sparepart, harga) VALUES ('$id_sparepart', '$nama_sparepart', '$stok', '$jenis_sparepart', '$harga')");
    header("Location: index.php");
  }
}
?>

<form action="" method="post">
  <input type="text" hidden name="aksi" value="tambah">
  <label for="id_sparepart">id_sparepart</label>
  <input type="text" name="id_sparepart" id="id_sparepart" required>
  <label for="nama_sparepart">nama_sparepart</label>
  <input type="text" name="nama_sparepart" id="nama_sparepart" required>
  <label for="stok">stok</label>
  <input type="text" name="stok" id="stok" required>
  <label for="jenis_sparepart">jenis_sparepart</label>
  <input type="text" name="jenis_sparepart" id="jenis_sparepart" required>
  <label for="harga">harga</label>
  <input type="number" name="harga" id="harga" required>
  <button type="submit">Simpan</button>
</form>