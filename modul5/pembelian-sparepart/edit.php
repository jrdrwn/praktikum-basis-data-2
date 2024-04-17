<?php

require_once "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $id_pembelian_sparepart = $_POST["id_pembelian_sparepart"];
  $id_transaksi = $_POST["id_transaksi"];
  $id_sparepart = $_POST["id_sparepart"];
  $jumlah_beli = $_POST["jumlah_beli"];

  $db->query("UPDATE pembelian_sparepart SET id_transaksi = '$id_transaksi', id_sparepart = '$id_sparepart', jumlah_beli = '$jumlah_beli' WHERE id_pembelian_sparepart = '$id_pembelian_sparepart'");
  header("Location: index.php");
} else {
  $id_pembelian_sparepart = $_GET["id_pembelian_sparepart"];

  $res = $db->query("SELECT * FROM pembelian_sparepart WHERE id_pembelian_sparepart = '$id_pembelian_sparepart'");
  $data  = $res->fetch_assoc();
}


?>
<form action="edit.php" method="post">
  <input type="text" hidden name="aksi" value="edit">
  <input type="text" hidden name="id_pembelian_sparepart" value="<?= $data["id_pembelian_sparepart"] ?>" required>
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

  <label for="id_sparepart">id_sparepart</label>
  <select name="id_sparepart" id="id_sparepart" required>
    <option value="" disabled selected>Pilih sparepart</option>
    <?php
    $sparepart_res = $db->query("SELECT * FROM sparepart");
    while ($sparepart = $sparepart_res->fetch_assoc()) {
    ?>
      <option value="<?= $sparepart["id_sparepart"] ?>" name="id_sparepart" <?= $sparepart["id_sparepart"] == $data["id_sparepart"] ? "selected" : ""  ?>> <?= $sparepart["id_sparepart"] ?> : <?= $sparepart["nama_sparepart"] ?></option>
    <?php
    }
    ?>
  </select>

  <label for="jumlah_beli">jumlah_beli</label>
  <input type="number" name="jumlah_beli" id="jumlah_beli" value="<?= $data["jumlah_beli"] ?>" required>

  <button type="submit">Simpan</button>
</form>