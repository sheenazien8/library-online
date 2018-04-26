Klik link di bawah ini untuk verifikasi

<a href="{{ $link = url('auth/verify', $token) .'?email='. urlencode($user->email) }}">{{ $link }}</a>