# Sistem Role & Permission - Dokumentasi

Dokumentasi lengkap implementasi sistem role dengan 3 level user: admin, petinggi, calon_member.

## 📋 Daftar Perubahan

### 1. Database Migration
**File:** `database/migrations/2026_04_12_145447_add_role_to_users_table.php`

Menambahkan kolom `role` ke tabel `users`:
- Type: ENUM
- Values: `admin`, `petinggi`, `calon_member`
- Default: `calon_member`

**Jalankan migration jika belum:**
```bash
php artisan migrate
```

---

### 2. User Model
**File:** `app/Models/User.php`

**Perubahan:**
- Tambah `role` ke `$fillable`
- Tambah helper functions:
  - `isAdmin()` - Cek apakah user adalah admin
  - `isPetinggi()` - Cek apakah user adalah petinggi  
  - `isCalon()` - Cek apakah user adalah calon_member
  - `canAccessFilament()` - Cek apakah bisa akses Filament (admin & petinggi)
  - `isReadOnly()` - Cek apakah read-only mode (petinggi)

**Contoh penggunaan:**
```php
$user = auth()->user();

if ($user->isAdmin()) {
    // Admin logic
}

if ($user->canAccessFilament()) {
    // Bisa akses Filament
}

if ($user->isReadOnly()) {
    // Form disabled, hanya bisa lihat
}
```

---

### 3. Middleware
**File 1:** `app/Http/Middleware/FilamentAccess.php`

Middleware untuk protect akses Filament hanya untuk admin & petinggi.
- Jika user bukan admin/petinggi → redirect ke `/member` dengan pesan error
- Didaftarkan di `AdminPanelProvider`

**File 2:** `app/Http/Middleware/CalonMemberAccess.php`

Middleware untuk protect routes `/member` hanya untuk calon_member.
- Jika bukan calon_member → redirect ke `/admin` dengan pesan error
- Registered di `bootstrap/app.php` dengan alias `calon.member`

---

### 4. Authentication Controller
**File:** `app/Http/Controllers/Auth/AuthenticatedSessionController.php`

**Perubahan di method `store()`:**
- Admin & Petinggi → redirect ke `/admin` (Filament dashboard)
- Calon_Member → redirect ke `/dashboard` atau `/member`

```php
if ($user->isAdmin() || $user->isPetinggi()) {
    return redirect()->intended(route('filament.admin.pages.dashboard'));
}
return redirect()->intended(route('dashboard'));
```

---

### 5. Filament Admin Panel Provider
**File:** `app/Providers/Filament/AdminPanelProvider.php`

**Perubahan:**
- Import `FilamentAccess` middleware
- Register `FilamentAccess::class` di middleware array
- Import & register Login page

---

### 6. Filament Login Page
**File:** `app/Filament/Admin/Pages/Auth/Login.php`

Custom login page untuk Filament yang extend `BaseAuth` dengan error handling.

---

### 7. MemberResource (Filament)
**File:** `app/Filament/Admin/Resources/MemberResource.php`

**Fitur:**
- Form fields disabled untuk petinggi (read-only)
- Edit & Delete hanya tampil untuk admin
- View action tampil untuk petinggi
- Status field hanya tampil untuk admin
- Permissions methods: `canCreate()`, `canEdit()`, `canDelete()`, `canViewAny()`

**Pages:**
- `ListMembers.php` - List dengan "Create" button hanya untuk admin
- `CreateMember.php` - Create form untuk admin
- `ViewMember.php` - View detail (edit/delete hanya admin)
- `EditMember.php` - Edit form untuk admin

---

### 8. Routes Protection
**File:** `routes/web.php`

```php
// Member routes - calon_member only
Route::middleware(['auth', 'verified', 'calon.member'])->group(function () {
    Route::get('/member', ...)->name('member.dashboard');
    Route::get('/member/form', ...)->name('form');
});
```

---

### 9. Middleware Registration
**File:** `bootstrap/app.php`

```php
->withMiddleware(function (Middleware $middleware): void {
    $middleware->alias([
        'calon.member' => \App\Http\Middleware\CalonMemberAccess::class,
    ]);
})
```

---

## 🔄 Flow Sistem

### Login Flow
```
User Login
    ↓
AuthenticatedSessionController::store()
    ↓
    ├─ Admin/Petinggi? → Redirect /admin (Filament)
    └─ Calon_Member? → Redirect /dashboard atau /member
```

### Filament Access Flow
```
Access /admin
    ↓
FilamentAccess Middleware
    ├─ User tidak login? → Next
    ├─ Bukan Admin/Petinggi? → Redirect /member + error message
    └─ Admin/Petinggi? → Allow access
```

### Member Frontend Access Flow
```
Access /member/*
    ↓
CalonMemberAccess Middleware
    ├─ Tidak login? → Next (akan di-redirect login)
    ├─ Bukan Calon_Member? → Redirect /admin + error message  
    └─ Calon_Member? → Allow access
```

---

## 👥 Role Permissions Matrix

| Feature | Admin | Petinggi | Calon_Member |
|---------|-------|----------|--------------|
| Access Filament | ✅ | ✅ | ❌ |
| View Data | ✅ | ✅ | ❌ |
| Create | ✅ | ❌ | ❌ |
| Edit | ✅ | ❌ | ❌ |
| Delete | ✅ | ❌ | ❌ |
| Access /member | ❌ | ❌ | ✅ |
| Approve Data | ✅ | ❌ | ❌ |

---

## ✅ Testing

### Test Admin User
1. Login dengan user role `admin`
2. Akses `/admin` → Should show Filament dashboard & all actions
3. Akses `/member` → Should redirect to `/admin`
4. Can create, edit, delete members

### Test Petinggi User
1. Login dengan user role `petinggi`
2. Akses `/admin` → Should show Filament dashboard (read-only)
3. Form fields disabled, no edit/delete buttons
4. Akses `/member` → Should redirect to `/admin`

### Test Calon_Member User
1. Login dengan user role `calon_member`
2. Akses `/admin` → Should redirect to `/member`
3. Akses `/member` → Should be allowed
4. Can submit form saja

---

## 🛠️ Cara Mengganti Role User

### Via Artisan Tinker
```php
php artisan tinker
$user = User::find(1);
$user->role = 'admin'; // atau 'petinggi', 'calon_member'
$user->save();
```

### Via Laravel Query
```php
User::where('email', 'admin@example.com')->update(['role' => 'admin']);
```

---

## 📝 Contoh Pemeriksaan Role di Code

```php
// Di Controller
$user = auth()->user();

if ($user->isAdmin()) {
    // Lakukan sesuatu khusus admin
}

// Di Blade View
@if(auth()->user()->isAdmin())
    <button>Admin Button</button>
@endif

// Di Query
$members = Member::where('status', 'pending')->when(
    auth()->user()->isPetinggi(),
    fn($q) => $q->where('verified', true)
)->get();
```

---

## 🐛 Troubleshooting

### Error: "Class not found"
```bash
php artisan dump-autoload
```

### Routes tidak work
```bash
php artisan route:clear
php artisan config:clear
```

### Filament tidak muncul
```bash
php artisan cache:clear
php artisan filament:cache-components
```

---

## 📚 Referensi

- [Filament Docs](https://filamentphp.com)
- [Laravel Authorization](https://laravel.com/docs/authorization)
- [Laravel Middleware](https://laravel.com/docs/middleware)

---

**Dibuat:** April 12, 2026
**Versi:** 1.0
