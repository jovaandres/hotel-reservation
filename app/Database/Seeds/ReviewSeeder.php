<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class ReviewSeeder extends Seeder
{
    public function run()
    {
        $faker = Factory::create();

        $data = [];

        // Generate 20 fake room records
        for ($i = 0; $i < 40; $i++) {
            $data[] = [
                'hotel_id'        => $faker->numberBetween(1, 10),
                'user_id'         => $faker->numberBetween(2, 10),
                'rating'          => $faker->numberBetween(1, 5),
                'comment'         => $faker->randomElement(['Bagus', 'Bersih', 'Mahal']),
            ];
        }

        $this->db->table('review')->insertBatch($data);
    }
}
