# Setup Awal Sistem Role

## Cara Set Role User

### Opsi 1: Via Artisan Tinker

```bash
php artisan tinker
```

Kemudian jalankan:

```php
# Set user dengan email 'admin@example.com' menjadi admin
User::where('email', 'admin@example.com')->update(['role' => 'admin']);

# Set user dengan email 'petinggi@example.com' menjadi petinggi
User::where('email', 'petinggi@example.com')->update(['role' => 'petinggi']);

# Set user dengan email 'member@example.com' menjadi calon_member
User::where('email', 'member@example.com')->update(['role' => 'calon_member']);

# Cek berhasil
User::all(['id', 'name', 'email', 'role']);
```

### Opsi 2: Via Database Seed

Edit file `database/seeders/DatabaseSeeder.php`:

```php
<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        // Create petinggi user
        User::create([
            'name' => 'Petinggi User',
            'email' => 'petinggi@example.com',
            'password' => bcrypt('password'),
            'role' => 'petinggi',
            'email_verified_at' => now(),
        ]);

        // Create calon_member user
        User::create([
            'name' => 'Calon Member',
            'email' => 'member@example.com',
            'password' => bcrypt('password'),
            'role' => 'calon_member',
            'email_verified_at' => now(),
        ]);
    }
}
```

Kemudian jalankan:
```bash
php artisan db:seed --class=DatabaseSeeder
```

### Opsi 3: Via Raw SQL

```bash
# Masuk ke MySQL
mysql -u root -p database_name

# Update role
UPDATE users SET role = 'admin' WHERE email = 'admin@example.com';
UPDATE users SET role = 'petinggi' WHERE email = 'petinggi@example.com';
UPDATE users SET role = 'calon_member' WHERE email = 'member@example.com';
```

---

## Test Login dengan Berbagai Role

### Admin Login Test
- Email: `admin@example.com`
- Password: `password` (atau sesuai password saat register)
- Expected: Masuk ke Filament dashboard `/admin`
- Dapat: Create, Edit, Delete members
- Tidak dapat: Akses `/member`

### Petinggi Login Test
- Email: `petinggi@example.com`
- Password: `password`
- Expected: Masuk ke Filament dashboard `/admin` (read-only)
- Dapat: Hanya melihat data
- Tidak dapat: Create, Edit, Delete
- Tidak dapat: Akses `/member`

### Calon_Member Login Test
- Email: `member@example.com`
- Password: `password`
- Expected: Redirect ke `/member` atau `/dashboard`
- Dapat: Akses halaman member frontend
- Tidak dapat: Akses Filament `/admin`

---

## Verifikasi Sistem

### Check Role User di Database

```bash
php artisan db:show users
# atau via tinker
php artisan tinker
> User::with('role')->get()
```

### Check Middleware Registered

Edit route test:
```php
Route::get('/test-role', function () {
    $user = auth()->user();
    return [
        'user' => $user->email,
        'role' => $user->role,
        'isAdmin' => $user->isAdmin(),
        'isPetinggi' => $user->isPetinggi(),
        'isCalon' => $user->isCalon(),
        'canAccessFilament' => $user->canAccessFilament(),
    ];
})->middleware('auth');
```

Buka: `http://localhost:8000/test-role`

---

## Common Issues & Solutions

### "Access Denied" saat buka /admin dengan calon_member
**Solusi:** Ini adalah behavior yang benar. calon_member tidak boleh akses Filament.

### Form tidak disabled di Filament untuk petinggi
**Solusi:** Pastikan User model punya `isReadOnly()` method dan MemberResource form check `$isReadOnly`.

### Redirect loop
**Solusi:** Clear cache dan restart Laravel server:
```bash
php artisan cache:clear
php artisan config:clear
```

---
