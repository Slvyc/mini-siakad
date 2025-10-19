<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use GuzzleHttp\Promise\Create;
use Illuminate\Support\Facades\Hash;

class Mahasiswa extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create(
            [
                'name' => 'Muhammad Daffa Alfharijy',
                'nim' => '22146023',
                'email' => 'daffaalfharizy265@gmail.com',
                'role' => 'mahasiswa',
                'password' => hash::make('12345')
            ],
        );
        User::create(
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'role' => 'admin',
                'password' => hash::make('12345')
            ],
        );
    }
}
