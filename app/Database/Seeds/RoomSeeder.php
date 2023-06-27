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
                'hotel_id'        => $faker->numberBetween(1, 10),
                'room_type'       => $faker->randomElement(['standard', 'deluxe', 'suite']),
                'occupancy'       => rand(1, 2),
                'price_per_night' => $faker->randomFloat(2, 200000, 1000000),
                'created_at'      => $faker->dateTimeThisMonth()->format('Y-m-d H:i:s'),
                'updated_at'      => $faker->dateTimeThisMonth()->format('Y-m-d H:i:s'),
            ];
        }

        $this->db->table('room')->insertBatch($data);
    }
}
