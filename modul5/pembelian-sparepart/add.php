<?php

require_once "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if ($_POST["aksi"] == "tambah") {
    $id_pembelian_sparepart = $_POST["id_pembelian_sparepart"];
    $id_transaksi = $_POST["id_transaksi"];
    $id_sparepart = $_POST["id_sparepart"];
    $jumlah_beli = $_POST["jumlah_beli"];

    $db->query("INSERT INTO pembelian_sparepart (id_pembelian_sparepart, id_transaksi, id_sparepart, jumlah_beli) VALUES ('$id_pembelian_sparepart', '$id_transaksi', '$id_sparepart', '$jumlah_beli')");
    header("Location: index.php");
  }
}
?>

<form action="" method="post">
  <input type="text" hidden name="aksi" value="tambah">
  <label for="id_pembelian_sparepart">id_pembelian_sparepart</label>
  <input type="text" id="id_pembelian_sparepart" name="id_pembelian_sparepart" required>

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

  <label for="id_sparepart">id_transaksi</label>
  <select type="text" name="id_sparepart" id="id_sparepart" required>
    <option value="" disabled selected>Pilih sparepart</option>
    <?php
    $sparepart_res = $db->query("SELECT * FROM sparepart");
    while ($sparepart = $sparepart_res->fetch_assoc()) {
    ?>
      <option value="<?= $sparepart["id_sparepart"] ?>" name="id_sparepart"> <?= $sparepart["id_sparepart"] ?> : <?= $sparepart["nama_sparepart"] ?></option>
    <?php
    }
    ?>
  </select>

  <label for="jumlah_beli">jumlah_beli</label>
  <input type="number" name="jumlah_beli" id="jumlah_beli" required>
  <button type="submit">Simpan</button>
</form>