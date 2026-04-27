# 📚 Sistem Informasi Peminjaman Buku Sekolah (E-Library)

Aplikasi manajemen perpustakaan berbasis web sederhana yang dirancang untuk mengelola data master perpustakaan, transaksi peminjaman, hingga perhitungan denda otomatis.

---

## 🚀 Fitur Utama

- **Dashboard Dinamis:** Menampilkan statistik real-time (Total Buku, Siswa Aktif, Peminjaman, dan Denda).
- **Manajemen Master Data:** CRUD lengkap untuk data Siswa, Buku, dan Penerbit.
- **Logika Transaksi:** \* Pengurangan stok buku otomatis saat dipinjam.
  - Pengembalian stok buku otomatis saat dikembalikan.
  - Validasi siswa (hanya siswa berstatus 'Active' yang dapat meminjam).
- **Sistem Denda:** Perhitungan denda otomatis Rp 1.000/hari jika melewati tenggat waktu.
- **Detail Transaksi:** Halaman ringkasan transaksi yang dilengkapi dengan fitur cetak bukti.

---

## 🛠️ Teknologi yang Digunakan

- **Bahasa Pemrograman:** PHP 8.2 (Native)
- **Database:** MySQL / MariaDB
- **Framework UI:** Bootstrap 5.3
- **Server:** Laragon / Apache
- **Version Control:** Git & GitHub

---

## 📂 Struktur Folder

```text
project-peminjaman-buku/
├── config/             # Koneksi Database
├── modules/            # Modul Fungsional
│   ├── buku/           # CRUD Buku
│   ├── denda/          # Manajemen Denda
│   ├── peminjaman/     # Transaksi Pinjam & Kembali
│   ├── penerbit/       # CRUD Penerbit
│   └── siswa/          # CRUD Siswa
├── index.php           # Dashboard Utama
└── README.md           # Dokumentasi Project
```
