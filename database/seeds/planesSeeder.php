<?php

use Illuminate\Database\Seeder;

class planesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('planes')->insert([
            'nombre' => 'Plan 2010',
            'anio' => '2010'
        ]);
    }
}
