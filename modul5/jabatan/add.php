<?php

require_once "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if ($_POST["aksi"] == "tambah") {
    $id_jabatan = $_POST["id_jabatan"];
    $nama_jabatan = $_POST["nama_jabatan"];
    $gaji = $_POST["gaji"];

    $db->query("INSERT INTO jabatan (id_jabatan, nama_jabatan, gaji) VALUES ('$id_jabatan', '$nama_jabatan', '$gaji')");
    header("Location: index.php");
  }
}
?>

<form action="" method="post">
  <input type="text" hidden name="aksi" value="tambah">
  <label for="id_jabatan">id_jabatan</label>
  <input type="text" name="id_jabatan" id="id_jabatan" required>
  <label for="nama_jabatan">nama_jabatan</label>
  <input type="text" name="nama_jabatan" id="nama_jabatan" required>
  <label for="gaji">gaji</label>
  <input type="number" name="gaji" id="gaji" required>
  <button type="submit">Simpan</button>
</form>