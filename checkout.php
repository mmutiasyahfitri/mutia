<?php
session_start();
include 'config.php'; // Menghubungkan ke database

// Menghapus item dari keranjang
if (isset($_POST['remove_from_cart'])) {
    $id_produk = $_POST['id_produk'];

    // Cek apakah produk ada di keranjang
    if (isset($_SESSION['keranjang'][$id_produk])) {
        $jumlah_produk = $_SESSION['keranjang'][$id_produk];

        // Hapus produk dari keranjang
        unset($_SESSION['keranjang'][$id_produk]);

        if ($jumlah_produk == 1) {
            header("Location: checkout.php");
            exit();
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>coffee</title>

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


     <link href="bootstrap/bootstrap-5.3.7-dist.zip" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />

</head> 


<div class="wrapper-hero">
     


    <!-- Section Services -->
<div class="row container mx-auto py-5 my-5 services justify-content-center">
        <div class="col-12 mt-2">
          <!-- <h4>Our Food</h4> -->
          <h3 align ="left"><b>Keranjang Belanja</b></h3>
        </div>
        

        <table class="content-table1 table-hover table-striped table-hover table">
          <thead>

          <tr>
            <th>No</th>
            <th>Nama Produk</th>
            <th>Jumlah</th>
            <th>Harga</th>
            <th>Aksi</th>
          </tr>
          </thead>

          <tbody>
             <?php 
                $no = 1;
                $total_keranjang = 0; // Inisialisasi total keranjang
                foreach ($_SESSION['keranjang'] as $id_produk => $jumlah): 
                    // Ambil nama produk dari database
                    $stmt = $conn->prepare("SELECT nama_produk, harga FROM tb_produk WHERE id_produk = ?");
                    $stmt->bind_param("i", $id_produk);
                    $stmt->execute();
                    $result_produk = $stmt->get_result();
            
                    if ($result_produk->num_rows > 0) {
                        $produk = $result_produk->fetch_assoc();
                        $subtotal = $produk['harga'] * $jumlah; // Hitung subtotal
                        $total_keranjang += $subtotal; // Tambahkan ke total keranjang
                    } else {
                        continue; // Jika produk tidak ditemukan, lanjutkan ke iterasi berikutnya
                    }
            ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo htmlspecialchars($produk['nama_produk']); ?></td>
                    <td><?php echo $jumlah; ?></td>
                    <td>Rp.<?php echo number_format($produk['harga'] * $jumlah, 0, ',', '.'); ?> </td>
                    <td>
                        <form action="" method="post" onsubmit="return confirm('Yakin ingin menghapus produk ini dari keranjang?');"">
                            <input type="hidden" name="id_produk" value="<?php echo htmlspecialchars($id_produk); ?>">
                            <button type="submit" name="remove_from_cart">Hapus</button>
                        </form>
                    </td>
                </tr>
                 <?php endforeach; ?>
                <tr>
                    <td colspan="3"><strong>Total Keseluruhan:</strong></td>
                    <td colspan="2">Rp. <?php echo number_format($total_keranjang, 0, ',', '.'); ?></td> <!-- Tampilkan total keranjang -->
                </tr>
            </tbody>
        </table>

        <div align="right">
    <form id="form-wa" onsubmit="pesanWA(); return false;" class="mb-3">
        <input type="text" id="nama_pemesan" class="form-control mb-2" placeholder="Nama Pemesan" required>
        <input type="text" id="alamat_pemesan" class="form-control mb-2" placeholder="Alamat Pemesan" required>
        <a class="btn btn-md order3 ms-3" href="cart.php">Lanjutkan Belanja</a>
        <button type="submit" class="btn btn-success ms-2">
            <img src="https://img.icons8.com/ios-filled/18/ffffff/whatsapp.png" style="margin-bottom:3px; margin-right:4px;">Pesan via WhatsApp
        </button>
    </form>
    <script>
function pesanWA() {
    var namaPemesan = document.getElementById('nama_pemesan').value.trim();
    var alamatPemesan = document.getElementById('alamat_pemesan').value.trim();
    var produk = [];
    var rows = document.querySelectorAll('table tbody tr');
    rows.forEach(function(row) {
        var nama = row.cells[1]?.innerText?.trim();
        var jumlah = row.cells[2]?.innerText?.trim();
        var harga = row.cells[3]?.innerText?.trim();
        if(nama && jumlah && harga) {
            produk.push('Produk: ' + nama + '\nJumlah: ' + jumlah + '\nHarga: ' + harga);
        }
    });
    var total = '';
    var totalRow = document.querySelector('table tbody tr:last-child td[colspan="2"]');
    if(totalRow) total = totalRow.innerText.trim();
    var pesan = 'Halo, saya ingin memesan:\nNama: ' + namaPemesan + '\nAlamat: ' + alamatPemesan + '\n' + produk.join('\n---\n') + '\n' + total;
    var waUrl = 'https://wa.me/6282276684455?text=' + encodeURIComponent(pesan);
    window.open(waUrl, '_blank');
}
</script>
        </div>
        
        
    </div>  
</div>
<!-- End Section Services -->
</div>

<!-- Bootstrap JS -->
<script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    </body>
</html>