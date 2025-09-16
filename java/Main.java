import java.util.ArrayList;
import java.util.Scanner;


public class Main {
    static ArrayList<Produk> daftarProduk = new ArrayList<>();

    // Dummy data
    static {
        daftarProduk.add(new Produk("P001", "Laptop Asus", 7500000, 10));
        daftarProduk.add(new Produk("P002", "Smartphone Samsung", 4500000, 15));
        daftarProduk.add(new Produk("P003", "TV LG 42inch", 5200000, 5));
        daftarProduk.add(new Produk("P004", "Kulkas Sharp", 3100000, 7));
    }

    public static void tambahData(Scanner sc) {
        System.out.print("Masukkan ID Produk: ");
        String id = sc.nextLine();
        System.out.print("Masukkan Nama Produk: ");
        String nama = sc.nextLine();
        System.out.print("Masukkan Harga Produk: ");
        double harga = sc.nextDouble();
        System.out.print("Masukkan Stok Produk: ");
        int stok = sc.nextInt();
        sc.nextLine(); // buang newline

        daftarProduk.add(new Produk(id, nama, harga, stok));
        System.out.println("Data berhasil ditambahkan!\n");
    }

    public static void tampilkanData() {
        if (daftarProduk.isEmpty()) {
            System.out.println("Belum ada data produk.\n");
        } else {
            for (Produk p : daftarProduk) {
                p.tampilkanInfo();
            }
        }
    }

    public static void updateData(Scanner sc) {
        System.out.print("Masukkan ID Produk yang akan diupdate: ");
        String id = sc.nextLine();

        for (Produk p : daftarProduk) {
            if (p.getIdProduk().equals(id)) {
                System.out.print("Nama baru: ");
                String nama = sc.nextLine();
                System.out.print("Harga baru: ");
                double harga = sc.nextDouble();
                System.out.print("Stok baru: ");
                int stok = sc.nextInt();
                sc.nextLine(); // buang newline

                p.setNama(nama);
                p.setHarga(harga);
                p.setStok(stok);

                System.out.println("Data berhasil diupdate!\n");
                return;
            }
        }
        System.out.println("Produk tidak ditemukan.\n");
    }

    public static void hapusData(Scanner sc) {
        System.out.print("Masukkan ID Produk yang akan dihapus: ");
        String id = sc.nextLine();

        for (int i = 0; i < daftarProduk.size(); i++) {
            if (daftarProduk.get(i).getIdProduk().equals(id)) {
                daftarProduk.remove(i);
                System.out.println("Data berhasil dihapus!\n");
                return;
            }
        }
        System.out.println("Produk tidak ditemukan.\n");
    }

    public static void cariData(Scanner sc) {
        System.out.print("Masukkan ID Produk yang dicari: ");
        String id = sc.nextLine();

        for (Produk p : daftarProduk) {
            if (p.getIdProduk().equals(id)) {
                System.out.println("Produk ditemukan:");
                p.tampilkanInfo();
                return;
            }
        }
        System.out.println("Produk tidak ditemukan.\n");
    }

    public static void main(String[] args) {
        Scanner sc = new Scanner(System.in);
        while (true) {
            System.out.println("=== Menu Toko Elektronik ===");
            System.out.println("1. Tambah Data");
            System.out.println("2. Tampilkan Data");
            System.out.println("3. Update Data");
            System.out.println("4. Hapus Data");
            System.out.println("5. Cari Data");
            System.out.println("0. Keluar");
            System.out.print("Pilih menu: ");

            int pilihan = sc.nextInt();
            sc.nextLine(); // buang newline

            switch (pilihan) {
                case 1: tambahData(sc); break;
                case 2: tampilkanData(); break;
                case 3: updateData(sc); break;
                case 4: hapusData(sc); break;
                case 5: cariData(sc); break;
                case 0:
                    System.out.println("Terima kasih, program selesai.");
                    sc.close();
                    return;
                default:
                    System.out.println("Pilihan tidak valid.\n");
            }
        }
    }
}
