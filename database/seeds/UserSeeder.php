<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = \App\User::create([
            'name' => 'Jorge Wong',
            'email' => 'jorgewong98@gmail.com',
            'password' => bcrypt('Sp*LwpiFVI?ft,Jh&6x9Ce')
        ]);
    }
}
