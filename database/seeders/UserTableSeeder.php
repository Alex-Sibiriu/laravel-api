<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $new_user = new User;
        $new_user->name = 'alex';
        $new_user->email = $new_user->name . '@alex.it';
        $new_user->password = Hash::make('alex1234');

        $new_user->save();
    }
}
