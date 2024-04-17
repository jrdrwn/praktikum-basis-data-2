<table>
  <thead>
    <tr>
      <th>id_nomor</th>
      <th>id_pegawai</th>
      <th>no_tlp</th>
    </tr>
  </thead>
  <tbody>
    <?php
    require_once "db.php";
    $res = $db->query("SELECT * FROM nomor_pegawai");
    while ($data = $res->fetch_assoc()) {
    ?>
      <tr>
        <td><?= $data["id_nomor"] ?></td>
        <td><?= $data["id_pegawai"] ?></td>
        <td><?= $data["no_tlp"] ?></td>
        <td>
          <a href="?aksi=edit&id_nomor=<?= $data["id_nomor"] ?>">Edit</a>
          <a href="?aksi=delete&id_nomor=<?= $data["id_nomor"] ?>">Hapus</a>
        </td>
      </tr>
    <?php
    }
    ?>
  </tbody>
</table>