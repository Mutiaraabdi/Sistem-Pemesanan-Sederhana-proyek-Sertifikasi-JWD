

MEMPHIS FRIED CHICKEN - APLIKASI PEMESANAN SEDERHANA (Proyek Sertifikasi Junior Web Developer)

Aplikasi web sederhana ini dibuat untuk memenuhi pembuatan sistem pemesanan dan perhitungan harga produk di sebuah usaha kecil yaitu Memphis Fried Chicken.

FITUR APLIKASI
  Pemesanan: Pengguna dapat memesan dada ayam, paha ayam, dan nasi.

  Perhitungan Otomatis: Sistem akan menghitung total harga secara langsung setelah tombol "Hitung" ditekan.

  Logika Pehitungan Harga:
    Kenaikan harga Rp 1.000 untuk pesanan di cabang Cikarang.
    Kenaikan harga Rp 3.000 untuk ayam yang digoreng dengan teknik "speed fry".

  Penyimpanan Data: Setiap pesanan yang berhasil akan disimpan dalam file eksternal data_pesanan.json.

  Riwayat Pesanan: Tersedia halaman terpisah untuk melihat semua riwayat pesanan yang telah tersimpan.

  Tampilan awal:
  <img width="1650" height="979" alt="Tampilan awal pemesanan 1" src="https://github.com/user-attachments/assets/bde797a1-69d9-42f8-bcd7-2ec136416909" />
<img width="1621" height="229" alt="Tampilan awal pemesanan 2" src="https://github.com/user-attachments/assets/f1468425-fcff-4b5a-a128-9474eb81fd6e" />


Setelah berhasil melakukan pemesanan, akan tampil Ringkasan pemesanan di bawah seperti gambar berikut:
<img width="1656" height="992" alt="Tampilan ringkasan pesanan" src="https://github.com/user-attachments/assets/8041910f-cf8a-4199-948b-7b22a4ab2d54" />


-STRUKTUR FILE PROYEK-

AYAM_GORENG/

├── data_pesanan.json      # File untuk menyimpan riwayat pesanan dalam format JSON.

├── data_pesanan.php       # Halaman untuk menampilkan riwayat pesanan dari data_pesanan.json.

├── index.php              # Halaman utama yang berisi form pemesanan dan logika perhitungan.

└── logo_mfc.JPG           # Gambar logo Memphis Fried Chicken.


Akses Web: Buka browser dan ketikkan alamat berikut:
<http://localhost/Ayam_Goreng>
