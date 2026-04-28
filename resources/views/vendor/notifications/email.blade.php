<x-mail::message>

{{-- Greeting --}}
# Halo,

{{-- Intro --}}
Kami menerima permintaan untuk mengatur ulang kata sandi akun Anda di  
**Perpustakaan Monumen Pers Nasional**.

Silakan klik tombol di bawah ini untuk membuat kata sandi baru.

{{-- Button --}}
<x-mail::button :url="$actionUrl" color="primary">
Reset Password
</x-mail::button>

{{-- Outro --}}
Jika Anda tidak merasa melakukan permintaan ini, Anda dapat mengabaikan email ini.

Untuk menjaga keamanan akun Anda, jangan membagikan informasi login kepada siapa pun.

{{-- Closing --}}
Terima kasih,<br>
**Admin Perpustakaan Monumen Pers Nasional**

{{-- Subcopy --}}
<x-slot:subcopy>
Jika tombol di atas tidak dapat diklik, silakan salin dan buka link berikut di browser Anda:

<span class="break-all">{{ $actionUrl }}</span>
</x-slot:subcopy>

</x-mail::message>