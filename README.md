Nama: Randy Maulana<br>
NPM: 2308107010054


Link Youtube: https://youtu.be/Jf66aCC_5FM <br>
Link PPT: https://www.canva.com/design/DAGo6SDRLY4/gYpDMNnOCsSSdAHNuMBcJA/edit?utm_content=DAGo6SDRLY4&utm_campaign=designshare&utm_medium=link2&utm_source=sharebutton

--------------------------------------------------------------------------------------------
# ---------------Table of Content------------------<br>
# 1. [Proses Pembuatan](#proses-pembuatan)
# 2. [Deskripsi dan Tampilan](#deskripsi-dan-tampilan)
## 📑 Table of Contents

- [Proses Pembuatan](#proses-pembuatan)
- [Deskripsi dan Tampilan](#deskripsi-dan-tampilan)

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


** Deskripsi **
** Tampilan **
 1. Admin (Pegawai)
 2. User (Pembeli/Pelanggan)






