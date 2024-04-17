<table>
  <thead>
    <tr>
      <th>id_pegawai</th>
      <th>id_jabatan</th>
      <th>nama_pegawai</th>
      <th>alamat</th>
      <th>username</th>
      <th>password</th>
    </tr>
  </thead>
  <tbody>
    <?php
    require_once "db.php";
    $res = $db->query("SELECT * FROM pegawai");
    while ($data = $res->fetch_assoc()) {
    ?>
      <tr>
        <td><?= $data["id_pegawai"] ?></td>
        <td><?= $data["id_jabatan"] ?></td>
        <td><?= $data["nama_pegawai"] ?></td>
        <td><?= $data["alamat"] ?></td>
        <td><?= $data["username"] ?></td>
        <td><?= $data["password"] ?></td>
        <td>
          <a href="?aksi=edit&id_pegawai=<?= $data["id_pegawai"] ?>">Edit</a>
          <a href="?aksi=delete&id_pegawai=<?= $data["id_pegawai"] ?>">Hapus</a>
        </td>
      </tr>
    <?php
    }
    ?>
  </tbody>
</table>