<?php
session_start(); // Wajib di paling atas
include "koneksi.php";

$notif = "";

/* FUNGSI */
function bersihkanInput($data) {
    return htmlspecialchars(trim($data));
}

function tampilkanPesan($nama, $kelas) {
    return "Halo $nama dari kelas $kelas, data kamu berhasil dikirim!";
}

/* ================== CEK REQUEST ================== */
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Ambil dan bersihkan data dari form
    $nama    = bersihkanInput($_POST['nama']);
    $kelas   = bersihkanInput($_POST['kelas']);
    $nim     = bersihkanInput($_POST['nim']);
    $nilai   = bersihkanInput($_POST['nilai']);
    $tanggal = bersihkanInput($_POST['tanggal']);
    $email   = bersihkanInput($_POST['email']);
    $warna   = bersihkanInput($_POST['warna']);
    $matkul  = bersihkanInput($_POST['matkul']);

    /* VALIDASI KOSONG */
    if (empty($nama) || empty($kelas) || empty($nim) || empty($tanggal)) {
        echo "Data wajib tidak boleh kosong.";
        exit;
    }
    if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Format email tidak valid.";
        exit;
    }

    // Tentukan Status Lulus
    $statusLulus = ($nilai >= 75) ? "Lulus" : "Tidak Lulus";

    // Simpan ke SESSION
    $_SESSION['dataForm'] = compact(
        'nama', 'kelas', 'nim', 'tanggal', 'nilai', 'email', 'warna', 'matkul', 'statusLulus'
    );
    $_SESSION['nama'] = $nama;
    $_SESSION['kelas'] = $kelas;

    // Simpan Cookie
    setcookie("warna_tema", $warna, time() + 3600);
    setcookie("user", $nama, time() + 3600);

    // Simpan ke database
    $query = "INSERT INTO users (nama, kelas, nim, tanggal, nilai, status, email, matkul, warna)
              VALUES ('$nama', '$kelas', '$nim', '$tanggal', '$nilai', '$statusLulus', '$email', '$matkul', '$warna')";

    if (mysqli_query($conn, $query)) {
        $notif = "Data berhasil disimpan!";
    } else {
        $notif = "Gagal menyimpan data!";
    }

} elseif (isset($_SESSION['dataForm'])) {
    // Ambil dari SESSION saat kembali dari halaman data.php
    extract($_SESSION['dataForm']);
    $notif = "Kembali ke halaman hasil pengiriman.";
} else {
    echo "Silakan isi form terlebih dahulu.";
    exit;
}

/* OPERATOR DAN PERCABANGAN */
$jenisNim = ($nim % 2 == 0) ? "NIM genap" : "NIM ganjil";

/* ARRAY DATA FORM */
$dataFormInfo = [
    "Nama" => $nama,
    "Kelas" => $kelas,
    "NIM" => $nim,
    "Tanggal" => $tanggal,
    "Nilai" => $nilai,
    "Status" => $statusLulus,
    "Email" => $email,
    "Warna Tema" => $warna,
    "Mata Kuliah" => $matkul,
    "Jenis NIM" => $jenisNim
];

/* IMPLEMENTASI MATERI PHP DASAR */
$teks = "php dasar";
$angka1 = 10;
$angka2 = 5;
$nilaiDummy = 100; // Diganti namanya agar tidak menimpa nilai dari inputan form
$aktif = true;
$materi = ["HTML", "CSS"];

array_push($materi, "JavaScript", "PHP");

$tambah = $angka1 + $angka2;
$kurang = $angka1 - $angka2;
$kali = $angka1 * $angka2;
$bagi = $angka1 / $angka2;
$modulus = $angka1 % $angka2;

$statusNilai = ($nilaiDummy >= 80 && $aktif) ? "Lulus" : "Tidak Lulus";

