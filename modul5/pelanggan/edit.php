<?php

require_once "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $id_pelanggan = $_POST["id_pelanggan"];
  $nama_pelanggan = $_POST["nama_pelanggan"];

  $db->query("UPDATE pelanggan SET nama_pelanggan = '$nama_pelanggan' WHERE id_pelanggan = '$id_pelanggan'");
  header("Location: index.php");
} else {
  $id_pelanggan = $_GET["id_pelanggan"];

  $res = $db->query("SELECT * FROM pelanggan WHERE id_pelanggan = '$id_pelanggan'");
  $data  = $res->fetch_assoc();
}


?>
<form action="edit.php" method="post">
  <input type="text" hidden name="aksi" value="edit">
  <input type="text" hidden name="id_pelanggan" value="<?= $data["id_pelanggan"] ?>" required>
  <label for="nama_pelanggan">nama_pelanggan</label>
  <input type="text" name="nama_pelanggan" id="nama_pelanggan" value="<?= $data["nama_pelanggan"] ?>" required>
  <button type="submit">Simpan</button>
</form>