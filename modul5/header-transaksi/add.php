<?php

require_once "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if ($_POST["aksi"] == "tambah") {
    $id_header = $_POST["id_header"];
    $id_pegawai = $_POST["id_pegawai"];
    $id_transaksi = $_POST["id_transaksi"];

    $db->query("INSERT INTO header_transaksi (id_header, id_pegawai, id_transaksi) VALUES ('$id_header', '$id_pegawai', '$id_transaksi')");
    header("Location: index.php");
  }
}
?>

<form action="" method="post">
  <input type="text" hidden name="aksi" value="tambah">
  <label for="id_header">id_header</label>
  <input type="text" id="id_header" name="id_header" required>
  <label for="id_pegawai">id_pegawai</label>
  <select type="text" name="id_pegawai" id="id_pegawai" required>
    <option value="" disabled selected>Pilih pegawai</option>
    <?php
    $pegawai_res = $db->query("SELECT * FROM pegawai");
    while ($pegawai = $pegawai_res->fetch_assoc()) {
    ?>
      <option value="<?= $pegawai["id_pegawai"] ?>" name="id_pegawai"> <?= $pegawai["id_pegawai"] ?> : <?= $pegawai["nama_pegawai"] ?></option>
    <?php
    }
    ?>
  </select>
  <label for="id_transaksi">id_transaksi</label>
  <select type="text" name="id_transaksi" id="id_transaksi" required>
    <option value="" disabled selected>Pilih transaksi</option>
    <?php
    $transaksi_res = $db->query("SELECT * FROM transaksi");
    while ($transaksi = $transaksi_res->fetch_assoc()) {
    ?>
      <option value="<?= $transaksi["id_transaksi"] ?>" name="id_transaksi"> <?= $transaksi["id_transaksi"] ?> : <?= $transaksi["id_pelanggan"] ?> : <?= $transaksi["tanggal_pembelian"] ?></option>
    <?php
    }
    ?>
  </select>
  <button type="submit">Simpan</button>
</form>