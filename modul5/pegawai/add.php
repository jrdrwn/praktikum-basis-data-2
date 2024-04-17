<?php

require_once "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if ($_POST["aksi"] == "tambah") {
    $id_pegawai = $_POST["id_pegawai"];
    $id_jabatan = $_POST["id_jabatan"];
    $nama_pegawai = $_POST["nama_pegawai"];
    $alamat = $_POST["alamat"];
    $username = $_POST["username"];
    $password = $_POST["password"];

    $db->query("CALL InsertDataPegawaiNoNo('$id_pegawai', '$id_jabatan', '$nama_pegawai', '$alamat', '$username', '$password')");

    // $db->query("INSERT INTO pegawai (id_pegawai, id_jabatan, nama_pegawai, alamat, username, password) VALUES ()");

    header("Location: index.php");
  }
}
?>

<form action="" method="post">
  <input type="text" hidden name="aksi" value="tambah">
  <label for="id_pegawai">id_pegawai</label>
  <input type="text" id="id_pegawai" name="id_pegawai" required>
  <label for="id_jabatan">id_jabatan</label>
  <select type="text" name="id_jabatan" id="id_jabatan" required>
    <option value="" disabled selected>Pilih jabatan</option>
    <?php
    $jabatan_res = $db->query("SELECT * FROM jabatan");
    while ($jabatan = $jabatan_res->fetch_assoc()) {
    ?>
      <option value="<?= $jabatan["id_jabatan"] ?>" name="id_jabatan"> <?= $jabatan["id_jabatan"] ?> : <?= $jabatan["nama_jabatan"] ?></option>
    <?php
    }
    ?>
  </select>
  <label for="nama_pegawai">nama_pegawai</label>
  <input type="text" id="nama_pegawai" name="nama_pegawai" required>
  <label for="alamat">alamat</label>
  <input type="text" id="alamat" name="alamat" required>
  <label for="username">username</label>
  <input type="text" id="username" name="username" required>
  <label for="password">password</label>
  <input type="text" id="password" name="password" required>
  <button type="submit">Simpan</button>
</form>