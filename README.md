# My-Vehicle
My-Vehicle merupakan aplikasi untuk aplikasi untuk dapat memonitoring kendaraan yang dimiliki.

Aplikasi ini menggunakan:
1. Framework Laravel v10.34.2
2. PHP v8.1.10

Username dan Password:
Admin
email : admin@gmail.com
password : 123456

Manager 1
email : manager01@gmail.com
password : 123456

Manager 2
email : manager02@gmail.com
password : 123456

Manager 3
email : manager03@gmail.com
password : 123456

## Instalasi
Setelah memiliki file My-Vehicle, jalankan perintah berikut
1. composer install
2. php artisan migrate
3. php artisan db:seed
4. npm install
5. npm run dev
6. php artisan serve

## Cara Pemakaian
Admin
1. Login dengan akun yang sudah ada sebagai admin
2. Tambahkan data kendaraan
   Klik Kendaraan pada Sidebar -> Klik Tambah -> Isi Form -> Klik Simpan
3. Tambahkan data Sopir
   Klik Sopir pada Sidebar -> Klik Tambah -> Isi Form -> Klik Simpan
4. Tambahkan data Pemesanan
   Klik Pemesanan pada Sidebar -> Klik Tambah -> Isi Form -> Klik Simpan
   Setelah data pemesanan telah ditambahkan maka untuk dapat melakukan ke tahap berikut nya memerlukan persetujuan dari kedua manager yang telah dipilih dalam form sebelumnya.
5. Setelah pemesanan disetujui oleh kedua manager maka status pemesanan otomatis berganti menjadi Setuju
6. Kemudian disaat status telah menjadi setuju maka kendaraan dapat di pakai dan ubah menjadi status menjadi Dipakai
7. Disaat kendaraan telah dikembalikan maka ubah status menjadi Selesai.

Manager
1. Login dengan akun yang sudah ada sebagai manager
2. Melakukan persetujuan
   Klik Persetujuan pada Sidebar -> Klik ubah pada pemesanan yang ingin di setujui atau di tolak -> Isi form -> Klik Simpan
