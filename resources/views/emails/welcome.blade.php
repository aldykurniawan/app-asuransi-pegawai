<x-mail::message>
  # Selamat Datang {{ $user?->name }}
  
  Data Anda akan Kami verifikasi terlebih dahulu.

  Kami akan mengirimkan email aktivasi setelah melakukan verifikasi pada email ini.
  
  <x-mail::button :url="env('APP_URL')">
  Visit {{ env("APP_NAME") }}
  </x-mail::button>
  
  Salam,<br>
  {{ config('app.name') }}
</x-mail::message>