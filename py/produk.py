class Produk:
    def __init__(self, id_produk, nama, harga, stok):
        self.__id_produk = id_produk
        self.__nama = nama
        self.__harga = harga
        self.__stok = stok

    # Getter
    def get_id_produk(self): return self.__id_produk
    def get_nama(self): return self.__nama
    def get_harga(self): return self.__harga
    def get_stok(self): return self.__stok

    # Setter
    def set_nama(self, nama): self.__nama = nama
    def set_harga(self, harga): self.__harga = harga
    def set_stok(self, stok): self.__stok = stok

    # Method tampil data
    def tampilkan_info(self):
        print(f"ID: {self.__id_produk}")
        print(f"Nama: {self.__nama}")
        print(f"Harga: {self.__harga}")
        print(f"Stok: {self.__stok}")
        print("-" * 30)
