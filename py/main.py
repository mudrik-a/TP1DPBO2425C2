from produk import Produk

# Array/list untuk menyimpan objek produk
daftar_produk = [
    Produk("P001", "Laptop Asus", 7500000, 10),
    Produk("P002", "Smartphone Samsung", 4500000, 15),
    Produk("P003", "TV LG 42inch", 5200000, 5),
    Produk("P004", "Kulkas Sharp", 3100000, 7)
]
# method untuk menambah
def tambah_data():
    id_produk = input("Masukkan ID Produk: ")
    nama = input("Masukkan Nama Produk: ")
    harga = float(input("Masukkan Harga Produk: "))
    stok = int(input("Masukkan Stok Produk: "))

    produk = Produk(id_produk, nama, harga, stok)
    daftar_produk.append(produk)
    print("Data berhasil ditambahkan!\n")
# method untuk menampilkan
def tampilkan_data():
    if not daftar_produk:
        print("Belum ada data produk.\n")
    else:
        for produk in daftar_produk:
            produk.tampilkan_info()
# method untuk mengupdate
def update_data():
    id_produk = input("Masukkan ID Produk yang akan diupdate: ")
    for produk in daftar_produk:
        if produk.get_id_produk() == id_produk:
            nama = input("Nama baru: ")
            harga = float(input("Harga baru: "))
            stok = int(input("Stok baru: "))

            produk.set_nama(nama)
            produk.set_harga(harga)
            produk.set_stok(stok)

            print("Data berhasil diupdate!\n")
            return
    print("Produk tidak ditemukan.\n")
# method untuk menghapus
def hapus_data():
    id_produk = input("Masukkan ID Produk yang akan dihapus: ")
    for produk in daftar_produk:
        if produk.get_id_produk() == id_produk:
            daftar_produk.remove(produk)
            print("Data berhasil dihapus!\n")
            return
    print("Produk tidak ditemukan.\n")
# method untuk mencari
def cari_data():
    id_produk = input("Masukkan ID Produk yang dicari: ")
    for produk in daftar_produk:
        if produk.get_id_produk() == id_produk:
            print("Produk ditemukan:")
            produk.tampilkan_info()
            return
    print("Produk tidak ditemukan.\n")

# Menu utama
while True:
    print("=== Menu Toko Elektronik ===")
    print("1. Tambah Data")
    print("2. Tampilkan Data")
    print("3. Update Data")
    print("4. Hapus Data")
    print("5. Cari Data")
    print("0. Keluar")

    pilihan = input("Pilih menu: ")

    if pilihan == "1":
        tambah_data()
    elif pilihan == "2":
        tampilkan_data()
    elif pilihan == "3":
        update_data()
    elif pilihan == "4":
        hapus_data()
    elif pilihan == "5":
        cari_data()
    elif pilihan == "0":
        print("Terima kasih, program selesai.")
        break
    else:
        print("Pilihan tidak valid.\n")
