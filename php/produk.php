<?php

/**
 * Class ProdukElektronik
 * Representasi objek produk di toko elektronik.
 */
class ProdukElektronik {
    public $id;
    public $nama;
    public $merek;
    public $harga;
    public $gambar; // Atribut untuk path gambar lokal

    public function __construct($id, $nama, $merek, $harga, $gambar) {
        $this->id = $id;
        $this->nama = $nama;
        $this->merek = $merek;
        $this->harga = $harga;
        $this->gambar = $gambar;
    }
}