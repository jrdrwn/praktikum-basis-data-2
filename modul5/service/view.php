<table>
  <thead>
    <tr>
      <th>id_service</th>
      <th>nama_service</th>
      <th>lama_pengerjaan (jam)</th>
      <th>harga</th>
    </tr>
  </thead>
  <tbody>
    <?php
    require_once "db.php";
    $res = $db->query("SELECT * FROM service");
    while ($data = $res->fetch_assoc()) {
    ?>
      <tr>
        <td><?= $data["id_service"] ?></td>
        <td><?= $data["nama_service"] ?></td>
        <td><?= $data["lama_pengerjaan"] ?></td>
        <td><?= $data["harga"] ?></td>
        <td>
          <a href="?aksi=edit&id_service=<?= $data["id_service"] ?>">Edit</a>
          <a href="?aksi=delete&id_service=<?= $data["id_service"] ?>">Hapus</a>
        </td>
      </tr>
    <?php
    }
    ?>
  </tbody>
</table>