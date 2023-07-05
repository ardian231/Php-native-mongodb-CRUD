<?php
include 'functions.php';
require 'vendor/autoload.php';
$db = mongo_connect();

function getKaryawan($id)
{
    global $db;
    $collection = $db->karyawan;
    $karyawan = $collection->findOne(['_id' => new MongoDB\BSON\ObjectID($id)]);
    return $karyawan;
}

function updateKaryawan($id, $nama, $gaji, $posisi)
{
    global $db;
    $collection = $db->karyawan;
    $collection->updateOne(
        ['_id' => new MongoDB\BSON\ObjectID($id)],
        ['$set' => ['nama' => $nama, 'gaji' => $gaji, 'posisi' => $posisi]]
    );
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $gaji = $_POST['gaji'];
    $posisi = $_POST['posisi'];
    updateKaryawan($id, $nama, $gaji, $posisi);
    header('Location: index.php');
    exit();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $karyawan = getKaryawan($id);
    if (!$karyawan) {
        exit('Data karyawan tidak ditemukan');
    }
} else {
    exit('ID karyawan tidak spesifik');
}
?>

<?=template_header('Update Data Karyawan')?>

<div class="content update">
    <h2>Update Data Karyawan</h2>
    <form action="" method="post">
        <input type="hidden" name="id" value="<?= $karyawan['_id'] ?>">
        <label for="nama">Nama</label>
        <input type="text" name="nama" id="nama" value="<?= $karyawan['nama'] ?>">
        <label for="gaji">Gaji</label>
        <input type="text" name="gaji" id="gaji" value="<?= $karyawan['gaji'] ?>">
        <label for="posisi">Posisi</label>
        <input type="text" name="posisi" id="posisi" value="<?= $karyawan['posisi'] ?>">
        <input type="submit" value="Update">
    </form>
</div>

<?=template_footer()?>
