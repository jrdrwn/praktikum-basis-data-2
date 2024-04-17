<?php

require_once "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if ($_POST["aksi"] == "tambah") {
    $id_transaksi = $_POST["id_transaksi"];
    $id_pelanggan = $_POST["id_pelanggan"];
    $tanggal_pembelian = date("Y-m-d");
    $total_biaya = 0;

    $db->query("INSERT INTO transaksi (id_transaksi, id_pelanggan, tanggal_pembelian, total_biaya) VALUES ('$id_transaksi', '$id_pelanggan', '$tanggal_pembelian', '$total_biaya')");
    header("Location: index.php");
  }
}
?>

<form action="" method="post">
  <input type="text" hidden name="aksi" value="tambah">
  <label for="id_transaksi">id_transaksi</label>
  <input type="text" id="id_transaksi" name="id_transaksi" required>
  <label for="id_pelanggan">id_pelanggan</label>
  <select type="text" name="id_pelanggan" id="id_pelanggan" required>
    <option value="" disabled selected>Pilih pelanggan</option>
    <?php
    $pelanggan_res = $db->query("SELECT * FROM pelanggan");
    while ($pelanggan = $pelanggan_res->fetch_assoc()) {
    ?>
      <option value="<?= $pelanggan["id_pelanggan"] ?>" name="id_pelanggan"> <?= $pelanggan["id_pelanggan"] ?> : <?= $pelanggan["nama_pelanggan"] ?></option>
    <?php
    }
    ?>
  </select>
  <button type="submit">Simpan</button>
</form>