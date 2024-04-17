<table>
  <thead>
    <tr>
      <th>id_pelanggan</th>
      <th>nama_pelanggan</th>
    </tr>
  </thead>
  <tbody>
    <?php
    require_once "db.php";
    $res = $db->query("SELECT * FROM pelanggan");
    while ($data = $res->fetch_assoc()) {
    ?>
      <tr>
        <td><?= $data["id_pelanggan"] ?></td>
        <td><?= $data["nama_pelanggan"] ?></td>
        <td>
          <a href="?aksi=edit&id_pelanggan=<?= $data["id_pelanggan"] ?>">Edit</a>
          <a href="?aksi=delete&id_pelanggan=<?= $data["id_pelanggan"] ?>">Hapus</a>
        </td>
      </tr>
    <?php
    }
    ?>
  </tbody>
</table>