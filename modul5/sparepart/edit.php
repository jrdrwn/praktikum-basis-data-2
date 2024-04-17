<?php

require_once "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $id_sparepart = $_POST["id_sparepart"];
  $nama_sparepart = $_POST["nama_sparepart"];
  $stok = $_POST["stok"];
  $jenis_sparepart = $_POST["jenis_sparepart"];
  $harga = $_POST["harga"];

  $db->query("UPDATE sparepart SET nama_sparepart= '$nama_sparepart', stok= '$stok', jenis_sparepart= '$jenis_sparepart', harga= '$harga'  WHERE id_sparepart = '$id_sparepart'");
  header("Location: index.php");
} else {
  $id_sparepart = $_GET["id_sparepart"];

  $res = $db->query("SELECT * FROM sparepart WHERE id_sparepart = '$id_sparepart'");
  $data  = $res->fetch_assoc();
}


?>
<form action="edit.php" method="post">
  <input type="text" hidden name="aksi" value="edit">
  <input type="text" hidden name="id_sparepart" value="<?= $data["id_sparepart"] ?>" required>
  <label for="nama_sparepart">nama_sparepart</label>
  <input type="text" name="nama_sparepart" id="nama_sparepart" value="<?= $data["nama_sparepart"] ?>" required>
  <label for="stok">stok</label>
  <input type="text" name="stok" id="stok" value="<?= $data["stok"] ?>" required>
  <label for="jenis_sparepart">jenis_sparepart</label>
  <input type="text" name="jenis_sparepart" id="jenis_sparepart" value="<?= $data["jenis_sparepart"] ?>" required>
  <label for="harga">harga</label>
  <input type="text" name="harga" id="harga" value="<?= $data["harga"] ?>" required>
  <button type="submit">Simpan</button>
</form>