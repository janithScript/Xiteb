<?php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@pharmacy.com',
            'password' => Hash::make('admin123'),
            'role' => 'pharmacy',
            'address' => 'Pharmacy Address',
            'contact_no' => '1234567890',
            'dob' => '1990-01-01'
        ]);
    }
}
