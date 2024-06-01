@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
{{-- @if (trim($slot) === 'Laravel')
  <img src="https://laravel.com/img/notification-logo.png" class="logo" alt="Laravel Logo">
@else
{{ $slot }}
@endif --}}
  <img src="{{ asset('fe/assets/img/logo_panjang.svg') }}" width="30%" alt="Logo">
  {{-- <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('my-app-logo-192x192.png'))) }}" class="logo" alt="{{ $slot }}"> --}}
</a>
</td>
</tr>
