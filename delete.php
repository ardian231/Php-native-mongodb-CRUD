<?php
require 'vendor/autoload.php';
include 'functions.php';
$db = mongo_connect();

function getKaryawanByID($id)
{
    $db = mongo_connect();
    $collection = $db->karyawan;
    $karyawan = $collection->findOne(['_id' => new MongoDB\BSON\ObjectId($id)]);
    return $karyawan;
}

function deleteKaryawanByID($id)
{
    $db = mongo_connect();
    $collection = $db->karyawan;
    $collection->deleteOne(['_id' => new MongoDB\BSON\ObjectId($id)]);
}

$msg = '';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $karyawan = getKaryawanByID($id);
    if (!$karyawan) {
        exit('Tidak ada data dengan ID tersebut');
    }

    if (isset($_GET['confirm'])) {
        if ($_GET['confirm'] == 'yes') {
            deleteKaryawanByID($id);
            $msg = 'Data telah dihapus';
        } else {
            header('Location: read.php');
            exit;
        }
    }
} else {
    exit('ID tidak spesifik!');
}
?>

<?=template_header('Hapus Data')?>

<div class="content delete">
    <h2>Hapus Data #<?= $karyawan['_id'] ?></h2>
    <?php if ($msg): ?>
        <p><?= $msg ?></p>
    <?php else: ?>
        <p>Apakah Anda yakin ingin menghapus data #<?= $karyawan['_id'] ?>?</p>
        <div class="yes">
            <a href="delete.php?id=<?= $karyawan['_id'] ?>&confirm=yes">Ya</a>
        </div>
        <div class="no">
            <a href="delete.php?id=<?= $karyawan['_id'] ?>&confirm=no">Tidak</a>
        </div>
    <?php endif; ?>
</div>

<?=template_footer()?>
