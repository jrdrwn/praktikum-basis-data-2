<table>
  <thead>
    <tr>
      <th>id_sparepart</th>
      <th>nama_sparepart</th>
      <th>stok</th>
      <th>jenis_sparepart</th>
      <th>harga</th>
    </tr>
  </thead>
  <tbody>
    <?php
    require_once "db.php";
    $res = $db->query("SELECT * FROM sparepart");
    while ($data = $res->fetch_assoc()) {
    ?>
      <tr>
        <td><?= $data["id_sparepart"] ?></td>
        <td><?= $data["nama_sparepart"] ?></td>
        <td><?= $data["stok"] ?></td>
        <td><?= $data["jenis_sparepart"] ?></td>
        <td><?= $data["harga"] ?></td>
        <td>
          <a href="?aksi=edit&id_sparepart=<?= $data["id_sparepart"] ?>">Edit</a>
          <a href="?aksi=delete&id_sparepart=<?= $data["id_sparepart"] ?>">Hapus</a>
        </td>
      </tr>
    <?php
    }
    ?>
  </tbody>
</table>