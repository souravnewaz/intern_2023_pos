<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        $this->createAdmin();
        $this->createSeller();
        $this->createCustomer();
    }

    private function createAdmin()
    {
        User::create([
            'role' => 'admin',
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make(12345678),
        ]);
    }

    private function createSeller()
    {
        User::create([
            'role' => 'seller',
            'name' => 'Seller',
            'email' => 'seller@gmail.com',
            'password' => Hash::make(12345678),
        ]);
    }

    private function createCustomer()
    {
        Customer::create([
            'name' => 'Customer',
            'phone' => '01234567890',
            'address' => 'Dhaka, Bangladesh',
        ]);
    }
}
