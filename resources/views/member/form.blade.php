@extends('layouts.app')

@section('title', 'Perpustakaan MPN')

@section('content')

<div class="card member-form-card">

    <h2 style="margin-bottom:20px;"><i class="fa-solid fa-circle-user"></i> DATA CALON ANGGOTA</h2>

    @if ($errors->any())
        <div style="background-color: #fee; border: 1px solid #fcc; color: #c33; padding: 15px; border-radius: 5px; margin-bottom: 20px;">
            <strong>Error:</strong>
            <ul style="margin-top: 10px; padding-left: 20px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form id="member-form" method="POST" action="{{ route('store') }}" enctype="multipart/form-data">
    @csrf

    <!-- ROW 1 -->
    <div class="form-row">
        <div class="form-group full {{ $errors->has('nama') ? 'error' : '' }}">
            <label>Nama Lengkap</label>
            <input type="text" name="nama" placeholder="Nama lengkap sesuai kartu identitas" value="{{ old('nama') }}" style="{{ $errors->has('nama') ? 'border-color: #c33; border: 2px solid #c33;' : '' }}">
            @if ($errors->has('nama'))
                <small style="color: #c33; display: block; margin-top: 5px;">{{ $errors->first('nama') }}</small>
            @endif
        </div>
    </div>

    <!-- ROW 2 -->
    <div class="form-row">
        <div class="form-group full {{ $errors->has('asal_alamat') ? 'error' : '' }}">
            <label>Asal Alamat</label>
            <select name="asal_alamat" id="asal_alamat" style="{{ $errors->has('asal_alamat') ? 'border-color: #c33;' : '' }}">
                <option value="">Pilih</option>
                <option value="Surakarta" {{ old('asal_alamat') === 'Surakarta' ? 'selected' : '' }}>Surakarta</option>
                <option value="Sukoharjo" {{ old('asal_alamat') === 'Sukoharjo' ? 'selected' : '' }}>Sukoharjo</option>
                <option value="Karanganyar" {{ old('asal_alamat') === 'Karanganyar' ? 'selected' : '' }}>Karanganyar</option>
                <option value="Lainnya" {{ old('asal_alamat') === 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
            </select>
            @if ($errors->has('asal_alamat'))
                <small style="color: #c33;">{{ $errors->first('asal_alamat') }}</small>
            @endif
        </div>
    </div>

    <!-- PENGESAHAN FORM (hidden by default) -->
    <div id="pengesahan-form" style="display: none;">
        <h3>Pengesahan</h3>
        <p><i>Diisi oleh pihak yang mengenal atau dapat memberikan keterangan mengenai calon anggota, seperti Kaprodi/Dosen, Guru, HRD/Atasan, RT/RW, atau Kelurahan.</i></p>
        <div class="form-row">
            <div class="form-group {{ $errors->has('pengesahan_nama') ? 'error' : '' }}">
                <label>Nama</label>
                <input type="text" name="pengesahan_nama" placeholder="Nama pengesah" value="{{ old('pengesahan_nama') }}" style="{{ $errors->has('pengesahan_nama') ? 'border-color: #c33;' : '' }}">
                @if ($errors->has('pengesahan_nama'))
                    <small style="color: #c33;">{{ $errors->first('pengesahan_nama') }}</small>
                @endif
            </div>
            <div class="form-group {{ $errors->has('pengesahan_jabatan') ? 'error' : '' }}">
                <label>Jabatan</label>
                <input type="text" name="pengesahan_jabatan" placeholder="Jabatan pengesah" value="{{ old('pengesahan_jabatan') }}" style="{{ $errors->has('pengesahan_jabatan') ? 'border-color: #c33;' : '' }}">
                @if ($errors->has('pengesahan_jabatan'))
                    <small style="color: #c33;">{{ $errors->first('pengesahan_jabatan') }}</small>
                @endif
            </div>
        </div>
        <div class="form-row">
            <div class="form-group full {{ $errors->has('pengesahan_kenal') ? 'error' : '' }}">
                <label>
                    <input type="checkbox" name="pengesahan_kenal" value="1" {{ old('pengesahan_kenal') ? 'checked' : '' }}>
                    Pemberi pengesahan mengenal calon anggota dan menyatakan data yang diberikan benar.
                </label>
                @if ($errors->has('pengesahan_kenal'))
                    <small style="color: #c33; display: block;">{{ $errors->first('pengesahan_kenal') }}</small>
                @endif
            </div>
        </div>
    </div>

    <!-- ROW 3 -->
    <div class="form-row">
        <div class="form-group {{ $errors->has('tempat') ? 'error' : '' }}">
            <label>Tempat</label>
            <input type="text" name="tempat" placeholder="Kota/Kabupaten" value="{{ old('tempat') }}" style="{{ $errors->has('tempat') ? 'border-color: #c33;' : '' }}">
            @if ($errors->has('tempat'))
                <small style="color: #c33;">{{ $errors->first('tempat') }}</small>
            @endif
        </div>

        <div class="form-group {{ $errors->has('tanggal_lahir') ? 'error' : '' }}">
            <label>Tanggal Lahir</label>
            <input type="date" name="tanggal_lahir" id="tanggal_lahir" value="{{ old('tanggal_lahir') }}" style="{{ $errors->has('tanggal_lahir') ? 'border-color: #c33;' : '' }}">
            @if ($errors->has('tanggal_lahir'))
                <small style="color: #c33;">{{ $errors->first('tanggal_lahir') }}</small>
            @endif
        </div>
    </div>

    <!-- ROW 4 -->
    <div class="form-row">
        <div class="form-group full {{ $errors->has('alamat') ? 'error' : '' }}">
            <label>Alamat Rumah</label>
            <input type="text" name="alamat" placeholder="Alamat sesuai kartu identitas" value="{{ old('alamat') }}" style="{{ $errors->has('alamat') ? 'border-color: #c33;' : '' }}">
            @if ($errors->has('alamat'))
                <small style="color: #c33;">{{ $errors->first('alamat') }}</small>
            @endif
        </div>
    </div>

    <!-- ROW 5 -->
    <div class="form-row">
        <div class="form-group {{ $errors->has('no_hp') ? 'error' : '' }}">
            <label>No. Telepon / HP</label>
            <input type="text" name="no_hp" placeholder="08xxxxxxxxxx" minlength="12" maxlength="12" value="{{ old('no_hp') }}" style="{{ $errors->has('no_hp') ? 'border-color: #c33;' : '' }}">
            <small style="color: #999; font-size: 12px;">12 digit (contoh: 08xxxxxxxxxx)</small>
            @if ($errors->has('no_hp'))
                <small style="color: #c33;">{{ $errors->first('no_hp') }}</small>
            @endif
        </div>

        <div class="form-group {{ $errors->has('email') ? 'error' : '' }}">
            <label>Alamat Email</label>
            <input type="email" name="email" placeholder="contoh@gmail.com" value="{{ auth()->user()->email }}" readonly style="background-color: #f0f0f0; cursor: not-allowed;">
            <small style="color: #666; font-size: 12px;">Email dari akun Anda (tidak dapat diubah)</small>
            @if ($errors->has('email'))
                <small style="color: #c33;">{{ $errors->first('email') }}</small>
            @endif
        </div>

        <div class="form-group">
            <label>Media Sosial</label>
            <input type="text" name="sosmed" placeholder="FB / IG / dll" value="{{ old('sosmed') }}">
        </div>
    </div>

    <!-- ROW 6 -->
    <div class="form-row">
        <div class="form-group full">
            <label>Sekolah / Kuliah / Kerja di</label>
            <input type="text" name="instansi" placeholder="Nama instansi" value="{{ old('instansi') }}">
        </div>
    </div>

    <!-- ROW 7 -->
    <div class="form-row">
        <div class="form-group full">
            <label>Alamat Sekolah / Kampus / Kantor</label>
            <input type="text" name="alamat_instansi" placeholder="Alamat instansi" value="{{ old('alamat_instansi') }}">
        </div>
    </div>

    <!-- UPLOAD -->
    <div class="upload-section">

    <h3><i class="fa-solid fa-file-circle-plus"></i> UPLOAD FOTO</h3>

    <!-- FOTO FORMAL -->
    <p>Foto Diri</p>
    <div class="photo-example-info">
        <button type="button" class="photo-example-link" id="open-photo-example">
            <i class="fa-regular fa-image"></i>
            Contoh Foto Klik di Sini
        </button>
        <p>Gunakan Foto Dengan Posisi Seperti Di Contoh Untuk Mendapatkan Hasil Yang Maksimal</p>
    </div>
    @if ($errors->has('foto'))
        <div style="background-color: #fee; border: 1px solid #fcc; color: #c33; padding: 10px; border-radius: 5px; margin-bottom: 10px;">
            <small>{{ $errors->first('foto') }}</small>
        </div>
    @endif
    <div class="upload-box" style="{{ $errors->has('foto') ? 'border-color: #c33; background-color: #fee;' : '' }}">
        <div style="text-align: center; font-size: 48px; margin-bottom: 15px; color: #000000;">
            <i class="fa-solid fa-cloud-arrow-up"></i>
        </div>
        <p class="upload-text">Klik untuk upload atau drag & drop</p>
        <small>Ukuran Foto 2x3</small>
        <small>JPG, PNG, JPEG (max. 5MB)</small>
        <p class="file-name" id="foto-name"></p>
        <input type="file" name="foto" id="foto" accept=".jpg,.jpeg,.png,image/jpeg,image/png">
    </div>

    <!-- SYARAT DAN KETENTUAN -->
    <div class="terms-box {{ $errors->has('ketentuan_anggota') ? 'terms-error' : '' }}">
        <div class="terms-title">
            <span class="terms-title-icon" aria-hidden="true">
                <i class="fa-solid fa-file-lines"></i>
                <i class="fa-solid fa-magnifying-glass"></i>
            </span>
            <h3>SYARAT DAN KETENTUAN ANGGOTA</h3>
        </div>

        <ol class="terms-list">
            <li>Peminjam wajib menjaga dan merawat koleksi yang dipinjam dengan baik, mengingat koleksi tersebut merupakan milik bersama yang juga dibutuhkan oleh pengguna lain.</li>
            <li>Dilarang mengotori, melipat, maupun mencoret-coret bagian cover maupun isi koleksi yang dipinjam.</li>
            <li>Koleksi wajib dikembalikan tepat waktu sesuai batas waktu peminjaman yang telah ditentukan. Keterlambatan pengembalian akan dikenakan sanksi sesuai ketentuan yang berlaku.</li>
            <li>Koleksi yang dipinjam tidak diperkenankan untuk dipinjamkan kepada pihak lain. Apabila koleksi hilang, maka peminjam yang tercatat pada buku peminjaman perpustakaan dinyatakan bertanggung jawab dan wajib mengganti dengan koleksi yang sama.</li>
            <li>Kartu perpustakaan bersifat pribadi dan tidak dapat dipinjamkan kepada orang lain.</li>
        </ol>

        <label class="terms-check">
            <input type="checkbox" name="ketentuan_anggota" id="ketentuan_anggota" value="1" {{ old('ketentuan_anggota') ? 'checked' : '' }}>
            <span>Saya menyatakan bahwa data yang saya isi adalah benar dan dapat dipertanggungjawabkan, serta bersedia menaati seluruh ketentuan peminjaman koleksi Perpustakaan Monumen Pers Nasional.</span>
        </label>

        @if ($errors->has('ketentuan_anggota'))
            <small class="terms-error-text">{{ $errors->first('ketentuan_anggota') }}</small>
        @endif
    </div>

</div>

    <!-- BUTTON -->
    <div class="form-actions">
        <button type="submit" class="btn-primary" id="submit-btn">Upload</button>
    </div>

    </form>

</div>

<div class="photo-example-modal" id="photo-example-modal" aria-hidden="true">
    <div class="photo-example-dialog" role="dialog" aria-modal="true" aria-labelledby="photo-example-title">
        <button type="button" class="photo-example-close" id="close-photo-example" aria-label="Tutup contoh foto">
            <i class="fa-solid fa-xmark"></i>
        </button>
        <h2 id="photo-example-title">Contoh Foto Formal</h2>
        <img src="{{ asset('image/idcard.png') }}" alt="Contoh pose foto formal setengah badan">
    </div>
</div>

@endsection
@if(!$errors->any())
<script>
localStorage.removeItem('uploaded_foto');
</script>
@endif
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('member-form');
    const submitBtn = document.getElementById('submit-btn');
    const photoExampleModal = document.getElementById('photo-example-modal');
    const openPhotoExample = document.getElementById('open-photo-example');
    const closePhotoExample = document.getElementById('close-photo-example');

    function showPhotoExample() {
        if (!photoExampleModal) {
            return;
        }

        photoExampleModal.classList.add('is-open');
        photoExampleModal.setAttribute('aria-hidden', 'false');
        document.body.classList.add('modal-open');
        closePhotoExample?.focus();
    }

    function hidePhotoExample() {
        if (!photoExampleModal) {
            return;
        }

        photoExampleModal.classList.remove('is-open');
        photoExampleModal.setAttribute('aria-hidden', 'true');
        document.body.classList.remove('modal-open');
        openPhotoExample?.focus();
    }

    openPhotoExample?.addEventListener('click', showPhotoExample);
    closePhotoExample?.addEventListener('click', hidePhotoExample);

    photoExampleModal?.addEventListener('click', function(e) {
        if (e.target === photoExampleModal) {
            hidePhotoExample();
        }
    });

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && photoExampleModal?.classList.contains('is-open')) {
            hidePhotoExample();
        }
    });
    
    // Validasi form sebelum submit
    if (form && submitBtn) {
        form.addEventListener('submit', function(e) {
            // Validasi input file
            const fotoInput = document.getElementById('foto');
            
            if (!fotoInput.files.length) {
                e.preventDefault();
                alert('Silakan upload foto formal.');
                return false;
            }

            if (!validatePhotoFile(fotoInput.files[0], true)) {
                e.preventDefault();
                clearInvalidPhoto(fotoInput, document.getElementById('foto-name'));
                return false;
            }

            const termsInput = document.getElementById('ketentuan_anggota');
            if (termsInput && !termsInput.checked) {
                e.preventDefault();
                alert('Silakan centang persetujuan syarat dan ketentuan anggota.');
                termsInput.focus();
                return false;
            }

            // Clear localStorage setelah submit berhasil (akan di-clear ketika form valid)
            // Tapi karena kita tidak tahu apakah berhasil, kita clear ketika submit
            localStorage.removeItem('uploaded_foto');
            
            // Disable button hanya setelah validasi berhasil
            submitBtn.disabled = true;
            submitBtn.innerText = 'Loading...';
            submitBtn.style.opacity = '0.6';
            submitBtn.style.cursor = 'not-allowed';
        });
    }

    function validatePhotoFile(file, showAlert = false) {
        if (!file) {
            return false;
        }

        const allowedExtensions = ['jpg', 'jpeg', 'png'];
        const allowedMimeTypes = ['image/jpeg', 'image/png'];
        const extension = file.name.split('.').pop()?.toLowerCase() ?? '';
        const maxSize = 5 * 1024 * 1024;

        if (!allowedExtensions.includes(extension) || !allowedMimeTypes.includes(file.type)) {
            if (showAlert) {
                alert('Format foto tidak sesuai. Gunakan file JPG, JPEG, atau PNG.');
            }
            return false;
        }

        if (file.size > maxSize) {
            if (showAlert) {
                alert('Ukuran foto terlalu besar. Maksimal ukuran file adalah 5 MB.');
            }
            return false;
        }

        return true;
    }

    function clearInvalidPhoto(input, displayElement) {
        input.value = '';
        displayElement.innerText = '';
        displayElement.style.color = '';
        displayElement.style.fontWeight = '';
        localStorage.removeItem('uploaded_foto');
    }

    // Function to handle file input change
    function handleFileChange(input, displayElement) {
        input.addEventListener('change', function() {
            const file = this.files[0];

            if (!file) {
                displayElement.innerText = '';
                return;
            }

            if (!validatePhotoFile(file, true)) {
                clearInvalidPhoto(this, displayElement);
                return;
            }

            displayElement.innerText = file.name;
        });
    }

    // Function to handle drag and drop
    function handleDragDrop(box, input, displayElement) {
        box.addEventListener('dragover', function(e) {
            e.preventDefault();
            box.classList.add('dragover');
        });

        box.addEventListener('dragleave', function(e) {
            e.preventDefault();
            box.classList.remove('dragover');
        });

        box.addEventListener('drop', function(e) {
            e.preventDefault();
            box.classList.remove('dragover');
            const files = e.dataTransfer.files;
            if (files.length > 0) {
                input.files = files;
                const event = new Event('change');
                input.dispatchEvent(event);
            }
        });
    }

    // Handle asal_alamat select change
    const asalAlamatSelect = document.getElementById('asal_alamat');
    const pengesahanForm = document.getElementById('pengesahan-form');
    
    // Show pengesahan form jika value === 'Lainnya' atau jika ada old data
    function updatePengesahanVisibility() {
        if (asalAlamatSelect && pengesahanForm) {
            if (asalAlamatSelect.value === 'Lainnya') {
                pengesahanForm.style.display = 'block';
            } else {
                pengesahanForm.style.display = 'none';
            }
        }
    }
    
    // Initial check saat page load
    updatePengesahanVisibility();
    
    // Listen on change
    if (asalAlamatSelect) {
        asalAlamatSelect.addEventListener('change', updatePengesahanVisibility);
    }

    // Foto Formal
    const fotoInput = document.getElementById('foto');
    const fotoDisplay = document.getElementById('foto-name');
    const fotoBox = fotoInput ? fotoInput.closest('.upload-box') : null;
    if (fotoInput && fotoDisplay && fotoBox) {
        handleFileChange(fotoInput, fotoDisplay);
        handleDragDrop(fotoBox, fotoInput, fotoDisplay);
    }

    // Validasi Tanggal Lahir - hanya tanggal masa lalu
    const tanggalLahirInput = document.getElementById('tanggal_lahir');
    if (tanggalLahirInput) {
        const today = new Date();
        const maxDate = today.toISOString().split('T')[0];
        tanggalLahirInput.setAttribute('max', maxDate);
        
        tanggalLahirInput.addEventListener('change', function() {
            const selectedDate = new Date(this.value);
            if (selectedDate > today) {
                alert('Tanggal lahir tidak boleh di masa depan!');
                this.value = '';
            }
        });
    }

    // Validasi No HP - hanya 12 digit dan hanya angka
    const noHpInput = document.querySelector('input[name="no_hp"]');
    if (noHpInput) {
        noHpInput.addEventListener('input', function() {
            this.value = this.value.replace(/[^0-9]/g, '').slice(0, 12);
        });
    }

    // Function untuk menyimpan file ke localStorage sebagai base64
    function saveFileToLocalStorage(input, key) {
        const file = input.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const base64 = e.target.result;
                localStorage.setItem(key, JSON.stringify({
                    name: file.name,
                    type: file.type,
                    size: file.size,
                    data: base64
                }));
            };
            reader.readAsDataURL(file);
        }
    }

    // Function untuk convert base64 ke Blob
    function base64ToBlob(base64, mimeType) {
        const byteCharacters = atob(base64.split(',')[1]);
        const byteNumbers = new Array(byteCharacters.length);
        for (let i = 0; i < byteCharacters.length; i++) {
            byteNumbers[i] = byteCharacters.charCodeAt(i);
        }
        const byteArray = new Uint8Array(byteNumbers);
        return new Blob([byteArray], { type: mimeType });
    }

    // Function untuk restore file dari localStorage
    function restoreFileFromLocalStorage(input, key, displayElement) {
        const stored = localStorage.getItem(key);
        if (stored) {
            try {
                const fileData = JSON.parse(stored);
                const blob = base64ToBlob(fileData.data, fileData.type);
                const file = new File([blob], fileData.name, { type: fileData.type });

                if (!validatePhotoFile(file)) {
                    localStorage.removeItem(key);
                    return;
                }
                
                // Create DataTransfer and set files properly
                const dt = new DataTransfer();
                dt.items.add(file);
                input.files = dt.files;
                
                // Manually trigger change event and update display
                displayElement.innerText = fileData.name;
                
                // Add visual indicator that file is restored
                displayElement.style.color = 'green';
                displayElement.style.fontWeight = 'bold';
                
            } catch (e) {
                console.error('Error restoring file:', e);
            }
        }
    }

    // Handle file input changes and save to localStorage
    if (fotoInput) {
        fotoInput.addEventListener('change', function() {
            if (!this.files[0] || !validatePhotoFile(this.files[0])) {
                return;
            }

            saveFileToLocalStorage(this, 'uploaded_foto');
            fotoDisplay.innerText = this.files[0].name;
        });
    }

    // Restore files on page load if there are errors for foto
    if (fotoInput && fotoDisplay) {
        restoreFileFromLocalStorage(fotoInput, 'uploaded_foto', fotoDisplay);
    }
});
</script>
