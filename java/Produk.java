public class Produk {
    private String idProduk;
    private String nama;
    private double harga;
    private int stok;

    // Constructor
    public Produk(String idProduk, String nama, double harga, int stok) {
        this.idProduk = idProduk;
        this.nama = nama;
        this.harga = harga;
        this.stok = stok;
    }

    // Getter
    public String getIdProduk() {
        return idProduk;
    }

    public String getNama() {
        return nama;
    }

    public double getHarga() {
        return harga;
    }

    public int getStok() {
        return stok;
    }

    // Setter
    public void setNama(String nama) {
        this.nama = nama;
    }

    public void setHarga(double harga) {
        this.harga = harga;
    }

    public void setStok(int stok) {
        this.stok = stok;
    }

    // Method tampil data
    public void tampilkanInfo() {
        System.out.println("ID: " + idProduk);
        System.out.println("Nama: " + nama);
        System.out.println("Harga: " + (long) harga); // biar ga pakai notasi ilmiah
        System.out.println("Stok: " + stok);
        System.out.println("-----------------------------");
    }
}
