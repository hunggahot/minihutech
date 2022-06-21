<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Admin;
use App\Models\Roles;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::truncate();

        $adminRoles = Roles::where('name', 'admin')->first();
        $modRoles = Roles::where('name', 'mod')->first();
        $userRoles = Roles::where('name', 'user')->first();

        $admin = Admin::create([
            'admin_name' => 'hutechadmin',
            'admin_email' => 'hutechadmin@gmail.com',
            'admin_phone' => '03040120213',
            'admin_password' => md5('123456')
        ]);
        $mod = Admin::create([
            'admin_name' => 'hutechmod',
            'admin_email' => 'hutechmod@gmail.com',
            'admin_phone' => '03040120213',
            'admin_password' => md5('123456')
        ]);
        $user = Admin::create([
            'admin_name' => 'hutechuser',
            'admin_email' => 'hutechuser@gmail.com',
            'admin_phone' => '03040120213',
            'admin_password' => md5('123456')
        ]);
    }
}
