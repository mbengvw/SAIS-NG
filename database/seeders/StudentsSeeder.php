<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class StudentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        // $gender = $faker->randomElement(['Laki', 'Perempuan']);
        $jalur=$faker->randomElement(['reguler','prestasi','pindahan']);
        $kelas=$faker->randomElement(['10','11','12']);


    	foreach (range(1,200) as $index) {
            DB::table('students')->insert([
                'nis' => $faker->phoneNumber(),
                'nisn' => $faker->phoneNumber(),
                'nama_lengkap' => $faker->name(),
                'tahun_masuk' => $faker->year(),
                'kelas_masuk' => $kelas,
                'jalur_masuk' => $jalur,
                'tgl_lahir' => $faker->date($format = 'Y-m-d', $max = 'now'),
                'tempat_lahir' => $faker->city(),
                'asal_sltp' => $faker->numberBetween(10,12),
            ]);
        }
    }
}
