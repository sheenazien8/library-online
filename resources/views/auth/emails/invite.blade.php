@component('mail::message')
# Halo {{ $member->name }}

Admin kami telah mendaftarkan email anda ({{ $member->email }}) ke aplikasi perpustakaan online. untuk login, silahkan kunjungi link berikut:

@component('mail::button', ['url' => url('login')])
Login
@endcomponent

Login dengan email Anda dan password <strong>{{ $password }}</strong>

Salam,<br>
{{ config('app.name') }}
@endcomponent
