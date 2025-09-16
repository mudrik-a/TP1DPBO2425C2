<?php
// Perbaikan: Memuat (require) file yang berisi definisi class terlebih dahulu
require_once 'Produk.php';

// Mulai session setelah class dimuat
session_start();

// Data dummy untuk inisialisasi awal
if (!isset($_SESSION['produk_list']) || empty($_SESSION['produk_list'])) {
    $_SESSION['produk_list'] = [
        new ProdukElektronik(1, 'Laptop Gaming ASUS', 'ASUS', 15000000.00, 'images/laptop_asus.jpg'),
        new ProdukElektronik(2, 'Smartphone Galaxy A52', 'Samsung', 4500000.00, 'images/hp_samsung.jpg'),
        new ProdukElektronik(3, 'Smart TV 50 inch', 'LG', 7000000.00, 'images/tv_lg.jpg'),
        new ProdukElektronik(4, 'Headphone Bluetooth Noise Cancelling', 'Sony', 2800000.00, 'images/headphone_sony.jpg'),
        new ProdukElektronik(5, 'Mouse Wireless MX Master 3', 'Logitech', 1200000.00, 'images/mouse_logitech.jpg')
    ];
}


// Fungsi-fungsi CRUD
function tambahProduk($produk) {
    foreach ($_SESSION['produk_list'] as $item) {
        if ($item->id == $produk->id) {
            return "ID produk sudah ada. Mohon gunakan ID lain.";
        }
    }
    $_SESSION['produk_list'][] = $produk;
    return "Produk berhasil ditambahkan!";
}

function updateProduk($id, $data_baru) {
    foreach ($_SESSION['produk_list'] as $key => $produk) {
        if ($produk->id == $id) {
            $_SESSION['produk_list'][$key] = new ProdukElektronik(
                $data_baru['id'],
                $data_baru['nama'],
                $data_baru['merek'],
                $data_baru['harga'],
                $data_baru['gambar']
            );
            return "Produk berhasil diperbarui!";
        }
    }
    return "Produk dengan ID $id tidak ditemukan.";
}

function hapusProduk($id) {
    foreach ($_SESSION['produk_list'] as $key => $produk) {
        if ($produk->id == $id) {
            unset($_SESSION['produk_list'][$key]);
            $_SESSION['produk_list'] = array_values($_SESSION['produk_list']);
            return "Produk berhasil dihapus!";
        }
    }
    return "Produk dengan ID $id tidak ditemukan.";
}

function cariProduk($id) {
    foreach ($_SESSION['produk_list'] as $produk) {
        if ($produk->id == $id) {
            return $produk;
        }
    }
    return null;
}

