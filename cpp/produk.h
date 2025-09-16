
#include <iostream>
#include <string>
#include <iomanip>
using namespace std;

class Produk {
private:
    string id_produk;
    string nama;
    double harga;
    int stok;

public:
    // Constructor
    Produk(string id_produk, string nama, double harga, int stok) {
        this->id_produk = id_produk;
        this->nama = nama;
        this->harga = harga;
        this->stok = stok;
    }

    // Getter
    string getIdProduk() { return id_produk; }
    string getNama() { return nama; }
    double getHarga() { return harga; }
    int getStok() { return stok; }

    // Setter
    void setNama(string nama) { this->nama = nama; }
    void setHarga(double harga) { this->harga = harga; }
    void setStok(int stok) { this->stok = stok; }

    // Method tampil data
    void tampilkanInfo() {
        cout << "ID: " << id_produk << endl;
        cout << "Nama: " << nama << endl;
        cout << "Harga: " << fixed << setprecision(0) << harga << endl;
        cout << "Stok: " << stok << endl;
        cout << "-----------------------------" << endl;
    }
};
