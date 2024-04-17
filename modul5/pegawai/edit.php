<?php

require_once "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $id_pegawai = $_POST["id_pegawai"];
  $id_jabatan = $_POST["id_jabatan"];
  $nama_pegawai = $_POST["nama_pegawai"];
  $alamat = $_POST["alamat"];
  $username = $_POST["username"];
  $password = $_POST["password"];

  $db->query("CALL UpdatePegawaiNoNo('$id_pegawai', '$id_jabatan', '$nama_pegawai', '$alamat', '$username', '$password')");
  header("Location: index.php");
} else {
  $id_pegawai = $_GET["id_pegawai"];

  $res = $db->query("SELECT * FROM pegawai WHERE id_pegawai = '$id_pegawai'");
  $data  = $res->fetch_assoc();
}


?>
<form action="edit.php" method="post">
  <input type="text" hidden name="aksi" value="edit">
  <input type="text" hidden name="id_pegawai" value="<?= $data["id_pegawai"] ?>" required>
  <label for="id_jabatan">id_jabatan</label>
  <select name="id_jabatan" id="id_jabatan" required>
    <option value="" disabled selected>Pilih jabatan</option>
    <?php
    $jabatan_res = $db->query("SELECT * FROM jabatan");
    while ($jabatan = $jabatan_res->fetch_assoc()) {
    ?>
      <option value="<?= $jabatan["id_jabatan"] ?>" name="id_jabatan" <?= $jabatan["id_jabatan"] == $data["id_jabatan"] ? "selected" : ""  ?>> <?= $jabatan["id_jabatan"] ?> : <?= $jabatan["nama_jabatan"] ?></option>
    <?php
    }
    ?>
  </select>
  <label for="nama_pegawai">nama_pegawai</label>
  <input type="text" id="nama_pegawai" name="nama_pegawai" value="<?= $data["nama_pegawai"] ?>" required>
  <label for="alamat">alamat</label>
  <input type="text" id="alamat" name="alamat" value="<?= $data["alamat"] ?>" required>
  <label for="username">username</label>
  <input type="text" id="username" name="username" value="<?= $data["username"] ?>" required>
  <label for="password">password</label>
  <input type="text" id="password" name="password" value="<?= $data["password"] ?>" required>

  <button type="submit">Simpan</button>
</form>