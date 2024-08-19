<?php

namespace Database\Seeders;

use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@psweb.com',
            'password' => bcrypt('psweb'),
            'rg' => '495016226',
            'cpf' => '47044664008',
            'cep' => '87083740',
            'address' => 'Rua Joaquim P Guedes',
            'addressNumber' => '100',
            'complement' => 'Casa',
            'neighborhood' => 'Jardim Paris VI',
            'city' => 'Maringá',
            'state' => 'PR',
            'isAdmin' => true,
            'role' => 'employee',
        ]);
    }
}