$hari = "Senin";
switch ($hari) {
    case "Senin": $statusHari = "Hari kerja"; break;
    case "Minggu": $statusHari = "Hari libur"; break;
    default: $statusHari = "Hari biasa";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Hasil Form PHP</title>
    <link rel="stylesheet" href="style.css">
</head>
<body style="background: <?= $warna; ?>;">

<header style="background: linear-gradient(90deg, <?= $warna; ?>, #ec4899);">
    <h1>Hasil Pengiriman Form</h1>
    <p>Implementasi PHP dan MySQL</p>
</header>

<?php if (!empty($notif)) { ?>
    <div class="notif">
        <?= $notif; ?>
    </div>
<?php } ?>

<div class="area-bawah">
    <a href="data.php" class="btn-kembali">📊 Lihat Data User</a>
</div>

<main>
    <section class="card">
        <h2><?= tampilkanPesan($nama, $kelas); ?></h2>

        <table>
            <tr>
                <th>Field</th>
                <th>Isi Data</th>
            </tr>

           <?php foreach ($dataFormInfo as $field => $isi): ?>
            <tr>
                <td><?= $field; ?></td>
                <td>
                    <?php if ($field == "Status"): ?>
                        <?php if ($isi == "Lulus"): ?>
                            <span style="color:green; font-weight:bold;">Lulus</span>
                        <?php else: ?>
                            <span style="color:red; font-weight:bold;">Tidak Lulus</span>
                        <?php endif; ?>
                    <?php else: ?>
                        <?= $isi; ?>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </section>

    <section class="card">
        <h2>Session dan Cookie</h2>
        <p>Selamat datang, <?= $_SESSION['nama']; ?> 👋</p>
        <p>Warna tema disimpan ke cookie.</p>
    </section>

    <section class="card">
        <h2>Ringkasan Data</h2>

        <?php
        $totalUserQuery = mysqli_query($conn, "SELECT * FROM users");
        $totalUser = mysqli_num_rows($totalUserQuery);

        $namaKapital = strtoupper($nama);
        $jumlahHuruf = strlen($nama);

        $nimStatus = ($nim % 2 == 0) ? "Genap" : "Ganjil";

        switch ($kelas) {
            case "4A": $jadwal = "Kelas Pagi"; break;
            case "4C": $jadwal = "Kelas Siang"; break;
            default: $jadwal = "Kelas Reguler";
        }
        ?>

        <div class="dashboard">
            <div class="stat-card">
                <h3>Total User</h3>
                <p><?= $totalUser; ?></p>
            </div>
            <div class="stat-card">
                <h3>Status NIM</h3>
                <p><?= $nimStatus; ?></p>
            </div>
            <div class="stat-card">
                <h3>Jadwal</h3>
                <p><?= $jadwal; ?></p>
            </div>
            <div class="stat-card">
                <h3>Panjang Nama</h3>
                <p><?= $jumlahHuruf; ?> huruf</p>
            </div>
        </div>

        <div class="profile-box">
            <h3>Profil Pengguna</h3>
            <p><strong>Nama:</strong> <?= $namaKapital; ?></p>
            <p><strong>Kelas:</strong> <?= $kelas; ?></p>
            <p><strong>Email:</strong> <?= $email; ?></p>
        </div>
    </section>

    <section class="card">
        <h2>Implementasi PHP Dasar</h2>

        <div class="dashboard">
            <div class="stat-card">
                <h3>Teks</h3>
                <p><?= $teks; ?></p>
            </div>
            <div class="stat-card">
                <h3>Nilai Dummy</h3>
                <p><?= $nilaiDummy; ?></p>
            </div>
            <div class="stat-card">
                <h3>Status</h3>
                <p><?= $statusNilai; ?></p>
            </div>
            <div class="stat-card">
                <h3>Hari</h3>
                <p><?= $statusHari; ?></p>
            </div>
        </div>

        <div class="profile-box">
            <h3>Operator Aritmatika</h3>
            <p>Penjumlahan: <?= $tambah; ?></p>
            <p>Pengurangan: <?= $kurang; ?></p>
            <p>Perkalian: <?= $kali; ?></p>
            <p>Pembagian: <?= $bagi; ?></p>
            <p>Modulus: <?= $modulus; ?></p>
        </div>

        <div class="profile-box">
            <h3>Array Materi</h3>
            <ul>
                <?php foreach ($materi as $m) { ?>
                    <li><?= $m; ?></li>
                <?php } ?>
            </ul>
        </div>
    </section>
</main>

<div class="area-bawah">
    <a href="index.html" class="btn-kembali">🏠 Kembali ke Halaman Utama</a>
</div>

<footer>
    <p>© 2026 Praktikum Web 💻</p>
</footer>

</body>
</html>