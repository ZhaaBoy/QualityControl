<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeederTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create(attributes: [
            'name' => 'Admin QC',
            'username' => 'admin_qc',
            'email' => 'admin_qc@gmail.com',
            'password' => 'Rahasia123$',
        ]);

        User::factory()->create([
            'name' => 'Pimpinan',
            'username' => 'pimpinan',
            'email' => 'pimpinan@gmail.com',
            'password' => 'password',
        ]);

        User::factory()->create([
            'name' => 'QC Inline',
            'username' => 'qc_inline',
            'email' => 'qc_inline@gmail.com',
            'password' => 'password',
        ]);
    }
}
