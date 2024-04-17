<?php

require_once "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $id_header = $_POST["id_header"];
  $id_pegawai = $_POST["id_pegawai"];
  $id_transaksi = $_POST["id_transaksi"];

  $db->query("UPDATE header_transaksi SET id_pegawai = '$id_pegawai', id_transaksi = '$id_transaksi' WHERE id_header = '$id_header'");
  header("Location: index.php");
} else {
  $id_header = $_GET["id_header"];

  $res = $db->query("SELECT * FROM header_transaksi WHERE id_header = '$id_header'");
  $data  = $res->fetch_assoc();
}


?>
<form action="edit.php" method="post">
  <input type="text" hidden name="aksi" value="edit">
  <input type="text" hidden name="id_header" value="<?= $data["id_header"] ?>" required>
  <label for="id_pegawai">id_pegawai</label>
  <select name="id_pegawai" id="id_pegawai" required>
    <option value="" disabled selected>Pilih pegawai</option>
    <?php
    $pegawai_res = $db->query("SELECT * FROM pegawai");
    while ($pegawai = $pegawai_res->fetch_assoc()) {
    ?>
      <option value="<?= $pegawai["id_pegawai"] ?>" name="id_pegawai" <?= $pegawai["id_pegawai"] == $data["id_pegawai"] ? "selected" : ""  ?>> <?= $pegawai["id_pegawai"] ?> : <?= $pegawai["nama_pegawai"] ?></option>
    <?php
    }
    ?>
  </select>

  <label for="id_transaksi">id_transaksi</label>
  <select name="id_transaksi" id="id_transaksi" required>
    <option value="" disabled selected>Pilih transaksi</option>
    <?php
    $transaksi_res = $db->query("SELECT * FROM transaksi");
    while ($transaksi = $transaksi_res->fetch_assoc()) {
    ?>
      <option value="<?= $transaksi["id_transaksi"] ?>" name="id_transaksi" <?= $transaksi["id_transaksi"] == $data["id_transaksi"] ? "selected" : ""  ?>> <?= $transaksi["id_transaksi"] ?> : <?= $transaksi["id_pelanggan"] ?> : <?= $transaksi["tanggal_pembelian"] ?></option>
    <?php
    }
    ?>
  </select>
  <button type="submit">Simpan</button>
</form>