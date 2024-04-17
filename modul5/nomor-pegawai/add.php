<?php

require_once "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if ($_POST["aksi"] == "tambah") {
    $id_nomor = $_POST["id_nomor"];
    $id_pegawai = $_POST["id_pegawai"];
    $no_tlp = $_POST["no_tlp"];

    $db->query("INSERT INTO nomor_pegawai (id_nomor, id_pegawai, no_tlp) VALUES ('$id_nomor', '$id_pegawai', '$no_tlp')");
    header("Location: index.php");
  }
}
?>

<form action="" method="post">
  <input type="text" hidden name="aksi" value="tambah">
  <label for="id_nomor">id_nomor</label>
  <input type="text" name="id_nomor" id="id_nomor" required>
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
  <label for="no_tlp">no_tlp</label>
  <input type="text" name="no_tlp" id="no_tlp" required>
  <button type="submit">Simpan</button>
</form>