<?php
session_start();
$id_user = $_SESSION['id_user'] ?? 1; // Ganti sesuai session login Anda
if(isset($_POST['pesan_keranjang'])) {
    $menu = $_POST['menu'];
    $suhu = $_POST['suhu'];
    $harga = $_POST['harga'];
    $jumlah = 1;
    $koneksi = mysqli_connect('localhost','root','','umkm_muteg');
    $sql = "INSERT INTO keranjang (id_user, nama_produk, suhu, jumlah, harga) VALUES ('$id_user', '$menu', '$suhu', '$jumlah', '$harga')";
    mysqli_query($koneksi, $sql);
    header('Location: cart.php');
    exit();
}
?>



<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Kopi UMKM</title>
    <link href="bootstrap/bootstrap-5.3.7-dist.zip" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: url('uploads/kopi.jpg') no-repeat center center fixed;
            background-size: cover;
            background-position: center;
            min-height: 100vh;
            position: relative;
        }
        /* Overlay agar konten tetap mudah dibaca */
        body::before {
            content: "";
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: rgba(248,245,242,0.5); /* Lebih transparan, gambar lebih jelas */
            z-index: 0;
        }
        .container {
            position: relative;
            z-index: 1;
        }
        .navbar {
            position: relative;
            z-index: 2;
        }
        .kopi-title {
            font-family: 'Segoe Script', 'Pacifico', cursive;
            color: #a47150;
            text-align: center;
            margin-bottom: 2rem;
        }
        .card {
            border-radius: 18px;
            box-shadow: 0 4px 16px 0 rgba(164,113,73,0.08);
            transition: transform 0.15s;
        }
        .card:hover {
            transform: translateY(-6px) scale(1.03);
            box-shadow: 0 8px 24px 0 rgba(164,113,73,0.15);
        }
        .card-img-top {
            height: 180px;
            object-fit: cover;
            border-top-left-radius: 18px;
            border-top-right-radius: 18px;
        }
        .card-title {
            color: #a47150;
            font-weight: bold;
        }
        .card-text strong {
            color: #7d4c2b;
        }
        .dropdown-menu {
            z-index: 2000 !important;
            pointer-events: auto;
        }
        @media (max-width: 767px) {
            .row-cols-md-3 > .col {
                margin-bottom: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <!-- navbar -->
    <nav class="navbar navbar-expand-lg navbar-light" style="background: #fffbe9; box-shadow: 0 2px 8px 0 rgba(164,113,73,0.07);">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="https://img.icons8.com/ios-filled/40/a47149/coffee.png" alt="Logo terass coffee" style="margin-right:10px;">
                <span style="font-family: 'Pacifico', cursive; color: #a47149; font-size: 1.5rem;">terass coffee</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- collapse -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-lg-center">
                    <!--menu-->
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#menuKopi" style="color:#a47149; font-weight:500;">Menu</a>
                    </li>
                    <!-- tentang -->
                    <li class="nav-item">
                        <a class="nav-link" href="#" style="color:#a47149;" data-bs-toggle="collapse" data-bs-target="#tentangCollapse" aria-expanded="false" aria-controls="tentangCollapse">Tentang</a>
                    </li>
                    <!--kontak-->
                    <li class="nav-item">
                        <a class="nav-link" href="#" style="color:#a47149;" data-bs-toggle="collapse" data-bs-target="#kontakCollapse" aria-expanded="false" aria-controls="kontakCollapse">Kontak</a>
                    </li>
                    <!-- sosial media -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="javascript:void(0)" id="sosmedDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color:#a47149; cursor:pointer;">
                            <img src="https://img.icons8.com/ios-filled/20/a47149/share-2.png" style="margin-bottom:3px;"> Sosial Media
                        </a>
                        <!-- drop menu dan akun media sosial -->
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="sosmedDropdown">
                            <li><a class="dropdown-item" href="https://wa.me/6282276684455" target="_blank"><img src="https://img.icons8.com/ios-filled/18/25d366/whatsapp.png" style="margin-right:6px;">WhatsApp</a></li>
                            <li><a class="dropdown-item" href="https://instagram.com/kopipangeran.id" target="_blank"><img src="https://img.icons8.com/ios-filled/18/e4405f/instagram-new.png" style="margin-right:6px;">Instagram</a></li>
                            <li><a class="dropdown-item" href="mailto:mutiasyahfitrim@email.com"><img src="https://img.icons8.com/ios-filled/18/a47149/new-post.png" style="margin-right:6px;">Email</a></li>
                        </ul>
                    </li>
                    <!-- pesan sekarang -->
                    <li class="nav-item ms-lg-3 mt-2 mt-lg-0">
                        <a href="https://wa.me/6282276684455" target="_blank" class="btn btn-sm" style="background:#a47149; color:#fff; font-weight:500; border-radius:20px; box-shadow:0 2px 8px 0 rgba(164,113,73,0.07);">
                            <img src="https://img.icons8.com/ios-filled/18/ffffff/whatsapp.png" style="margin-bottom:3px; margin-right:4px;">Pesan Sekarang
                        </a>
                    </li>
                    <!-- keranjang -->
                    <li class="nav-item ms-lg-3 mt-2 mt-lg-0">
                        <a href="cart.php" class="nav-link position-relative" title="Lihat Keranjang" style="font-size:1.3rem; color:#a47149;">
                            <img src="https://img.icons8.com/ios-filled/28/a47149/shopping-cart.png" alt="Keranjang" style="vertical-align:middle;">
                        </a>
                    </li>
                    <!-- tombol logout -->
                    <li class="nav-item ms-lg-2 mt-2 mt-lg-0">
                        <a href="login.php" class="btn btn-outline-danger d-flex align-items-center" style="border-radius:20px; font-weight:600;">
                            <img src="https://img.icons8.com/ios-filled/22/fa314a/logout-rounded-left.png" alt="Logout" style="margin-right:6px;"> Logout
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <!-- Hero Section Terass Coffee -->
        <div class="text-center py-5" style="min-height: 350px;">
            <img src="https://img.icons8.com/ios-filled/80/a47149/coffee.png" alt="Logo terass coffee" style="margin-bottom:1rem;">
            <h1 class="kopi-title" style="font-size:2.5rem;">Selamat Datang di Terass Coffee</h1>
            <p style="color:#7d4c2b; font-size:1.2rem; max-width:600px; margin:0 auto 2rem auto;"><strong>Nikmati berbagai pilihan kopi terbaik, suasana nyaman, dan pelayanan ramah di Terass Coffee. Tempat nongkrong, kerja, dan berbagi cerita bersama teman atau keluarga.</strong></p>
            <a href="#menuKopi" class="btn btn-sm" style="background:#a47149; color:#fff; font-weight:500; border-radius:20px; padding:0.7rem 2rem; font-size:1.1rem;">Lihat Menu Kopi</a>
        </div>
        <!-- Section Kontak (Collapsible) -->
        <div class="collapse mb-5" id="kontakCollapse">
            <section class="py-4" style="background:rgba(255,255,255,0.7); border-radius:18px; max-width:900px; margin:0 auto 3rem auto;">
                <h2 class="kopi-title" style="font-size:2rem;">Kontak Terass Coffee</h2>
                <div class="d-flex flex-column align-items-center" style="gap:1.2rem;">
                    <a href="https://wa.me/6281262120898" target="_blank" class="btn btn-success" style="min-width:220px; font-weight:500; border-radius:20px;">
                        <img src="https://img.icons8.com/ios-filled/22/ffffff/whatsapp.png" style="margin-bottom:3px; margin-right:6px;"> WhatsApp: 0812-6212-0898
                    </a>
                    <a href="mailto:mutiasyahfitrim@email.com" class="btn btn-outline-secondary" style="min-width:220px; font-weight:500; border-radius:20px;">
                        <img src="https://img.icons8.com/ios-filled/22/a47149/new-post.png" style="margin-bottom:3px; margin-right:6px;"> Email: mutiasyahfitrim@email.com
                    </a>
                </div>
                <!--keterangan tentang jamoperasional dan maps-->
                <div class="mt-4 d-flex flex-column align-items-center gap-3">
                    <div class="bg-white rounded-3 p-3 shadow-sm" style="max-width:350px; width:100%;">
                        <div style="color:#a47149; font-weight:600; font-size:1.1rem;">Jam Operasional</div>
                        <div style="color:#7d4c2b; font-size:1rem;">Senin - Minggu: 11.30 - 23.30 WIB </div>
                        <div style="color:#a47149; font-weight:600; font-size:1.1rem; margin-top:0.7rem;">Alamat</div>
                        <div style="color:#7d4c2b; font-size:1rem;">Jl. Sersan M. Arifin, Sungei Putih, Kec. Galang, Kabupaten Deli Serdang, Sumatera Utara 20585</div>
                    </div>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d860.7625650669243!2d98.89261787886119!3d3.4355874158785373!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x303141e7cc13a35f%3A0x5dbfd12b5b1955a1!2sWarna%20coffee!5e1!3m2!1sid!2sid!4v1757571024154!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </section>
        </div>
        <!-- Section Tentang Coffee (Collapsible) -->
        <div class="collapse mb-5" id="tentangCollapse">
            <section class="py-4" style="background:rgba(255,255,255,0.7); border-radius:18px; max-width:900px; margin:0 auto 3rem auto;">
                <h2 class="kopi-title" style="font-size:2rem;">Tentang Terass Coffee</h2>
                <p style="color:#7d4c2b; font-size:1.1rem; max-width:700px; margin:0 auto; text-align:center;">
                    Terass Coffee adalah kedai kopi kekinian yang menghadirkan berbagai varian kopi berkualitas, suasana nyaman, dan pelayanan ramah. Kami percaya setiap cangkir kopi punya cerita, dan kami ingin menjadi bagian dari cerita harian Anda—baik untuk bersantai, bekerja, maupun berkumpul bersama teman dan keluarga. Selamat menikmati pengalaman terbaik di Terass Coffee!
                </p>
                <!-- info wilayah -->
                <div class="mt-4 p-3 bg-white rounded-3 shadow-sm" style="max-width:500px; margin:0 auto;">
                    <div style="color:#a47149; font-weight:600; font-size:1.1rem;">Wilayah Pembelian</div>
                    <div style="color:#7d4c2b; font-size:1rem;">Pembelian hanya dapat dilakukan di wilayah berikut:</div>
                    <ul style="color:#7d4c2b; font-size:1rem; margin-top:0.5rem; margin-bottom:0; text-align:left;">
                        <li>GALANG</li>
                        <li>Galang suka</li>
                        <li>Jaharun</li>
                        
                    </ul>
                </div>
                <!-- video -->
                <div class="video">
                        <video controls style="max-width:100%; width:100%; height:auto; border-radius:0px; box-shadow:0 2px 8px rgba(164,113,73,0.10);">
                            <source src="video_cofe.mp4" type="video/mp4">
                        </video>
                </div>
                
            </section>
        </div>
        <!-- Daftar Menu Kopi -->
        <h2 class="mb-4 kopi-title" id="menuKopi" style="font-size:2rem;">Daftar Menu Kopi</h2>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <div class="col">
                <div class="card h-100">
                    <img src="uploads/kopi.jpg" class="card-img-top" alt="Expresso">
                    <div class="card-body">
                        <h5 class="card-title">Expresso</h5>
                        <p class="card-text">Kopi hitam pekat dengan rasa kuat, cocok untuk penikmat kopi sejati.</p>
                        <p class="card-text"><strong>Rp 35.000</strong></p>
                        <a href="cart.php" class="btn btn-outline-warning d-flex align-items-center justify-content-center keranjang-btn" style="border-radius:12px; font-weight:600;">
                            <img src="https://img.icons8.com/ios-filled/24/a47149/shopping-cart.png" alt="Keranjang" style="margin-right:8px;"> Keranjang
                        </a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100">
                    <img src="uploads/capucino.jpg" class="card-img-top" alt="Cappuccino">
                    <div class="card-body">
                        <h5 class="card-title">Cappuccino</h5>
                        <p class="card-text">Perpaduan espresso, susu, dan foam yang lembut di lidah.</p>
                        <p class="card-text"><strong>Rp 22.000</strong></p>
                        <a href="cart.php" class="btn btn-outline-warning d-flex align-items-center justify-content-center keranjang-btn" style="border-radius:12px; font-weight:600;">
                            <img src="https://img.icons8.com/ios-filled/24/a47149/shopping-cart.png" alt="Keranjang" style="margin-right:8px;"> Keranjang
                        </a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100">
                    <img src="uploads/latte.avif" class="card-img-top" alt="Latte">
                    <div class="card-body">
                        <h5 class="card-title">Latte</h5>
                        <p class="card-text">Kopi susu dengan rasa creamy, cocok untuk semua kalangan.</p>
                        <p class="card-text"><strong>Rp 25.000</strong></p>
                        <a href="cart.php" class="btn btn-outline-warning d-flex align-items-center justify-content-center keranjang-btn" style="border-radius:12px; font-weight:600;">
                            <img src="https://img.icons8.com/ios-filled/24/a47149/shopping-cart.png" alt="Keranjang" style="margin-right:8px;"> Keranjang
                        </a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100">
                    <img src="uploads/americano.jpg" class="card-img-top" alt="Americano">
                    <div class="card-body">
                        <h5 class="card-title">Americano</h5>
                        <p class="card-text">Espresso yang dicampur air panas, rasa ringan dan segar.</p>
                        <p class="card-text"><strong>Rp 20.000</strong></p>
                        <a href="cart.php" class="btn btn-outline-warning d-flex align-items-center justify-content-center keranjang-btn" style="border-radius:12px; font-weight:600;">
                            <img src="https://img.icons8.com/ios-filled/24/a47149/shopping-cart.png" alt="Keranjang" style="margin-right:8px;"> Keranjang
                        </a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100">
                    <img src="uploads/mocha.jpg" class="card-img-top" alt="Mocha">
                    <div class="card-body">
                        <h5 class="card-title">Mocha</h5>
                        <p class="card-text">Kopi dengan campuran coklat dan susu, manis dan nikmat.</p>
                        <p class="card-text"><strong>Rp 30.000</strong></p>
                        <a href="cart.php" class="btn btn-outline-warning d-flex align-items-center justify-content-center keranjang-btn" style="border-radius:12px; font-weight:600;">
                            <img src="https://img.icons8.com/ios-filled/24/a47149/shopping-cart.png" alt="Keranjang" style="margin-right:8px;"> Keranjang
                        </a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100">
                    <img src="uploads/tubruk.jpeg" class="card-img-top" alt="Kopi Tubruk">
                    <div class="card-body">
                        <h5 class="card-title">Kopi Tubruk</h5>
                        <p class="card-text">Kopi tradisional Indonesia dengan rasa khas dan aroma kuat.</p>
                        <p class="card-text"><strong>Rp 28.000</strong></p>
                        <a href="cart.php" class="btn btn-outline-warning d-flex align-items-center justify-content-center keranjang-btn" style="border-radius:12px; font-weight:600;">
                            <img src="https://img.icons8.com/ios-filled/24/a47149/shopping-cart.png" alt="Keranjang" style="margin-right:8px;"> Keranjang
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- footer -->
    <footer class="text-center py-4" style="background: transparent ; color: rgba(8, 2, 41, 1); font-family: 'Quicksand', Arial, sans-serif; font-size: 1.1rem; box-shadow: none; border-top: none; margin-top: 3rem;">
            &copy; 2025 <strong style="color:orange; font-weight:1000;">Terass Coffee</strong> &mdash; All rights reserved
        </footer>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

