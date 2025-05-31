Nama: Randy Maulana<br>
NPM: 2308107010054


Link Youtube: https://youtu.be/Jf66aCC_5FM <br>
Link PPT: https://www.canva.com/design/DAGo6SDRLY4/gYpDMNnOCsSSdAHNuMBcJA/edit?utm_content=DAGo6SDRLY4&utm_campaign=designshare&utm_medium=link2&utm_source=sharebutton

--------------------------------------------------------------------------------------------
# ---------------Table of Content------------------<br>
# 1.  [Proses Pembuatan](#1-proses-pembuatan)
# 2.  [Deskripsi dan tampilan](#2-deskripsi-dan-tampilan)
  
-------------------------------------------------------------------------------------------------------<br>

## 1. Proses pembuatan
- cd www dari LARAGON<br>
- buka cmd dan ketik command composer create-project laravel/laravel sistem-pemesanan-BahanBaku<br>
NOTE* COMPOSSER UDAH TERINSTALL<br>
- kalau belum download setup nya disini => "https://getcomposer.org/download/" <br>

1. Buat database di phpmyadmin dengan nama laptop_order_db(hanya buat nama database, untuk table akan di buat otomatis ketika buat model dan migrasi) <br>
   ![image](https://github.com/user-attachments/assets/7ee4498e-7313-45a3-b95a-ac9a58831159)
2. di .env hubungkan dengan database yang baru kita buat tadi<br>
   ![Screenshot 2025-05-31 154148](https://github.com/user-attachments/assets/aefc600d-7adc-4cfb-9b3f-a5668169568c)

3. buat model migration untuk component<br>
   "php artisan make:model Component -m", hasilnya dan kita ketik command "php artisan migrate"<br>
   ![image](https://github.com/user-attachments/assets/1abdf519-83a8-49ea-b3be-fef866759e75)

4. buat component controller<br>
   - "php artisan make:controller ComponentController" => akan otomatis membuat file app/Http/Controllers/ComponentController.php<br>
   - dan menambahkan code<br>
   "Route::resource('components', ComponentController::class);" di routes/web.php<br>
   
5. buat model laptop<br>
   - "php artisan make:model Laptop" => akan membuat file di app/Models/Laptop.php<br>
   - semua model buat, model order dan juga user sama juga<br>
   - lalu tambahkan controller<br>
   contoh untuk controller laptop<br>
   - "php artisan make:controller LaptopController" begitu pun lainnya<br>
   - jangan lupa bikin struktur table nya dengan "php artisan make:migration create_laptops_table"<br>
   - akhiri dengan "php artisan migrate"di terminal agar semua model dan migration, bahkan migration relation hadir di database seperti pada gambar no.1<br>

6. intinya gini struktur yang tepat<br>
   - buat migrasi dulu buat struktur tabel di database<br>
   - buat model representasi tabel supaya bisa akses data<br>
   - buat controller yakni logika untuk mengolah data model<br>
   - dan kita daftarkan route di web.php untuk URL bisa memanggil controller<br>

   Migration = struktur tabel di database, misalnya kolom-kolom apa saja di tabel laptops (nama, harga, stok, dll).<br>
   Model = kode PHP yang pakai tabel itu, supaya kamu bisa akses dan tampilkan data laptops di aplikasi.<br>


--------------------------------------------------------------------------------------------
## 2. Deskripsi dan tampilan

**Deskripsi** <br>
Sistem ini dirancang untuk mengelola proses pemesanan serta pengolahan bahan baku di sebuah pabrik yang memproduksi laptop dengan tampilan yang sederhana. Sistem ini berfungsi untuk mencatat dan mengorganisasi stok komponen secara terstruktur termasuk detail seperti nama komponen, tipe, harga, dan jumlah stok yang tersedia

Pada saat proses perakitan laptop berlangsung, stok komponen akan otomatis berkurang sesuai penggunaan, dan produk laptop yang telah selesai dirakit akan ditampilkan pada halaman pengguna lengkap dengan harga jualnya

Pengguna dapat melakukan pemesanan laptop secara langsung melalui sistem, serta mengunduh invoice pemesanan dalam format PDF sebagai bukti transaksi<br>

**Tampilan**
 1. Admin (Pegawai)
    - Halaman Login
      ![image](https://github.com/user-attachments/assets/0bb6ff89-78bb-4929-9d79-2670394d43f0)
      Admin (pegawai) tidak ada fitur registrasi kenapa? karena orang dalam tidak perlu registrasi sebab developer langsung memberikan superadmin ke para pegawai agar bisa login. Disini admin diminta username dan juga password
    - Dashboard
      ![image](https://github.com/user-attachments/assets/c71fa22f-b903-4158-ac76-d4cbdcdf3f9a)
      Memberikan informasi mengenai berapa jumlah pesanan, berapa laptop yang tersedia, komponen yang tersedia di gudang bahkan total pendapatan dari semua pesanan<br>
      Ada navigasi untuk menuju ke komponen dan laptop
    - Komponen
      ![image](https://github.com/user-attachments/assets/fa9b74cd-9651-4f8a-b2de-3d26ce9a103d)
      menampilkan daftar komponen yang tersedia, disini bisa mencari sesuai jenis komponen misal RAM, hanya menampilkan RAM saja <br>
      semua komponen tersusun dengan rapi dengan field Nama, Jenis, Stok, Harga Per Unit, Serta Aksi yang dimana bisa edit dan juga hapus
   
      
          - Komponen/Tambah Komponen
        ![image](https://github.com/user-attachments/assets/3ff5ffab-e5b6-4943-9f74-e8ca3e3234f4)
        Merupakan form untuk menambahkan nama komponen, jenis nya apa, stok ada berapa dan harga per unit, ketika di klik tombol simpan maka akan tersedia di daftar komponen

          - Komponen/Edit
        ![image](https://github.com/user-attachments/assets/fd1b6083-2cd9-4716-bc9a-46bb670070df)
        dalam edit terlihat sama dengan form tambah komponen hanya saja disini kita ada tombol untuk update komponen

          - Komponen/Hapus
        ![image](https://github.com/user-attachments/assets/1cac4e23-1620-4d3d-9659-a76750d7b897)
        Di menu hapus, sistem akan memberikan pop up untuk konformasi apakah benar benar akan menghapus komponen ini

    - Laptop
      ![image](https://github.com/user-attachments/assets/d352f219-0f52-45f6-b385-af85683a1ee1)
      Menampilkan daftar dari laptop yang telah siap dirakit dan ready untuk dijual, disini ada nama laptop, ada total harga, ada komponen atau spesifikasi dari laptop tersebut dan aksi yakni berisi edit dan hapus, di sisi kanan atas terlihat ada tombol untuk merakit laptop
          - Rakit Laptop
            ![image](https://github.com/user-attachments/assets/0901e4b2-b7f4-44b3-8a1e-650748f28d5f)
            Disini bisa ketika laptop dirakit bisa memiliki komponen apa yang di pakai, jadi bisa buat nama laptopnya apa lalu bisa pilih menggunakan spesifikasi seperti apa dan juga stoknya bisa pilih, misal Ram pakai kingston DDR4 stok nya 2
          - Edit
            ![image](https://github.com/user-attachments/assets/2e3fb57a-453b-442d-ac77-03f639d0aafb)
            Disini kita bisa edit nama laptop dan simpan perubahan
          - Hapus
            ![image](https://github.com/user-attachments/assets/5fdc04c7-4757-4d00-b774-a342100bd27c)
            Disini kita bisa hapus rakitan yang telah kita rakit sebelumnya

            







 3. User (Pembeli/Pelanggan)






