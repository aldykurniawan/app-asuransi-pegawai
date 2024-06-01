<?php

namespace Database\Seeders;

use App\Models\DataMaster\ConfigEmail;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Crypt;

class ConfigEmailSeeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = ConfigEmail::first();

        if (empty($data)) {
            ConfigEmail::create([
                'mailer'   => 'smtp',
                'host'     => 'localhost',
                'port'     => 1025,
                'username' => 'damkar',
                // 'check'    => Crypt::encryptString('535a6126104e80'),
                'check' => 'damkar',
                'enc'   => 'tls',
                'email' => 'pengaduanrsmkaltim@gmail.com',
            ]);
        }
    }
}
