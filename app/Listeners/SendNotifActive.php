<?php

namespace App\Listeners;

use App\Events\EmailActivated;
use App\Mail\SendEmail;
use App\Models\DataMaster\ConfigEmail;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;

class SendNotifActive
{
    public function handle(EmailActivated $event)
    {
        $data = ConfigEmail::first();

        if (! empty($data)) {
            $config = [
                'driver' => $data->mailer,
                'host'   => $data->host,
                'port'   => $data->port,
                'from'   => [
                    'address' => $data->email,
                    'name'    => 'APP - BELUM ADA NAMA',
                ],
                'encryption' => $data->enc,
                'username'   => $data->username,
                'password'   => Crypt::decryptString($data->check),
            ];
            Config::set('mail', $config);
        }

        $kelanjutan = 'Selamat akun anda telah aktif, silahkan login untuk melihat informasi lebih lanjut.';
        $title      = 'Kasir - Aktivasi Akun Anda '.$event->user->name.' Telah Aktif';
        $user       = $event->user;
        Mail::to($user->email)
            ->send(
                new SendEmail(
                    $user->name,
                    $title,
                    $kelanjutan,
                    'emails.register_register',
                    []
                )
            );
    }
}
