<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Service;
use App\Models\Store;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CreateTestDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create(['name'=>'Mohamed','email'=>'mgalal8866@gmail.com','password'=>Hash::make('admin')]);
        Product::create(['name'=>'Product1']);
        Store::create(['name'=>'Store1']);
        Service::create(['name'=>'Service1']);
    }
}