// Handle request dari form
$pesan = '';
$produk_cari = null;
$mode_update = false;
$produk_edit = null;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action'])) {
    $action = $_POST['action'];

    switch ($action) {
        case 'tambah':
            $id = $_POST['id'];
            $nama = $_POST['nama'];
            $merek = $_POST['merek'];
            $harga = $_POST['harga'];
            $gambar = $_POST['gambar']; // Mengambil path dari input teks

            if (empty($gambar)) {
                $pesan = "Path gambar tidak boleh kosong.";
                break;
            }

            $produk_baru = new ProdukElektronik($id, $nama, $merek, $harga, $gambar);
            $pesan = tambahProduk($produk_baru);
            break;

        case 'update':
            $id_update = $_POST['id_update'];
            $data_baru = [
                'id' => $_POST['id'],
                'nama' => $_POST['nama'],
                'merek' => $_POST['merek'],
                'harga' => $_POST['harga'],
                'gambar' => $_POST['gambar'] // Mengambil path gambar baru
            ];
            
            $pesan = updateProduk($id_update, $data_baru);
            break;

        case 'hapus':
            $id_hapus = $_POST['id_hapus'];
            $pesan = hapusProduk($id_hapus);
            break;

        case 'cari':
            $id_cari = $_POST['id_cari'];
            $produk_cari = cariProduk($id_cari);
            if ($produk_cari) {
                $pesan = "Produk dengan ID $id_cari ditemukan.";
            } else {
                $pesan = "Produk dengan ID $id_cari tidak ditemukan.";
            }
            break;

        case 'edit':
            $id_edit = $_POST['id_edit'];
            $produk_edit = cariProduk($id_edit);
            if ($produk_edit) {
                $mode_update = true;
            }
            break;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Produk Elektronik</title>
    <style>/* Gaya dasar untuk tata letak sederhana */
        body { font-family: Arial, sans-serif; margin: 20px; }
        .container { max-width: 900px; margin: auto; }
        .form-section, .data-section { border: 1px solid #ccc; padding: 20px; margin-bottom: 20px; border-radius: 5px; }
        .form-section h2, .data-section h2 { margin-top: 0; }
        table { width: 100%; border-collapse: collapse; }
        table, th, td { border: 1px solid #ccc; }
        th, td { padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .btn { padding: 5px 10px; text-decoration: none; border-radius: 3px; cursor: pointer; }
        .btn-edit { background-color: #4CAF50; color: white; border: none; }
        .btn-delete { background-color: #f44336; color: white; border: none; }
        .btn-submit { background-color: #008CBA; color: white; border: none; }
        .btn-reset { background-color: #e7e7e7; color: black; border: none; }
        .message { padding: 10px; background-color: #dff0d8; color: #3c763d; border: 1px solid #d6e9c6; border-radius: 4px; margin-bottom: 15px; }
        .image-thumb { max-width: 100px; max-height: 100px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Manajemen Produk Elektronik</h1>
        
        <?php if ($pesan): ?>
            <div class="message"><?= $pesan ?></div>
        <?php endif; ?>

        <div class="form-section">
            <h2><?= $mode_update ? 'Update Data Produk' : 'Tambah Produk Baru' ?></h2>
            <form action="" method="post">
                <input type="hidden" name="action" value="<?= $mode_update ? 'update' : 'tambah' ?>">
                <?php if ($mode_update && $produk_edit): ?>
                    <input type="hidden" name="id_update" value="<?= htmlspecialchars($produk_edit->id) ?>">
                <?php endif; ?>
                
                <p>ID Produk: <br><input type="text" name="id" value="<?= $mode_update ? htmlspecialchars($produk_edit->id) : '' ?>" <?= $mode_update ? 'readonly' : 'required' ?>></p>
                <p>Nama Produk: <br><input type="text" name="nama" value="<?= $mode_update ? htmlspecialchars($produk_edit->nama) : '' ?>" required></p>
                <p>Merek: <br><input type="text" name="merek" value="<?= $mode_update ? htmlspecialchars($produk_edit->merek) : '' ?>" required></p>
                <p>Harga: <br><input type="number" name="harga" step="0.01" value="<?= $mode_update ? htmlspecialchars($produk_edit->harga) : '' ?>" required></p>
                <p>Path Gambar: <br><input type="text" name="gambar" value="<?= $mode_update ? htmlspecialchars($produk_edit->gambar) : '' ?>" placeholder="contoh: images/nama_gambar.jpg" required></p>
                <?php if ($mode_update && $produk_edit && $produk_edit->gambar): ?>
                    <p>Gambar saat ini:<br><img src="<?= htmlspecialchars($produk_edit->gambar) ?>" alt="Gambar Produk" class="image-thumb"></p>
                <?php endif; ?>

                <button type="submit" class="btn btn-submit"><?= $mode_update ? 'Update' : 'Tambah' ?></button>
                <?php if ($mode_update): ?>
                    <a href="index.php" class="btn btn-reset">Batal</a>
                <?php endif; ?>
            </form>
        </div>

        <div class="form-section">
            <h2>Cari Produk</h2>
            <form action="" method="post">
                <input type="hidden" name="action" value="cari">
                <p>ID Produk: <br><input type="text" name="id_cari" required></p>
                <button type="submit" class="btn btn-submit">Cari</button>
            </form>
            <?php if ($produk_cari): ?>
                <h3>Hasil Pencarian:</h3>
                <p>ID: <?= htmlspecialchars($produk_cari->id ?? '') ?></p>
                <p>Nama: <?= htmlspecialchars($produk_cari->nama ?? '') ?></p>
                <p>Merek: <?= htmlspecialchars($produk_cari->merek ?? '') ?></p>
                <p>Harga: Rp <?= number_format($produk_cari->harga ?? 0, 2, ',', '.') ?></p>
                <p>Gambar: <br><img src="<?= htmlspecialchars($produk_cari->gambar ?? '') ?>" alt="Gambar Produk" class="image-thumb"></p>
            <?php endif; ?>
        </div>

        <div class="data-section">
            <h2>Daftar Produk</h2>
            <?php if (empty($_SESSION['produk_list'])): ?>
                <p>Belum ada data produk.</p>
            <?php else: ?>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Gambar</th>
                            <th>Nama</th>
                            <th>Merek</th>
                            <th>Harga</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($_SESSION['produk_list'] as $produk): ?>
                            <tr>
                                <td><?= htmlspecialchars($produk->id ?? '') ?></td>
                                <td><img src="<?= htmlspecialchars($produk->gambar ?? '') ?>" alt="Gambar Produk" class="image-thumb"></td>
                                <td><?= htmlspecialchars($produk->nama ?? '') ?></td>
                                <td><?= htmlspecialchars($produk->merek ?? '') ?></td>
                                <td>Rp <?= number_format($produk->harga ?? 0, 2, ',', '.') ?></td>
                                <td>
                                    <form action="" method="post" style="display:inline;">
                                        <input type="hidden" name="action" value="edit">
                                        <input type="hidden" name="id_edit" value="<?= htmlspecialchars($produk->id ?? '') ?>">
                                        <button type="submit" class="btn btn-edit">Edit</button>
                                    </form>
                                    <form action="" method="post" style="display:inline;">
                                        <input type="hidden" name="action" value="hapus">
                                        <input type="hidden" name="id_hapus" value="<?= htmlspecialchars($produk->id ?? '') ?>">
                                        <button type="submit" class="btn btn-delete" onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>