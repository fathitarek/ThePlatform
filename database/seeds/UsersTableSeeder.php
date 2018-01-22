<?php
//php artisan db:seed --class=UsersTableSeeder
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('profiles')->insert([
            'name' => 'admin',
            'uniqid' => uniqid('',true),
            'permissions' => '{"users":1,"users_add":1,"users_view":1,"users_edit":1,"users_delete":1,"users_active":1,"profiles":1,"profiles_add":1,"profiles_edit":1,"profiles_delete":1,"profiles_active":1,"profiles_view":1,"settings":1,"system":1,"profile":1,"dashboard":1}',
            'active' => 1,
            'active_by' => 1,
            'active_date' => date('Y-m-d H:i:s'),
            'add_by' => 1,
            'add_date' => date('Y-m-d H:i:s'),
        ]);
        DB::table('users')->insert([
            'profile_id' => 1,
            'uniqid' => uniqid('',true),
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'username' => 'admin',
            'password' => \Illuminate\Support\Facades\Hash::make('admin'),
            'add_by' => 1,
            'add_date' => date('Y-m-d H:i:s'),
        ]);
    }
}
