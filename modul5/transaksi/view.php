<table>
  <thead>
    <tr>
      <th>id_transaksi</th>
      <th>id_pelanggan</th>
      <th>tanggal_pembelian</th>
      <th>total_biaya</th>
    </tr>
  </thead>
  <tbody>
    <?php
    require_once "db.php";
    $res = $db->query("SELECT * FROM transaksi");
    while ($data = $res->fetch_assoc()) {
    ?>
      <tr>
        <td><?= $data["id_transaksi"] ?></td>
        <td><?= $data["id_pelanggan"] ?></td>
        <td><?= $data["tanggal_pembelian"] ?></td>
        <td><?= $data["total_biaya"] ?></td>
        <td>
          <a href="?aksi=edit&id_transaksi=<?= $data["id_transaksi"] ?>">Edit</a>
          <a href="?aksi=delete&id_transaksi=<?= $data["id_transaksi"] ?>">Hapus</a>
        </td>
      </tr>
    <?php
    }
    ?>
  </tbody>
</table>