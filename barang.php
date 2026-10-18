<?php

class Barang {
    // A. REFACTOR: Membuat minimal 2 property menjadi private
    private string $Id_barang;
    private string $Nama;
    private float|int $Harga;
    private int $Stok;

    // Constructor untuk inisialisasi data awal
    public function __construct(string $Id_barang, string $Nama, int|float $Harga, int $Stok) {
        $this->Id_barang = $Id_barang;
        $this->Nama = $Nama;
        $this->setHarga($Harga); // Menggunakan setter agar tervalidasi
        $this->setStok($Stok);   // Menggunakan setter agar tervalidasi
    }

    // B. ACCESS: Getter dan Setter untuk mengakses serta mengubah data private
    public function getIdBarang(): string {
        return $this->Id_barang;
    }

    public function getNama(): string {
        return $this->Nama;
    }

    public function getHarga(): int|float {
        return $this->Harga;
    }

    public function getStok(): int {
        return $this->Stok;
    }

    // C. VALIDASI ATURAN 1: Harga tidak boleh negatif
    public function setHarga(int|float $Harga): void {
        if ($Harga < 0) {
            throw new InvalidArgumentException("Validasi Gagal: Harga barang tidak boleh bernilai negatif!");
        }
        $this->Harga = $Harga;
    }

    // C. VALIDASI ATURAN 2: Stok tidak boleh negatif
    public function setStok(int $Stok): void {
        if ($Stok < 0) {
            throw new InvalidArgumentException("Validasi Gagal: Stok barang tidak boleh bernilai negatif!");
        }
        $this->Stok = $Stok;
    }

    // Method Aksi / Operasional Barang
    public function cekStok(): void {
        echo "Info Stok -> Barang '{$this->Nama}' (ID: {$this->Id_barang}) saat ini: {$this->Stok} unit.<br>";
    }

    public function kurangiStok(int $jumlah): void {
        if ($jumlah > $this->Stok) {
            throw new RuntimeException("Validasi Gagal: Gagal mengurangi stok '{$this->Nama}'. Jumlah pengurangan ({$jumlah}) melebihi stok yang ada ({$this->Stok})!");
        }
        $this->Stok -= $jumlah;
        echo "Berhasil: Stok '{$this->Nama}' dikurangi {$jumlah}. Sisa stok: {$this->Stok} unit.<br>";
    }

    public function tambahStok(int $jumlah): void {
        $this->Stok += $jumlah;
        echo "Berhasil: Stok '{$this->Nama}' ditambah {$jumlah}. Total stok sekarang: {$this->Stok} unit.<br>";
    }

    public function updateHarga(int|float $hargaBaru): void {
        $hargaLama = $this->Harga;
        $this->setHarga($hargaBaru); // Memanfaatkan validasi setter harga
        echo "Berhasil: Harga '{$this->Nama}' diubah dari Rp " . number_format($hargaLama, 0, ',', '.') . " menjadi Rp " . number_format($this->Harga, 0, ',', '.') . ".<br>";
    }
}

// D. TEST: 4 Skenario Pengujian (Normal & Error)

echo "<h3> PENGUJIAN SKENARIO KELAS BARANG </h3>";

// Skenario 1: Pengujian Normal (Inisialisasi & Cek Data)
echo "<h4>Skenario 1: Inisialisasi Objek dan Cek Data (Normal)</h4>";
try {
    $barang1 = new Barang("BRG001", "Kopi Espresso", 18000, 50);
    echo "Objek berhasil dibuat.<br>";
    echo "Nama Barang: " . $barang1->getNama() . "<br>";
    echo "Harga Awal: Rp " . number_format($barang1->getHarga(), 0, ',', '.') . "<br>";
    $barang1->cekStok();
} catch (Exception $e) {
    echo "<b style='color:red;'>{$e->getMessage()}</b><br>";
}

echo "<br>";

// Skenario 2: Pengujian Operasi Aksi Normal (Tambah, Kurang Stok & Update Harga) 
echo "<h4>Skenario 2: Operasi Transaksi Stok dan Harga (Normal)</h4>";
try {
    $barang1->tambahStok(15);
    $barang1->kurangiStok(10);
    $barang1->updateHarga(20000);
} catch (Exception $e) {
    echo "<b style='color:red;'>{$e->getMessage()}</b><br>";
}

echo "<br>";

// Skenario 3: Pengujian Validasi Error (Input Harga Negatif) 
echo "<h4>Skenario 3: Validasi Input Harga Negatif (Error Handling)</h4>";
try {
    echo "Mencoba mengubah harga ke angka negatif (-5000)...<br>";
    $barang1->updateHarga(-5000);
} catch (Exception $e) {
    echo "<b style='color:red;'>[TERTANGKAP EXCEPTION] {$e->getMessage()}</b><br>";
}

echo "<br>";

// Skenario 4: Pengujian Validasi Error (Pengurangan Stok Melebihi Batas)
echo "<h4>Skenario 4: Validasi Pengurangan Stok Melebihi Kapasitas (Error Handling)</h4>";
try {
    $barang1->cekStok();
    echo "Mencoba mengurangi stok sebanyak 200 unit (melebihi stok saat ini)...<br>";
    $barang1->kurangiStok(200);
} catch (Exception $e) {
    echo "<b style='color:red;'>[TERTANGKAP EXCEPTION] {$e->getMessage()}</b><br>";
}

?>
