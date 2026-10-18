Praktikum PBO P4 - Encapsulation & Refactoring

Tugas PBO Pertemuan 4: Menerapkan Encapsulation dan Refactoring pada class Barang.

Ringkasan Refactoring

Private Properties: Mengubah atribut ($Id_barang, $Nama, $Harga, $Stok) dari public menjadi private.

Getter & Setter: Menambahkan method akses getIdBarang(), getNama(), getHarga(), getStok(), serta setter setHarga() dan setStok().

Validasi State:

Harga: Tidak boleh negatif (< 0).

Stok: Tidak boleh negatif (< 0) dan pengurangan stok tidak boleh melebihi stok yang ada.

Skenario Pengujian

Normal: Inisialisasi objek, cek stok, tambah stok, kurangi stok, dan update harga.

Error 1: Mencoba update harga dengan nilai negatif (-5000).

Error 2: Mencoba mengurangi stok melebihi batas ketersediaan (200 unit dari stok 55).
