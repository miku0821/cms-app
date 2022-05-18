<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'username' => 'enora',
            'name' => 'enora Smith',
            'avatar' => 'blank-profile-picture-g71137c199_640.png',
            'email' => 'enora@email',
            'password' => 'enora'
        ]);

    }
}
