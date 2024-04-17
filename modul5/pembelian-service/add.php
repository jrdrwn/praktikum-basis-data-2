<?php

require_once "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if ($_POST["aksi"] == "tambah") {
    $id_pembelian_service = $_POST["id_pembelian_service"];
    $id_transaksi = $_POST["id_transaksi"];
    $id_pegawai = $_POST["id_pegawai"];
    $id_service = $_POST["id_service"];

    $db->query("INSERT INTO pembelian_service (id_pembelian_service, id_transaksi, id_pegawai, id_service) VALUES ('$id_pembelian_service', '$id_transaksi', '$id_pegawai', '$id_service')");
    header("Location: index.php");
  }
}
?>

<form action="" method="post">
  <input type="text" hidden name="aksi" value="tambah">
  <label for="id_pembelian_service">id_pembelian_service</label>
  <input type="text" id="id_pembelian_service" name="id_pembelian_service" required>

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

  <label for="id_pegawai">id_transaksi</label>
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

  <label for="id_service">id_transaksi</label>
  <select type="text" name="id_service" id="id_service" required>
    <option value="" disabled selected>Pilih service</option>
    <?php
    $service_res = $db->query("SELECT * FROM service");
    while ($service = $service_res->fetch_assoc()) {
    ?>
      <option value="<?= $service["id_service"] ?>" name="id_service"> <?= $service["id_service"] ?> : <?= $service["nama_service"] ?></option>
    <?php
    }
    ?>
  </select>
  <button type="submit">Simpan</button>
</form>