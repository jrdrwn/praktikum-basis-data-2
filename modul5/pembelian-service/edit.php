<?php

require_once "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $id_pembelian_service = $_POST["id_pembelian_service"];
  $id_transaksi = $_POST["id_transaksi"];
  $id_pegawai = $_POST["id_pegawai"];
  $id_service = $_POST["id_service"];

  $db->query("UPDATE pembelian_service SET id_transaksi = '$id_transaksi', id_pegawai = '$id_pegawai', id_service = '$id_service' WHERE id_pembelian_service = '$id_pembelian_service'");
  header("Location: index.php");
} else {
  $id_pembelian_service = $_GET["id_pembelian_service"];

  $res = $db->query("SELECT * FROM pembelian_service WHERE id_pembelian_service = '$id_pembelian_service'");
  $data  = $res->fetch_assoc();
}


?>
<form action="edit.php" method="post">
  <input type="text" hidden name="aksi" value="edit">
  <input type="text" hidden name="id_pembelian_service" value="<?= $data["id_pembelian_service"] ?>" required>
  <label for="id_transaksi">id_transaksi</label>
  <select name="id_transaksi" id="id_transaksi" required>
    <option value="" disabled selected>Pilih transaksi</option>
    <?php
    $transaksi_res = $db->query("SELECT * FROM transaksi");
    while ($transaksi = $transaksi_res->fetch_assoc()) {
    ?>
      <option value="<?= $transaksi["id_transaksi"] ?>" name="id_transaksi" <?= $transaksi["id_transaksi"] == $data["id_transaksi"] ? "selected" : ""  ?>> <?= $transaksi["id_transaksi"] ?> : <?= $transaksi["id_pelanggan"] ?> : <?= $transaksi["tanggal_pembelian"]  ?></option>
    <?php
    }
    ?>
  </select>

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

  <label for="id_service">id_service</label>
  <select name="id_service" id="id_service" required>
    <option value="" disabled selected>Pilih service</option>
    <?php
    $service_res = $db->query("SELECT * FROM service");
    while ($service = $service_res->fetch_assoc()) {
    ?>
      <option value="<?= $service["id_service"] ?>" name="id_service" <?= $service["id_service"] == $data["id_service"] ? "selected" : ""  ?>> <?= $service["id_service"] ?> : <?= $service["nama_service"] ?></option>
    <?php
    }
    ?>
  </select>

  <button type="submit">Simpan</button>
</form>