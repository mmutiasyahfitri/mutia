<?php
session_start();
include 'config.php'; // Menghubungkan ke database

// Inisialisasi jika ada yang belum login atau bukan user
if (!isset($_SESSION['username']) || $_SESSION['role_id'] != 2) {
    header("Location: login.php");
    exit;
}


// Inisialisasi keranjang jika belum ada
if (!isset($_SESSION['keranjang'])) {
    $_SESSION['keranjang'] = [];
}

// Menambahkan produk ke keranjang
if (isset($_POST['add_to_cart'])) {
    if (!isset($_SESSION['username'])) {
        echo json_encode(['status' => 'error', 'message' => 'Anda harus login terlebih dahulu untuk melakukan pembelian.']);
        exit;
    }

    $id_produk = $_POST['id_produk'];
    $jumlah = isset($_POST['jumlah']) ? (int)$_POST['jumlah'] : 1; // Default ke 1 jika tidak ada

    // Tambahkan produk ke keranjang
    if (isset($_SESSION['keranjang'][$id_produk])) {
        $_SESSION['keranjang'][$id_produk] += $jumlah; // Tambahkan jumlah
    } else {
        $_SESSION['keranjang'][$id_produk] = $jumlah; // Tambah produk baru
    }
}

// Ambil kategori dari URL jika ada
$kategori = isset($_GET['kategori']) ? $_GET['kategori'] : 'all';

// Ambil kata kunci dari input pencarian
$keyword = isset($_POST['keyword']) ? $_POST['keyword'] : '';

// Mengambil produk dari database berdasarkan kategori dan keyword
if ($kategori == 'all') {
    if (!empty($keyword)) {
        $sql = "SELECT * FROM tb_produk WHERE nama_produk LIKE '%$keyword%'";
    } else {
        $sql = "SELECT * FROM tb_produk";
    }
} else {
    if (!empty($keyword)) {
        $sql = "SELECT * FROM tb_produk WHERE jenis = '$kategori' AND nama_produk LIKE '%$keyword%'";
    } else {
        $sql = "SELECT * FROM tb_produk WHERE jenis = '$kategori'";
    }
}
$result = $conn->query($sql);

// Hitung total produk dalam keranjang
$total_produk = array_sum($_SESSION['keranjang']);

// Cek apakah ada produk yang ditemukan
$produk_ditemukan = $result->num_rows > 0;
?>


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f8f5f2;
        }
        .cart-title {
            font-family: 'Segoe Script', 'Pacifico', cursive;
            color: #a47149;
            text-align: center;
            margin: 2rem 0 2rem 0;
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
            height: 140px;
            object-fit: cover;
            border-top-left-radius: 18px;
            border-top-right-radius: 18px;
        }
        .btn-coffee {
            background: #a47149;
            color: #fff;
            border: none;
            border-radius: 10px;
            font-weight: bold;
            transition: background 0.2s;
        }
        .btn-coffee:hover {
            background: #6d4c2b;
        }
        /* Responsif tombol pojok kanan atas */
        .header-action-btns {
            display: flex;
            gap: 0.5rem;
            position: absolute;
            top: 1.5rem;
            right: 1.5rem;
            z-index: 10;
        }
        @media (max-width: 991.98px) {
            .header-action-btns {
                top: 1rem;
                right: 1rem;
            }
        }
        @media (max-width: 767.98px) {
            .header-action-btns {
                flex-direction: column;
                align-items: stretch;
                position: static;
                margin-bottom: 1rem;
            }
            .header-action-btns .btn {
                width: 100%;
                justify-content: center;
            }
        }
        /* Responsive tweaks */
        @media (max-width: 991.98px) {
            .cart-title {
                font-size: 1.7rem;
                margin: 1.2rem 0 1.2rem 0;
            }
        }
        @media (max-width: 767.98px) {
            .cart-title {
                font-size: 1.3rem;
                margin: 1rem 0 1rem 0;
            }
            .card-img-top {
                height: 110px;
            }
            .btn-coffee {
                font-size: 0.95rem;
                padding: 6px 10px;
            }
            .position-absolute.top-0.end-0.mt-3.me-2.d-flex.gap-2 {
                flex-direction: column;
                gap: 0.5rem !important;
                right: 0.5rem !important;
                top: 0.5rem !important;
            }
        }
        @media (max-width: 575.98px) {
            .cart-title {
                font-size: 1.1rem;
            }
            .card-img-top {
                height: 90px;
            }
            .btn-coffee {
                font-size: 0.9rem;
                padding: 5px 8px;
            }
            .card-title {
                font-size: 1rem;
            }
            .card-text {
                font-size: 0.95rem;
            }
            .fw-bold.text-success {
                font-size: 1rem !important;
            }
            .form-control.fs-5 {
                font-size: 1rem !important;
                height: 32px !important;
            }
        }
    </style>
