<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class RoomSeeder extends Seeder
{
    public function run()
    {
        $faker = Factory::create();

        $data = [];

        // Generate 20 fake room records
        for ($i = 0; $i < 20; $i++) {
            $data[] = [
                'hotel_id'        => rand(1, 5),
                'room_type'       => $faker->word,
                'price_per_night' => $faker->randomFloat(2, 50, 500),
                'created_at'      => $faker->dateTimeThisMonth()->format('Y-m-d H:i:s'),
                'updated_at'      => $faker->dateTimeThisMonth()->format('Y-m-d H:i:s'),
            ];
        }

        $this->db->table('room')->insertBatch($data);
    }
}
