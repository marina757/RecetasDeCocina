<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $user = User::create([
            'name' => 'Marina',
            'email' => 'correo@correo.com',
            'password' => Hash::make('12345678'),
            'url' => 'http://mar_villa.com',
        ]);

        $user->perfil()->create();

        $user2 = User::create([
            'name' => 'Pablo',
            'email' => 'correo1@correo.com',
            'password' => Hash::make('12345678'),
            'url' => 'http://mar_villa.com',
        ]);

        $user2->perfil()->create();

        // DB::table('users')->insert([
            
        //     'created_at' => date('Y-m-d H:i:s'),
        //     'updated_at' => date('Y-m-d H:i:s')
        // ]);

        // DB::table('users')->insert([
        //     'name' => 'Pablo',
        //     'email' => 'correo1@correo.com',
        //     'password' => Hash::make('12345678'),
        //     'url' => 'http://mar_villa.com',
        //     'created_at' => date('Y-m-d H:i:s'),
        //     'updated_at' => date('Y-m-d H:i:s')
        // ]);
    }
}
