<?php

use Illuminate\Database\Seeder;

class UsuarioMasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'ADMINISTRADOR',
            'email' => 'admin@admin.com',
            'username' => 'ADMIN123',
            'estatus' => '1',
            'email_verified_at' => '2021-03-20 04:07:31',
            'password'=>'$2y$10$RYNo6qqvogpkTzXgDmgy9.9p84HhnigYMSbG3TL43z0rYgQsljQda',
            'remember_token'=>'',
        ]);

        DB::table('role_user')->insert([
            'role_id' => '4',
            'user_id' => '1',
            
        ]);
    }
}
