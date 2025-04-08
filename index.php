<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang - Sensus Data Desa Selakambang</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="icon" type="image/png" href="public/asset/logo/logo-title.png">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f4f4;
        }

        .hero {
            background: url('https://images.unsplash.com/photo-1570780728980-63f5a30a1393?q=80&w=1632&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D') center/cover no-repeat;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-align: center;
            position: relative;
            height: 100vh;
        }

        .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }

        .card-custom {
            border: none;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .btn-custom {
            background-color:rgba(27, 61, 61, 0.25);
            border-radius: 5px;
            color: white;
            transition: 0.3s;
            border: 1px solid rgb(84, 172, 172);
        }

        .btn-custom:hover {
            background-color:rgba(18, 117, 121, 0.61);
        }
    </style>
</head>

<body>

    <main>
        <div class="hero">
            <div class="hero-overlay"></div>
            <div class="hero-content">
                <h1 class="display-4 fw-bold">Selamat Datang di Sensus Data Desa Selakambang</h1>
                <p class="lead">Menyajikan informasi kependudukan yang akurat dan transparan.</p>
                <a href="views/rekap/rekap.php" class="btn btn-custom btn-lg mt-3">Mulai Sensus</a>
            </div>
        </div>

        <div class="container my-5" id="sensus">
            <div class="row text-center">
                <div class="col-md-4 mt-3">
                    <div class="card card-custom p-4">
                        <h3 class="fw-bold">5000+</h3>
                        <p>Jumlah Penduduk</p>
                    </div>
                </div>
                <div class="col-md-4 mt-3">
                    <div class="card card-custom p-4">
                        <h3 class="fw-bold">1200</h3>
                        <p>Kepala Keluarga</p>
                    </div>
                </div>
                <div class="col-md-4 mt-3">
                    <div class="card card-custom p-4">
                        <h3 class="fw-bold">15</h3>
                        <p>Dusun</p>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>