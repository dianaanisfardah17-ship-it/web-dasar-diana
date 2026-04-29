<?php
include "koneksi.php";

$filter = "";

if (isset($_GET['status'])) {
    $filter = $_GET['status'];
}

if ($filter == "Lulus") {
    $query = mysqli_query($conn, "SELECT * FROM users WHERE status = 'Lulus'");
} elseif ($filter == "Tidak Lulus") {
    $query = mysqli_query($conn, "SELECT * FROM users WHERE status = 'Tidak Lulus'");
} else {
    $query = mysqli_query($conn, "SELECT * FROM users");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data User</title>
   <link rel="stylesheet" href="style.css?v=3">
</head>
<body>

<header>
    <h1>📊 Data User</h1>
</header>

<main class="data-main">

    <div class="card data-card">
        <h2>Daftar Data</h2>
<div class="filter-box">
    <a href="data.php" class="btn-filter">Semua</a>
    <a href="data.php?status=Lulus" class="btn-filter">Lulus</a>
    <a href="data.php?status=Tidak Lulus" class="btn-filter">Tidak Lulus</a>
</div>
        <div class="table-wrapper">
            <table>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Kelas</th>
                <th>NIM</th>
                <th>Tanggal</th>
                <th>Nilai</th>
                <th>Status</th>
                <th>Email</th>
                <th>Matkul</th>
                <th>Warna</th>
            </tr>
            <?php 
            $no = 1;
            while ($row = mysqli_fetch_assoc($query)) { 
            ?>
            <tr>
    <td><?= $no++; ?></td>
    <td><?= $row['nama']; ?></td>
    <td><?= $row['kelas']; ?></td>
    <td><?= $row['nim']; ?></td>
    <td><?= $row['tanggal']; ?></td>
    <td><?= $row['nilai']; ?></td>
    <td> 
        <?php if ($row['status'] == "Lulus"): ?>
          <span style="color:green; font-weight:bold;">Lulus</span>
        <?php else: ?>
            <span style="color:red; font-weight:bold;">Tidak Lulus</span>
        <?php endif; ?>
    </td>
    <td><?= $row['email']; ?></td>
    <td><?= $row['matkul']; ?></td>
    <td>
        <span style="display:inline-block; width:20px; height:20px; border-radius:50%; background:<?= $row['warna']; ?>;"></span>
    </td>
</tr>

            <?php } ?>

       </table>
        </div>
    </div>

    <div class="area-bawah">
        <a href="proses.php" class="btn-kembali">← Kembali</a>
    </div>

</main>

<footer>
    <p>© 2026 Praktikum Web 💻</p>
</footer>

</body>
</html>