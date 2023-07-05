<?php
  // Menyertakan file koneksi.php
  include 'functions.php';

  // Buat koneksi ke databases
  $pdo = pdo_connect_mysql();
?>
<?=template_header('Data Karyawan')?>
<html>
<head>
<title>Data Karyawan</title>
 <style>
    body {
      font-family: Arial, sans-serif;
    }
    table {
      border-collapse: collapse;
      width: 100%;
    }
    td, th {
      border: 1px solid #dddddd;
      text-align: left;
      padding: 8px;
    }
    tr:nth-child(even) {
      background-color: #dddddd;
    }
  </style>
</head>
<body>
  <h1>Daftar Karyawan</h1>
  <table>
    <tr>
      <td>NIK</td>
      <td>Nama</td>
      <td>Jabatan</td>
      <td>Pendidikan</td>
      <td>Alamat</td>
      <td>Gaji</td>
      <td>Jenis Kelamin</td>
      <td>Keterangan</td>
      <td>Action</td>
    </tr>
    <?php
      // Set error mode PDO
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      
     // Ambil data dari form pencarian
  $keyword = '%' . $_POST["keyword"] . '%';
  $fungsi = $_POST["fungsi"];

  // Buat query untuk mencari data sesuai fungsi yang dipilih
  $query = "SELECT * FROM karyawan WHERE " . $fungsi . " LIKE :keyword";

  // Persiapkan statement
  $stmt = $pdo->prepare($query);

  // Bind parameter
  $stmt->bindParam(":keyword", $keyword, PDO::PARAM_STR);

  // Jalankan statement
  $stmt->execute();
      // Tampilkan data untuk setiap baris dalam tabel
      while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td>" . $row["nik"]. "</td>";
        echo "<td>" . $row["nama"]. "</td>";
        echo "<td>" . $row["jabatan"]. "</td>";
        echo "<td>" . $row["pendidikan"]. "</td>";
        echo "<td>" . $row["alamat"]. "</td>";
        echo "<td>" . $row["total_gaji"]. "</td>";
        echo "<td>" . $row["jenis_kelamin"]. "</td>";
        echo "<td>" . $row["keterangan"]. "</td>";
        echo "<td>
          <a href='update.php?nik=" . $row["nik"] . "'>Edit</a>
          <a href='delete.php?nik=" . $row["nik"] . "'>Hapus</a>
          </td>";
        echo "</tr>";
      }
    ?>
  </table>
</body>
</html>
<?=template_footer()?>
