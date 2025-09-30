<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Berhasil</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
    
    <style>
        /* ======================================= */
        /* STYLE KHUSUS HALAMAN SUKSES */
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
            justify-content: center; /* Center horizontally */
            align-items: center; /* Center vertically */
            min-height: 100vh;
            text-align: center;
            padding: 20px;
        }

        /* Box Formulir Styling (digunakan sebagai box-success) */
        .box-formulir {
            width: 95%;
            max-width: 600px; /* Lebih kecil karena hanya pesan */
            padding: 40px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            border-top: 5px solid #4CAF50; /* Aksen hijau sukses di atas */
        }

        .box-formulir h2 {
            color: #4CAF50; /* Warna hijau untuk sukses */
            margin-bottom: 25px;
            font-weight: 700;
            font-size: 2.2rem;
        }

        .boxs p {
            font-size: 1.1rem;
            margin-bottom: 15px;
            color: #555;
        }
        
        .boxs p:last-of-type {
            margin-bottom: 30px;
        }

        /* Tombol Kembali (disesuaikan dari btn-daftar) */
        .btn-dafta { /* Nama kelas diubah menjadi btn-dafta */
            display: inline-block;
            padding: 15px 30px;
            background-color: #007bff; /* Primary blue button */
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1.1rem;
            font-weight: 700;
            text-transform: uppercase;
            text-decoration: none;
            transition: background-color 0.3s, transform 0.2s;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .btn-dafta:hover {
            background-color: #0056b3;
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
        }

        /* Responsive */
        @media (max-width: 480px) {
            .box-formulir {
                padding: 30px 20px;
            }
            
            .box-formulir h2 {
                font-size: 1.8rem;
            }
            
            .btn-dafta {
                width: 100%;
                padding: 15px 20px;
            }
        }
    </style>
</head>
<body>
    <section class="box-formulir">
        <h2>Pendaftaran Berhasil 🎉</h2>
        <div class="boxs">
            <p>Terima kasih telah mendaftar! Data Anda telah berhasil dikirim ke sistem kami.</p>
            <p>Anda dapat kembali ke halaman utama dengan mengklik tombol di bawah ini:</p>
            <a href="index.php" class="btn-dafta">Kembali ke Halaman Utama</a>
        </div>
    </section>
</body>
</html>