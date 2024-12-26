<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    //Crear 1 administrador (rol_id = 1)
    public function run(): void
    {
        User::create([
            'nombres' => 'Admin',
            'apellidos' => 'Principal',
            'telefono' => '999999999',
            'email' => 'admin@example.com',
            'foto' => null,
            'password' => Hash::make('password'),
            'rol_id' => 1, //Administrador
        ]);

        User::factory()->count(3)->create([
            'rol_id' => 2, //Consultores
        ]);

        User::factory()->count(10)->create([
            'rol_id' => 3, //Usuarios Comunes
        ]);
    }
}
