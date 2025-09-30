<?php
include 'koneksi.php';

// PENTING: Untuk keamanan, Anda harus menggunakan Prepared Statements untuk mencegah SQL Injection.
// Kode di bawah adalah cara yang lebih aman menggunakan MySQLi Prepared Statements.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dan sanitasi
    $nama = trim($_POST['nama']);
    $alamat = trim($_POST['alamat']);
    $tgl_lahir = $_POST['tgl_lahir'];
    $agama = $_POST['agama'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $jurusan = $_POST['jurusan'];
    $tinggi_badan = $_POST['tinggi_badan'];
    $berat_badan = $_POST['berat_badan'];
    $telepon = trim($_POST['telepon']);

    // Pastikan koneksi tersedia ($conn)
    if (isset($conn)) {
        // Query menggunakan Prepared Statement
        $stmt = $conn->prepare("INSERT INTO anggota (nama, alamat, tgl_lahir, agama, jenis_kelamin, jurusan, tinggi_badan, berat_badan, telepon) 
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        
        // Bind parameter: s=string, i=integer
        $stmt->bind_param("ssssssiis", $nama, $alamat, $tgl_lahir, $agama, $jenis_kelamin, $jurusan, $tinggi_badan, $berat_badan, $telepon);

        if ($stmt->execute()) {
            // Pengalihan setelah berhasil
            header("Location: success.php");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
        $conn->close();
    } else {
        echo "Error: Koneksi database tidak tersedia.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Pendaftaran Anggota</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
    
    <style>
        /* ======================================= */
        /* BASE & LAYOUT STYLE (Memenuhi Layar Laptop) */
        /* ======================================= */
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Quicksand', sans-serif;
            background-color: #f0f4f8; /* Background light blue/gray */
            color: #333;
            line-height: 1.6;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* Header Styling */
        header {
            background-color: #007bff; /* Primary blue color */
            color: white;
            padding: 1.5rem;
            text-align: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        header h1 {
            font-weight: 500;
            font-size: 1.8rem;
        }

        /* Footer Styling */
        footer {
            background-color: #333;
            color: #ccc;
            text-align: center;
            padding: 1rem;
            margin-top: auto;
            font-size: 0.9em;
        }

        /* Box Formulir Styling */
        .box-formulir {
            width: 90%; /* Menggunakan 90% lebar layar */
            max-width: 1100px; /* Maksimum lebar untuk layar laptop */
            margin: 30px auto;
            padding: 30px 40px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            flex-grow: 1; /* Memastikan formulir memenuhi ruang kosong */
        }

        .box-formulir h2 {
            text-align: center;
            color: #007bff;
            margin-bottom: 25px;
            font-weight: 700;
            font-size: 2rem;
        }

        .box-formulir h3 {
            border-bottom: 3px solid #4CAF50; /* Fresh green accent */
            padding-bottom: 10px;
            margin-bottom: 25px;
            color: #4CAF50;
            font-weight: 600;
            font-size: 1.3rem;
        }

        /* Table Form Styling */
        .table-form {
            width: 100%;
            border-collapse: collapse;
        }

        .table-form td {
            padding: 12px 0;
            vertical-align: top;
        }

        .table-form tr td:first-child {
            width: 250px; /* Lebar label yang tetap */
            font-weight: 500;
            color: #555;
            padding-right: 20px;
        }

        /* ======================================= */
        /* INPUT & BUTTON STYLE */
        /* ======================================= */
        .input-control {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            transition: border-color 0.3s, box-shadow 0.3s;
            font-family: 'Quicksand', sans-serif;
            font-size: 1rem;
            background-color: #f9f9f9;
        }

        .input-control:focus {
            border-color: #4CAF50;
            box-shadow: 0 0 8px rgba(76, 175, 80, 0.3);
            outline: none;
            background-color: #fff;
        }

        textarea.input-control {
            resize: vertical;
            min-height: 100px;
        }

        /* Radio Group Styling */
        .radio-group {
            display: flex;
            gap: 30px;
            align-items: center;
            padding-top: 5px;
        }

        .radio-group label {
            display: flex;
            align-items: center;
            cursor: pointer;
            font-weight: 400;
        }

        /* Submit Button Styling */
        .btn-daftar {
            display: block;
            width: 100%;
            padding: 18px;
            margin-top: 25px;
            background-color: #4CAF50; /* Fresh green button */
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1.2rem;
            font-weight: 700;
            text-transform: uppercase;
            transition: background-color 0.3s, transform 0.2s;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .btn-daftar:hover {
            background-color: #45a049;
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
        }

        /* ======================================= */
        /* RESPONSIVE DESIGN */
        /* ======================================= */
        @media (max-width: 768px) {
            .box-formulir {
                width: 95%;
                padding: 20px;
            }
            
            .box-formulir h2 {
                font-size: 1.7rem;
            }

            .table-form tr {
                display: flex;
                flex-direction: column;
            }

            .table-form tr td:first-child {
                width: 100%;
                padding-bottom: 5px;
            }
            
            .table-form tr td {
                width: 100%;
                padding-top: 5px;
                padding-bottom: 15px;
            }
            
            .radio-group {
                gap: 15px;
                padding-top: 0;
            }
        }
    </style>
</head>
<body>
    <header>
        <h1>Aplikasi Pendaftaran Anggota</h1>
    </header>

    <section class="box-formulir">
        <h2>Formulir Pendaftaran Anggota Baru</h2>
        <form action="" method="post"> 
            <h3>Data Diri Calon Anggota</h3>
            <div class="box">
                <table class="table-form">
                    <tr>
                        <td>Nama Lengkap</td>
                        <td>
                            <input type="text" name="nama" class="input-control" required>
                        </td>
                    </tr>
                    <tr>
                        <td>Alamat Lengkap</td>
                        <td>
                            <textarea name="alamat" class="input-control" required></textarea> 
                        </td>
                    </tr>
                    <tr>
                        <td>Tanggal Lahir</td>
                        <td>
                            <input type="date" name="tgl_lahir" class="input-control" required>
                        </td>
                    </tr>
                    <tr>
                        <td>Agama</td>
                        <td>
                            <select class="input-control" name="agama" required>
                                <option value="">--pilih--</option>
                                <option value="Islam">Islam</option>
                                <option value="Kristen">Kristen</option>
                                <option value="Katolik">Katolik</option>
                                <option value="Hindu">Hindu</option>
                                <option value="Budha">Budha</option>
                                <option value="Konghucu">Konghucu</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Jenis Kelamin</td>
                        <td>
                            <div class="radio-group">
                                <label><input type="radio" name="jenis_kelamin" value="Laki-laki" required> Laki-laki</label>
                                <label><input type="radio" name="jenis_kelamin" value="Perempuan" required> Perempuan</label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Jurusan</td>
                        <td>
                            <select class="input-control" name="jurusan" required>
                                <option value="">--pilih--</option>
                                <option value="AKL">AKL (Akuntansi)</option>
                                <option value="PPLG">PPLG (Pengembangan Perangkat Lunak)</option>
                                <option value="MPLB">MPLB (Manajemen Perkantoran)</option>
                                <option value="PM">PM (Pemasaran)</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Tinggi Badan (cm)</td>
                        <td>
                            <input type="number" name="tinggi_badan" class="input-control" placeholder="Contoh: 170" required>
                        </td>
                    </tr>
                    <tr>
                        <td>Berat Badan (kg)</td>
                        <td>
                            <input type="number" name="berat_badan" class="input-control" placeholder="Contoh: 65" required>
                        </td>
                    </tr>
                    <tr>
                        <td>Nomor Telepon</td>
                        <td>
                            <input type="tel" name="telepon" class="input-control" placeholder="Contoh: 08123456789" required>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" name="submit" class="btn-daftar" value="Daftar Sekarang">
                        </td>
                    </tr>
                </table>
            </div>
        </form>
    </section>

    <footer>
        <p>&copy; 2024 FinDev Studio. All Rights Reserved.</p>
    </footer>
</body>
</html>