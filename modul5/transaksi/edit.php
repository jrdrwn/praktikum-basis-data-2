<?php

require_once "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $id_transaksi = $_POST["id_transaksi"];
  $id_pelanggan = $_POST["id_pelanggan"];

  $db->query("UPDATE transaksi SET id_pelanggan = '$id_pelanggan' WHERE id_transaksi = '$id_transaksi'");
  header("Location: index.php");
} else {
  $id_transaksi = $_GET["id_transaksi"];

  $res = $db->query("SELECT * FROM transaksi WHERE id_transaksi = '$id_transaksi'");
  $data  = $res->fetch_assoc();
}


?>
<form action="edit.php" method="post">
  <input type="text" hidden name="aksi" value="edit">
  <input type="text" hidden name="id_transaksi" value="<?= $data["id_transaksi"] ?>" required>
  <label for="id_pelanggan">id_pelanggan</label>
  <select name="id_pelanggan" id="id_pelanggan" required>
    <option value="" disabled selected>Pilih pelanggan</option>
    <?php
    $pelanggan_res = $db->query("SELECT * FROM pelanggan");
    while ($pelanggan = $pelanggan_res->fetch_assoc()) {
    ?>
      <option value="<?= $pelanggan["id_pelanggan"] ?>" name="id_pelanggan" <?= $pelanggan["id_pelanggan"] == $data["id_pelanggan"] ? "selected" : ""  ?>> <?= $pelanggan["id_pelanggan"] ?> : <?= $pelanggan["nama_pelanggan"] ?></option>
    <?php
    }
    ?>
  </select>

  <button type="submit">Simpan</button>
</form>