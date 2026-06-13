# Sistem Pendaftaran Anggota Perpustakaan MPN

Aplikasi web untuk pendaftaran dan pengelolaan anggota **Perpustakaan Monumen Pers Nasional**. Calon anggota dapat membuat akun, mengisi formulir, mengunggah foto formal, memantau status verifikasi, melihat profil, dan mengunduh formulir pendaftaran. Admin dapat memeriksa, memvalidasi, dan mengelola data anggota.

## Fitur Utama

### Calon Anggota

- Registrasi dan login akun.
- Halaman welcome berisi alur pendaftaran.
- Pengisian formulir data calon anggota.
- Form pengesahan khusus alamat di luar Surakarta, Sukoharjo, dan Karanganyar.
- Upload foto formal dengan format `JPG`, `JPEG`, atau `PNG`, maksimal `5 MB`.
- Contoh pose foto formal dalam pop-up.
- Halaman konfirmasi setelah formulir berhasil dikirim.
- Pemantauan status pengajuan: `pending`, `validasi`, dan `selesai`.
- Profil anggota dalam mode read-only.
- Unduh formulir pendaftaran dalam format PDF.

### Admin

- Dashboard ringkasan data pendaftaran.
- Verifikasi dan persetujuan calon anggota.
- Pengelolaan data anggota.
- Pengelolaan daftar pengguna.
- Laporan berdasarkan periode.
- Ekspor laporan ke Excel dan PDF.

## Teknologi

- PHP `8.2+`
- Laravel `12`
- Laravel Breeze
- Filament `5`
- Blade, Tailwind CSS, dan CSS kustom
- Vite
- SQLite atau MySQL
- DomPDF
- Laravel Excel

## Persyaratan

Pastikan perangkat sudah memiliki:

- PHP `8.2` atau lebih baru
- Composer
- Node.js dan npm
- SQLite atau MySQL
- Ekstensi PHP yang dibutuhkan Laravel

Untuk pengguna Windows, project dapat dijalankan melalui XAMPP dan PowerShell.

## Instalasi

1. Clone repository:

   ```powershell
   git clone <URL_REPOSITORY>
   cd registperpuspersnis
   ```

2. Instal dependency PHP:

   ```powershell
   composer install
   ```

3. Salin konfigurasi environment:

   ```powershell
   Copy-Item .env.example .env
   ```

4. Buat application key:

   ```powershell
   php artisan key:generate
   ```

5. Atur koneksi database pada file `.env`.

   Contoh SQLite:

   ```env
   DB_CONNECTION=sqlite
   ```

   Pastikan file database tersedia:

   ```powershell
   New-Item database\database.sqlite -ItemType File -Force
   ```

   Contoh MySQL:

   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=registperpuspersnis
   DB_USERNAME=root
   DB_PASSWORD=
   ```

6. Jalankan migration:

   ```powershell
   php artisan migrate
   ```

7. Buat symbolic link untuk foto anggota:

   ```powershell
   php artisan storage:link
   ```

8. Instal dan build aset frontend:

   ```powershell
   npm install
   npm run build
   ```

9. Jalankan aplikasi:

   ```powershell
   php artisan serve
   ```

Aplikasi dapat dibuka melalui:

```text
http://127.0.0.1:8000
```

Untuk pengembangan frontend, jalankan `npm run dev` pada terminal terpisah.

## Membuat Akun Admin

Password disimpan dalam bentuk hash dan tidak boleh ditulis langsung di repository. Buat admin melalui Laravel Tinker:

```powershell
php artisan tinker
```

Kemudian jalankan:

```php
$admin = new App\Models\User;
$admin->name = 'Administrator';
$admin->email = 'admin@example.com';
$admin->password = 'GantiDenganPasswordYangKuat';
$admin->role = 'admin';
$admin->email_verified_at = now();
$admin->save();
```

Model `User` akan melakukan hashing password secara otomatis.

## Role Pengguna

| Role | Akses |
|---|---|
| `calon_member` | Formulir, status pengajuan, profil, dan PDF |
| `admin` | Dashboard, verifikasi, data anggota, pengguna, dan laporan |
| `petinggi` | Role tambahan yang tersedia pada model pengguna |

## Halaman Penting

| URL | Keterangan |
|---|---|
| `/` | Halaman welcome |
| `/login` | Login pengguna |
| `/register` | Registrasi calon anggota |
| `/member/form` | Formulir pendaftaran |
| `/member/status` | Status pengajuan |
| `/member/profile` | Profil read-only |
| `/admin/dashboard` | Dashboard admin |
| `/admin/verifikasi` | Verifikasi pendaftaran |
| `/admin/data-anggota` | Data anggota |
| `/admin/laporan` | Laporan admin |

Route member memerlukan autentikasi, verifikasi email, dan role `calon_member`. Route admin memerlukan autentikasi dan role `admin`.

## Alur Pendaftaran

1. Pengguna membuat akun atau login.
2. Pengguna mengisi formulir pendaftaran.
3. Pengguna mengunggah foto formal.
4. Data masuk dengan status `pending`.
5. Admin memeriksa dan memvalidasi data.
6. Setelah disetujui, status menjadi `selesai`.
7. Pengguna mengunduh formulir dan datang ke perpustakaan dengan dokumen yang diperlukan.

## Struktur Direktori Utama

```text
app/
  Http/Controllers/     Controller member dan admin
  Models/               Model User dan Member
database/
  migrations/           Struktur tabel database
public/
  css/                   CSS aplikasi
  image/                 Logo dan aset gambar
resources/
  views/                 Blade member, admin, auth, dan welcome
routes/
  web.php                Route utama aplikasi
```

## Menjalankan Pengujian

```powershell
php artisan test
```

Untuk memeriksa route:

```powershell
php artisan route:list
```

Untuk membersihkan cache Laravel:

```powershell
php artisan optimize:clear
```

## Catatan Keamanan

- Jangan commit file `.env`.
- Jangan menaruh password admin di README.
- Gunakan password admin yang kuat dan unik.
- Pastikan `APP_DEBUG=false` pada lingkungan produksi.
- Batasi ukuran dan tipe file upload pada frontend dan backend.
- Lakukan backup database serta folder `storage/app/public` secara berkala.

## Lisensi

Project ini dikembangkan untuk kebutuhan sistem pendaftaran anggota Perpustakaan Monumen Pers Nasional.
