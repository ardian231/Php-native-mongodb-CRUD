<?php
require 'vendor/autoload.php'; // Mengimpor library MongoDB PHP

function mongo_connect() {
    $DATABASE_HOST = 'localhost';
    $DATABASE_NAME = 'tugas_akhir';
    
    try {
        $client = new MongoDB\Client("mongodb://$DATABASE_HOST");
        $db = $client->$DATABASE_NAME;
        return $db;
    } catch (MongoDB\Exception\Exception $e) {
        // Jika terjadi kesalahan dalam koneksi, hentikan script dan tampilkan pesan kesalahan.
        exit('Gagal terhubung ke database!');
    }
}


function template_header($title) {
    echo <<<EOT
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8">
        <title>DATA KARYAWAN</title>
        <link href="style.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    </head>
    <body>
    <nav class="navtop">
        <div>
            <h1>PT. Adi Guna</h1>
            <a href="index.php"><i class="fas fa-home"></i>Home</a>
            <a href="read.php"><i class="fas fa-book"></i>Karyawan</a>
        </div>
    </nav>
EOT;
}

function template_footer() {
    echo <<<EOT
    </body>
    </html>
EOT;
}
?>
