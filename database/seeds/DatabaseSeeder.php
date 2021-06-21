<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(RoleTableSeeder::class);
        $this->call(optitulacionSeeder::class);
        $this->call(planesSeeder::class);
        $this->call(estatusSeeder::class);
        $this->call(CarrerasSeeder::class);
        $this->call(EstatusRevisorSinodalSeeder::class);
        $this->call(TipoRevisorSeeder::class);
        $this->call(TipoSinodalSeeder::class);
        $this->call(UsuarioMasterSeeder::class);


    }
}
