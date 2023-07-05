<?php
require 'vendor/autoload.php'; // Mengimpor library MongoDB PHP
include 'functions.php'; // Memasukkan file functions.php
$db = mongo_connect();

$msg = '';

if (!empty($_POST)) {
    $nama = isset($_POST['nama']) ? $_POST['nama'] : '';
    $gaji = isset($_POST['gaji']) ? $_POST['gaji'] : '';
    $posisi = isset($_POST['posisi']) ? $_POST['posisi'] : '';

    insertKaryawan($nama, $gaji, $posisi);
    $msg = 'Data berhasil ditambahkan';
}

function insertKaryawan($nama, $gaji, $posisi)
{
    $db = mongo_connect();
    $collection = $db->karyawan;
    $document = [
        'nama' => $nama,
        'gaji' => $gaji,
        'posisi' => $posisi
    ];
    $collection->insertOne($document);
}
?>

<?=template_header('Buat Data')?>

<div class="content update">
    <h2>Tambah Data Karyawan</h2>
    <form action="" method="post">
        <label for="nama">Nama</label>
        <input type="text" name="nama" id="nama">
        <label for="gaji">Gaji</label>
        <input type="text" name="gaji" id="gaji">
        <label for="posisi">Posisi</label>
        <input type="text" name="posisi" id="posisi">
        <input type="submit" value="Tambah">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>
