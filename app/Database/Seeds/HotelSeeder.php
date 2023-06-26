<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class HotelSeeder extends Seeder
{
    public function run()
    {
        $faker = Factory::create('id_ID');
        $fakerSec = Factory::create();

        $data = [];

        // Generate 5 fake hotel records
        for ($i = 0; $i < 10; $i++) {
            $data[] = [
                'name'        => $fakerSec->company,
                'description' => $faker->paragraph,
                'address'     => $faker->address,
                'city'        => $faker->city,
                'phone'       => $faker->phoneNumber,
                'email'       => $faker->email,
                'image_id'    => $i + 1,
                'created_at'  => $faker->dateTimeThisMonth()->format('Y-m-d H:i:s'),
                'updated_at'  => $faker->dateTimeThisMonth()->format('Y-m-d H:i:s'),
            ];
        }

        $this->db->table('hotel')->insertBatch($data);
    }
}
