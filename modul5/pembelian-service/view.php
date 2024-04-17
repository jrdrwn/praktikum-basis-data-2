<table>
  <thead>
    <tr>
      <th>id_pembelian_service</th>
      <th>id_transaksi</th>
      <th>id_pegawai</th>
      <th>id_service</th>
    </tr>
  </thead>
  <tbody>
    <?php
    require_once "db.php";
    $res = $db->query("SELECT * FROM pembelian_service");
    while ($data = $res->fetch_assoc()) {
    ?>
      <tr>
        <td><?= $data["id_pembelian_service"] ?></td>
        <td><?= $data["id_transaksi"] ?></td>
        <td><?= $data["id_pegawai"] ?></td>
        <td><?= $data["id_service"] ?></td>
        <td>
          <a href="?aksi=edit&id_pembelian_service=<?= $data["id_pembelian_service"] ?>">Edit</a>
          <a href="?aksi=delete&id_pembelian_service=<?= $data["id_pembelian_service"] ?>">Hapus</a>
        </td>
      </tr>
    <?php
    }
    ?>
  </tbody>
</table>