<table>
  <thead>
    <tr>
      <th>id_jabatan</th>
      <th>nama_jabatan</th>
      <th>gaji</th>
    </tr>
  </thead>
  <tbody>
    <?php
    require_once "db.php";
    $res = $db->query("SELECT * FROM jabatan");
    while ($data = $res->fetch_assoc()) {
    ?>
      <tr>
        <td><?= $data["id_jabatan"] ?></td>
        <td><?= $data["nama_jabatan"] ?></td>
        <td><?= $data["gaji"] ?></td>
        <td>
          <a href="?aksi=edit&id_jabatan=<?= $data["id_jabatan"] ?>">Edit</a>
          <a href="?aksi=delete&id_jabatan=<?= $data["id_jabatan"] ?>">Hapus</a>
        </td>
      </tr>
    <?php
    }
    ?>
  </tbody>
</table>