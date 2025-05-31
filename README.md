Nama: Randy Maulana<br>
NPM: 2308107010054


Link Youtube: https://youtu.be/Jf66aCC_5FM <br>
Link PPT: https://www.canva.com/design/DAGo6SDRLY4/gYpDMNnOCsSSdAHNuMBcJA/edit?utm_content=DAGo6SDRLY4&utm_campaign=designshare&utm_medium=link2&utm_source=sharebutton

--------------------------------------------------------------------------------------------
Proses pembuatan<br>
cd www dari LARAGON<br>
buka cmd dan ketik command composer create-project laravel/laravel sistem-pemesanan-BahanBaku<br>
NOTE* COMPOSSER UDAH TERINSTALL<br>
kalau belum download setup nya disini => "https://getcomposer.org/download/" <br>

1. Buat database di phpmyadmin dengan nama laptop_order_db <br>
   ![image](https://github.com/user-attachments/assets/7ee4498e-7313-45a3-b95a-ac9a58831159)
2. di .env hubungkan dengan database yang baru kita buat tadi<br>
   ![Screenshot 2025-05-31 154148](https://github.com/user-attachments/assets/aefc600d-7adc-4cfb-9b3f-a5668169568c)

3. buat model migration untuk component<br>
   "php artisan make:model Component -m", hasilnya dan kita ketik command "php artisan migrate"<br>
   ![image](https://github.com/user-attachments/assets/1abdf519-83a8-49ea-b3be-fef866759e75)

4. buat component controller<br>
   "php artisan make:controller ComponentController" => akan otomatis membuat file app/Http/Controllers/ComponentController.php<br>
   dan menambahkan code<br>
   "Route::resource('components', ComponentController::class);" di routes/web.php
