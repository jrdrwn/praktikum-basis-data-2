<?php

require_once "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $id_nomor = $_POST["id_nomor"];
  $id_pegawai = $_POST["id_pegawai"];
  $no_tlp = $_POST["no_tlp"];

  $db->query("UPDATE nomor_pegawai SET id_pegawai = '$id_pegawai', no_tlp = '$no_tlp' WHERE id_nomor = '$id_nomor'");
  header("Location: index.php");
} else {
  $id_nomor = $_GET["id_nomor"];

  $res = $db->query("SELECT * FROM nomor_pegawai WHERE id_nomor = '$id_nomor'");
  $data  = $res->fetch_assoc();
}


?>
<form action="edit.php" method="post">
  <input type="text" hidden name="aksi" value="edit">
  <input type="text" hidden name="id_nomor" value="<?= $data["id_nomor"] ?>" required>

  <label for="id_pegawai">id_pegawai</label>
  <select type="text" name="id_pegawai" id="id_pegawai" required>
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
  <label for="no_tlp">no_tlp</label>
  <input type="text" name="no_tlp" id="no_tlp" value="<?= $data["no_tlp"] ?>" required>

  <button type="submit">Simpan</button>
</form>