<?php
include 'functions.php';
$db = mongo_connect();
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
$records_per_page = 5;

$skip = ($page - 1) * $records_per_page;
$karyawan = $db->karyawan->find([], ['limit' => $records_per_page, 'skip' => $skip]);

$num_karyawan = $db->karyawan->countDocuments();
?>

<?=template_header('Data Karyawan')?>
<h1 style="text-align: center">Cari Karyawan</h1>
<form class="form-input" action="cari.php" method="post">
  <label for="keyword">Keyword</label>
  <input type="text" id="keyword" name="keyword" placeholder="Masukkan keyword pencarian" autofocus autocomplete="off">
  <label for="fungsi">Fungsi</label>
  <select id="fungsi" name="fungsi">
    <option value="nama">Nama karyawan</option>
    <option value="posisi">Posisi</option>
  </select>
  <input type="submit" value="Cari">
</form>
<div class="content read">
  <h2>Data karyawan</h2>
  <a href="create.php" class="create-contact">Buat Data</a>
  <table>
    <thead>
      <tr>
        <td>Nama</td>
        <td>Gaji</td>
        <td>Jabatan</td>
        <td>Action</td>
     </tr>
    </thead>
    <tbody>
      <?php foreach ($karyawan as $row): ?>
        <tr>
          <td><?=$row['nama']?></td>
          <td><?=$row['gaji']?></td>
          <td><?=$row['posisi']?></td>
          <td class="actions">
                    <a href="update.php?id=<?= $row['_id'] ?>" class="edit"><i class="fas fa-pen fa-xs"></i></a>
                    <a href="delete.php?id=<?= $row['_id'] ?>" class="trash"><i class="fas fa-trash fa-xs"></i></a>
                </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <div class="pagination">
    <?php if ($page > 1): ?>
      <a href="read.php?page=<?=$page-1?>"><i class="fas fa-angle-double-left fa-sm"></i></a>
    <?php endif; ?>
    <?php if ($page * $records_per_page < $num_karyawan): ?>
      <a href="read.php?page=<?=$page+1?>"><i class="fas fa-angle-double-right fa-sm"></i></a>
    <?php endif; ?>
  </div>
</div>

<?=template_footer()?>