</head>
<body>

    <div class="container position-relative">
        <!--untukkembali kehalamn awal-->
        <div class="header-action-btns">
            <a href="proseslogin.php" class="btn btn-outline-secondary d-flex align-items-center" style="font-weight:600; border-radius:20px;">
                <img src="https://img.icons8.com/ios-filled/20/7d4c2b/circled-left-2.png" alt="Kembali" style="vertical-align:middle; margin-right:6px;"> Kembali
            </a>
            <a href="checkout.php" id="cartIcon" class="btn btn-warning d-flex align-items-center" style="font-weight:600; border-radius:20px;">
                <img src="https://img.icons8.com/ios-filled/22/a47149/shopping-cart-loaded.png" alt="Checkout" style="vertical-align:middle; margin-right:6px;"> Checkout 
                 <?php if ($total_produk > 0): ?>
            <span class="jumlah-produk"><?php echo $total_produk; ?></span>
        <?php endif; ?>
            </a>
        </div>

        <h1 class="cart-title">Keranjang Belanja</h1>
        <!--untuk layar agar responsif pakai row-cols-sm-2-->
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
        <!--untuk menampilkan produk yang ada di dalam keranjang-->
            <?php 
            if ($produk_ditemukan): 
            while ($row = $result->fetch_assoc()): ?>
            <div class="col">
                <div class="card h-100">
                    <img src="<?php echo htmlspecialchars($row['gambar']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($row['nama_produk']); ?>">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title"><?php echo htmlspecialchars($row['nama_produk']); ?></h5>
                        <p class="card-text"><?php echo htmlspecialchars($row['deskripsi']); ?></p>
                        <div class="d-flex align-items-center justify-content-between mt-auto gap-2">
                            <span class="fw-bold text-success" style="font-size:1.1rem;">Rp. <?php echo number_format($row['harga'], 0, ',','.') ?></span>
                            <!--untuk jumlah pesanan-->
                            <div style="width: 60px;">
                                <form action="" class="sub" method="post">
                                    <input type="hidden" name="id_produk" value="<?php echo htmlspecialchars($row['id_produk']); ?>">
                                    <input type="number" class="form-control text-center fw-bold fs-5" style="width:100%; height:38px; padding:0 2px; font-size:1.2rem;" name="jumlah" value="1" min="1" id="jumlah-<?php echo htmlspecialchars($row['id_produk']); ?>">
                                </form>
                            </div>
                            <form action="" method="post">
                                <input type="hidden" name="id_produk" value="<?php echo htmlspecialchars($row['id_produk']); ?>">
                                <input type="hidden" name="jumlah" value="1" id="hidden-jumlah-<?php echo htmlspecialchars($row['id_produk']); ?>">
                                <button class="btn btn-coffee btn-sm" type="submit" name="add_to_cart" onclick="setJumlah(<?php echo htmlspecialchars($row['id_produk']); ?>)">Tambah ke Keranjang</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
            <?php else: ?>
            <h3 colspan="6" class="text-center">Produk tidak ditemukan.</h3>
            <?php endif; ?>
        </div>
    </div>

<script>
function setJumlah(id_produk) {
    var jumlah = document.getElementById('jumlah-' + id_produk).value;
    document.getElementById('hidden-jumlah-' + id_produk).value = jumlah;
}

document.getElementById('cartIcon').addEventListener('click', function(event) {
    <?php if ($total_produk == 0): ?>
        event.preventDefault(); // Mencegah navigasi ke halaman keranjang
        alert('Keranjang Anda masih kosong!'); // Menampilkan notifikasi
    <?php endif; ?>
});
</script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
