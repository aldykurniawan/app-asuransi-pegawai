<?php

namespace App\Listeners;

use App\Events\RegisterCreated;
use App\Mail\SendEmail;
use App\Models\DataMaster\ConfigEmail;
use App\Models\User;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;

class SendRegisterEmail
{
    public function handle(RegisterCreated $event)
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

        $register   = User::find($event->user->id);
        $kelanjutan = 'APP - BELUM ADA NAMA '.$register->name.' dilaporakan oleh .Silahkan kunjungi link dibawah untuk petunjuk ke lokasi';
        $title      = 'APP - BELUM ADA NAMA';
        Mail::to($register->email)
            ->send(
                new SendEmail(
                    $register->name,
                    $title,
                    $kelanjutan,
                    'emails.register_register',
                    []
                )
            );
    }
}
