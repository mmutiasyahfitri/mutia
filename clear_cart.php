<?php
session_start();
unset($_SESSION['keranjang']); // Kosongkan keranjang
header('Location: checkout.php'); // Redirect kembali ke halaman checkout
exit;
