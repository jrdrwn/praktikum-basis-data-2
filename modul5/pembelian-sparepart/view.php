<table>
  <thead>
    <tr>
      <th>id_pembelian_sparepart</th>
      <th>id_transaksi</th>
      <th>id_sparepart</th>
      <th>jumlah_beli</th>
    </tr>
  </thead>
  <tbody>
    <?php
    require_once "db.php";
    $res = $db->query("SELECT * FROM pembelian_sparepart");
    while ($data = $res->fetch_assoc()) {
    ?>
      <tr>
        <td><?= $data["id_pembelian_sparepart"] ?></td>
        <td><?= $data["id_transaksi"] ?></td>
        <td><?= $data["id_sparepart"] ?></td>
        <td><?= $data["jumlah_beli"] ?></td>
        <td>
          <a href="?aksi=edit&id_pembelian_sparepart=<?= $data["id_pembelian_sparepart"] ?>">Edit</a>
          <a href="?aksi=delete&id_pembelian_sparepart=<?= $data["id_pembelian_sparepart"] ?>">Hapus</a>
        </td>
      </tr>
    <?php
    }
    ?>
  </tbody>
</table>