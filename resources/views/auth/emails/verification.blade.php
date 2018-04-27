@component('mail::message')
# Halo {{ $user->name }}

Klik tombol di bawah ini untuk verifikasi

@component('mail::button', ['url' => url('auth/verify', $user->verification_token).'?email='.urlencode($user->email)])
Verifikasi
@endcomponent

Salam,<br>
{{ config('app.name') }}
@endcomponent
