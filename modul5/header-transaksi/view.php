<table>
  <thead>
    <tr>
      <th>id_header</th>
      <th>id_pegawai</th>
      <th>id_transaksi</th>
    </tr>
  </thead>
  <tbody>
    <?php
    require_once "db.php";
    $res = $db->query("SELECT * FROM header_transaksi");
    while ($data = $res->fetch_assoc()) {
    ?>
      <tr>
        <td><?= $data["id_header"] ?></td>
        <td><?= $data["id_pegawai"] ?></td>
        <td><?= $data["id_transaksi"] ?></td>
        <td>
          <a href="?aksi=edit&id_header=<?= $data["id_header"] ?>">Edit</a>
          <a href="?aksi=delete&id_header=<?= $data["id_header"] ?>">Hapus</a>
        </td>
      </tr>
    <?php
    }
    ?>
  </tbody>
</table>