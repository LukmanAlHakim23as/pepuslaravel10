<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kategoris')->insert([
            [
                'name' => 'fiksi',
            ],
            [
                'name' => 'non-fiksi',
            ],
        ]);
        DB::table('users')->insert([
            'name' => 'administrator',
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => hash::make('admin123'),
            'role' =>'admin'
        ]);
        DB::table('users')->insert([
            'name' => 'agus',
            'username' => 'pustakawan',
            'email' => 'pustakawan@gmail.com',
            'password' => hash::make('12345'),
            'role' =>'pustakawan'
        ]);
        DB::table('users')->insert([
            'name' => 'dadan',
            'username' => 'member',
            'email' => 'member@gmail.com',
            'password' => hash::make('12345'),
            'role' =>'member'
        ]);
        DB::table('bukus')->insert([
            'judul' => 'Laskar Pelangi',
            'kategori_id' => 1,
            'penulis' => 'Lukman',
            'penerbit' => 'Gramedia',
            'deskripsi' => '5 orang anak yang rajin dalam belajar',
            'stok' =>'2'
        ]);
    }
}
