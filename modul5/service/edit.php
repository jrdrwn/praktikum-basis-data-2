<?php

require_once "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $id_service = $_POST["id_service"];
  $nama_service = $_POST["nama_service"];
  $lama_pengerjaan = $_POST["lama_pengerjaan"];
  $harga = $_POST["harga"];

  $db->query("UPDATE service SET nama_service = '$nama_service', lama_pengerjaan = '$lama_pengerjaan', harga = '$harga' WHERE id_service = '$id_service'");
  header("Location: index.php");
} else {
  $id_service = $_GET["id_service"];

  $res = $db->query("SELECT * FROM service WHERE id_service = '$id_service'");
  $data  = $res->fetch_assoc();
}


?>
<form action="edit.php" method="post">
  <input type="text" hidden name="aksi" value="edit">
  <input type="text" hidden name="id_service" value="<?= $data["id_service"] ?>" required>
  <label for="nama_service">nama_service</label>
  <input type="text" name="nama_service" id="nama_service" value="<?= $data["nama_service"] ?>" required>
  <label for="lama_pengerjaan">lama_pengerjaan</label>
  <input type="text" name="lama_pengerjaan" id="lama_pengerjaan" value="<?= $data["lama_pengerjaan"] ?>" required>
  <label for="harga">harga</label>
  <input type="text" name="harga" id="harga" value="<?= $data["harga"] ?>" required>
  <button type="submit">Simpan</button>
</form>