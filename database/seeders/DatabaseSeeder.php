<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //user
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        //Eportal
        $this->call(StatikPage::class);

        // check if APP_ENV is production or not
        if (env('APP_ENV') === 'production') {
            $this->call(ConfigEmailProdSeeders::class);
        } else {
            $this->call(ConfigEmailSeeders::class);
        }
    }
}
