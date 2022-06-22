<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Admin;
use App\Models\Roles;
use Illuminate\Support\Facades\DB;
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
        DB::table('admin_roles')->truncate();

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

        $admin->roles()->attach($adminRoles);
        $mod->roles()->attach($modRoles);
        $user->roles()->attach($userRoles);

        // \App\Models\Admin::factory()->count(10)->create();
    }
}
