<?php

require_once "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $id_jabatan = $_POST["id_jabatan"];
  $nama_jabatan = $_POST["nama_jabatan"];
  $gaji = $_POST["gaji"];

  $db->query("UPDATE jabatan SET nama_jabatan = '$nama_jabatan', gaji = '$gaji' WHERE id_jabatan = '$id_jabatan'");
  header("Location: index.php");
} else {
  $id_jabatan = $_GET["id_jabatan"];

  $res = $db->query("SELECT * FROM jabatan WHERE id_jabatan = '$id_jabatan'");
  $data  = $res->fetch_assoc();
}


?>
<form action="edit.php" method="post">
  <input type="text" hidden name="aksi" value="edit">
  <input type="text" hidden name="id_jabatan" value="<?= $data["id_jabatan"] ?>" required>
  <label for="nama_jabatan">nama_jabatan</label>
  <input type="text" name="nama_jabatan" id="nama_jabatan" value="<?= $data["nama_jabatan"] ?>" required>
  <label for="gaji">gaji</label>
  <input type="text" name="gaji" id="gaji" value="<?= $data["gaji"] ?>" required>
  <button type="submit">Simpan</button>
</form>