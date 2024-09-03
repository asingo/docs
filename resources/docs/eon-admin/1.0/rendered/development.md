Aktivasi Development Mode
=========================

---

Untuk melakukan update maupun instalasi plugin, website harus dalam kondisi maintenance mode/ development mode. Berikut ini langkah - langkahnya

<a name="section-1"></a>

Login Panel
-----------

Buka login panel yang telah dikirimkan, lalu akan muncul gambar seperti di bawah ini

 ![](http://docs.grapiku.com/storage/eonchemicals/maintenance/maintenance-1.jpg)Masukkan Username dan password yang telah disediakan lalu klik tombol **Log In**

<a name="section-1"></a>

Setup Maintenance Mode
----------------------

Setelah melakukan proses login, pilih sites www.eonchemicals.com yang ditunjuk oleh gambar dibawah ini

 ![](http://docs.grapiku.com/storage/eonchemicals/maintenance/maintenance-2.jpg)Setelah melakukan petunjuk diatas maka akan muncul tampilan dibawah ini

 ![](http://docs.grapiku.com/storage/eonchemicals/maintenance/maintenance-3.jpg)Klik Bagian File Manager

 ![](http://docs.grapiku.com/storage/eonchemicals/maintenance/maintenance-4.jpg)Dobel klik file .env yang ditunjuk oleh gambar dibawah ini

 ![](http://docs.grapiku.com/storage/eonchemicals/maintenance/maintenance-5.jpg)Lalu akan muncul tampilan seperti di bawah ini

 ![](http://docs.grapiku.com/storage/eonchemicals/maintenance/maintenance-6.jpg)Ganti pada bagian `WP_ENV='production'` menjadi `WP_ENV='development'`

Pastikan untuk mengembalikan konfigurasi awal setelah maintenance selesai
-------------------------------------------------------------------------