<?php

namespace Database\Seeders;

use App\Models\DataMaster\ConfigEmail;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Crypt;

class ConfigEmailProdSeeders extends Seeder
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
                'host'     => 'smtp.gmail.com',
                'port'     => 587,
                'username' => 'damkar.kutim.official@gmail.com',
                'check'    => Crypt::encryptString('prburqjzwtrqoiyx'),
                'enc'      => 'tls',
                'email'    => 'damkar.kutim.official@gmail.com',
            ]);
        }
    }
}
