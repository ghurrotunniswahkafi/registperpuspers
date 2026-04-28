@extends('layouts.app')

@section('content')

<div class="card">

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

    <form method="POST" action="{{ route('store') }}" enctype="multipart/form-data">
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
        <div class="form-group {{ $errors->has('no_identitas') ? 'error' : '' }}">
            <label>No. KTP / SIM / NIM / dsb</label>
            <input type="text" name="no_identitas" placeholder="Masukkan No. KTP / SIM / NIM / dsb" value="{{ old('no_identitas') }}" style="{{ $errors->has('no_identitas') ? 'border-color: #c33;' : '' }}">
            @if ($errors->has('no_identitas'))
                <small style="color: #c33;">{{ $errors->first('no_identitas') }}</small>
            @endif
        </div>

        <div class="form-group {{ $errors->has('asal_alamat') ? 'error' : '' }}">
            <label>Asal Alamat KTP</label>
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
        <p>Isikan Data Kaprodi/Kelurahan</p>
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
                    yang bertanda tangan mengenal saudara/i
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
    <p>Foto Formal {{ $errors->has('foto') }}</p>
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
        <input type="file" name="foto" id="foto">
    </div>

    <!-- FOTO KTP -->
    <p>Foto KTP {{ $errors->has('ktp')}}</p>
    @if ($errors->has('ktp'))
        <div style="background-color: #fee; border: 1px solid #fcc; color: #c33; padding: 10px; border-radius: 5px; margin-bottom: 10px;">
            <small>{{ $errors->first('ktp') }}</small>
        </div>
    @endif
    <div class="upload-box" style="{{ $errors->has('ktp') ? 'border-color: #c33; background-color: #fee;' : '' }}">
        <div style="text-align: center; font-size: 48px; margin-bottom: 15px; color: #000000;">
            <i class="fa-solid fa-cloud-arrow-up"></i>
        </div>
        <p class="upload-text">Klik untuk upload atau drag & drop</p>
        <small>JPG, PNG, JPEG (max. 5MB)</small>
        <p class="file-name" id="ktp-name"></p>
        <input type="file" name="ktp" id="ktp">
    </div>

</div>

    <!-- BUTTON -->
    <div class="form-actions">
        <button type="submit" class="btn-primary" id="submit-btn">Upload</button>
    </div>

    </form>

</div>

@endsection
@if(!$errors->any())
<script>
localStorage.removeItem('uploaded_foto');
localStorage.removeItem('uploaded_ktp');
</script>
@endif
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    const submitBtn = document.getElementById('submit-btn');
    
    // Validasi form sebelum submit
    if (form && submitBtn) {
        form.addEventListener('submit', function(e) {
            // Validasi input file
            const fotoInput = document.getElementById('foto');
            const ktpInput = document.getElementById('ktp');
            
            if (!fotoInput.files.length || !ktpInput.files.length) {
                e.preventDefault();
                alert('Silakan upload kedua foto (Formal dan KTP)');
                return false;
            }
            
            // Clear localStorage setelah submit berhasil (akan di-clear ketika form valid)
            // Tapi karena kita tidak tahu apakah berhasil, kita clear ketika submit
            localStorage.removeItem('uploaded_foto');
            localStorage.removeItem('uploaded_ktp');
            
            // Disable button hanya setelah validasi berhasil
            submitBtn.disabled = true;
            submitBtn.innerText = 'Loading...';
            submitBtn.style.opacity = '0.6';
            submitBtn.style.cursor = 'not-allowed';
        });
    }

    // Function to handle file input change
    function handleFileChange(input, displayElement) {
        input.addEventListener('change', function() {
            const fileName = this.files[0]?.name;
            displayElement.innerText = fileName ?? '';
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

    // Foto KTP
    const ktpInput = document.getElementById('ktp');
    const ktpDisplay = document.getElementById('ktp-name');
    const ktpBox = ktpInput ? ktpInput.closest('.upload-box') : null;
    if (ktpInput && ktpDisplay && ktpBox) {
        handleFileChange(ktpInput, ktpDisplay);
        handleDragDrop(ktpBox, ktpInput, ktpDisplay);
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
                console.log('File saved to localStorage:', key, file.name);
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
                const dt = new DataTransfer();
                dt.items.add(file);
                input.files = dt.files;
                displayElement.innerText = fileData.name;
                console.log('File restored from localStorage:', key, fileData.name);
            } catch (e) {
                console.error('Error restoring file:', e);
            }
        }
    }

    // Handle file input changes and save to localStorage
    if (fotoInput) {
        fotoInput.addEventListener('change', function() {
            saveFileToLocalStorage(this, 'uploaded_foto');
            const fileName = this.files[0]?.name;
            fotoDisplay.innerText = fileName ?? '';
        });
    }

    if (ktpInput) {
        ktpInput.addEventListener('change', function() {
            saveFileToLocalStorage(this, 'uploaded_ktp');
            const fileName = this.files[0]?.name;
            ktpDisplay.innerText = fileName ?? '';
        });
    }

    // Restore files on page load if there are errors for foto or ktp
    if (fotoInput && fotoDisplay) {
        restoreFileFromLocalStorage(fotoInput, 'uploaded_foto', fotoDisplay);
    }

    if (ktpInput && ktpDisplay) {
        restoreFileFromLocalStorage(ktpInput, 'uploaded_ktp', ktpDisplay);
    }
});
</script>