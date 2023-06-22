<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class HotelSeeder extends Seeder
{
    public function run()
    {
        $faker = Factory::create();

        $data = [];

        // Generate 5 fake hotel records
        for ($i = 0; $i < 10; $i++) {
            $data[] = [
                'name'        => $faker->company,
                'description' => $faker->paragraph,
                'address'     => $faker->address,
                'created_at'  => $faker->dateTimeThisMonth()->format('Y-m-d H:i:s'),
                'updated_at'  => $faker->dateTimeThisMonth()->format('Y-m-d H:i:s'),
            ];
        }

        $this->db->table('hotel')->insertBatch($data);
    }
}
