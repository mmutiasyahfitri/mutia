<form action="" method="post" onsubmit="return confirm('Yakin ingin menghapus produk ini dari keranjang?');">
                            <input type="hidden" name="id_produk" value="<?php echo htmlspecialchars($id_produk); ?>">
                            <button type="submit" name="remove_from_cart">Hapus</button>
                        </form>