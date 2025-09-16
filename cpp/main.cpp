#include <iostream>
#include <vector>
#include "Produk.h"

using namespace std;

vector<Produk> daftar_produk = {
    Produk("P001", "Laptop Asus", 7500000, 10),
    Produk("P002", "Smartphone Samsungg", 4500000, 15),
    Produk("P003", "TV LG 42inch", 5200000, 5),
    Produk("P004", "Kulkas Sharp", 3100000, 7)
};

void tambahData() {
    string id, nama;
    double harga;
    int stok;

    cout << "Masukkan ID Produk: "; cin >> id;
    cout << "Masukkan Nama Produk: "; cin.ignore(); getline(cin, nama);
    cout << "Masukkan Harga Produk: "; cin >> harga;
    cout << "Masukkan Stok Produk: "; cin >> stok;

    daftar_produk.push_back(Produk(id, nama, harga, stok));
    cout << "Data berhasil ditambahkan!\n\n";
}

void tampilkanData() {
    if (daftar_produk.empty()) {
        cout << "Belum ada data produk.\n\n";
    } else {
        for (auto &produk : daftar_produk) {
            produk.tampilkanInfo();
        }
    }
}

void updateData() {
    string id;
    cout << "Masukkan ID Produk yang akan diupdate: ";
    cin >> id;

    for (auto &produk : daftar_produk) {
        if (produk.getIdProduk() == id) {
            string nama;
            double harga;
            int stok;

            cout << "Nama baru: "; cin.ignore(); getline(cin, nama);
            cout << "Harga baru: "; cin >> harga;
            cout << "Stok baru: "; cin >> stok;

            produk.setNama(nama);
            produk.setHarga(harga);
            produk.setStok(stok);

            cout << "Data berhasil diupdate!\n\n";
            return;
        }
    }
    cout << "Produk tidak ditemukan.\n\n";
}

void hapusData() {
    string id;
    cout << "Masukkan ID Produk yang akan dihapus: ";
    cin >> id;

    for (int i = 0; i < daftar_produk.size(); i++) {
        if (daftar_produk[i].getIdProduk() == id) {
            daftar_produk.erase(daftar_produk.begin() + i);
            cout << "Data berhasil dihapus!\n\n";
            return;
        }
    }
    cout << "Produk tidak ditemukan.\n\n";
}

void cariData() {
    string id;
    cout << "Masukkan ID Produk yang dicari: ";
    cin >> id;

    for (auto &produk : daftar_produk) {
        if (produk.getIdProduk() == id) {
            cout << "Produk ditemukan:\n";
            produk.tampilkanInfo();
            return;
        }
    }
    cout << "Produk tidak ditemukan.\n\n";
}

int main() {
    int pilihan;

    while (true) {
        cout << "=== Menu Toko Elektronik ===" << endl;
        cout << "1. Tambah Data" << endl;
        cout << "2. Tampilkan Data" << endl;
        cout << "3. Update Data" << endl;
        cout << "4. Hapus Data" << endl;
        cout << "5. Cari Data" << endl;
        cout << "0. Keluar" << endl;
        cout << "Pilih menu: ";
        cin >> pilihan;

        switch (pilihan) {
            case 1: tambahData(); break;
            case 2: tampilkanData(); break;
            case 3: updateData(); break;
            case 4: hapusData(); break;
            case 5: cariData(); break;
            case 0: cout << "Terima kasih, program selesai." << endl; return 0;
            default: cout << "Pilihan tidak valid.\n\n"; break;
        }
    }
}
