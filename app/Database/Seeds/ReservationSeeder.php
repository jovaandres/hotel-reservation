<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class ReservationSeeder extends Seeder
{
    public function run()
    {
        $faker = Factory::create();

        for ($i = 0; $i < 10; $i++) {
            $bookingCode = $faker->randomLetter() . $faker->randomLetter() . $faker->randomLetter() . $faker->randomNumber(4);

            $data = [
                'user_id' => $faker->numberBetween(1, 10),
                'room_id' => $faker->numberBetween(1, 20),
                'booking_code' => $bookingCode,
                'status' => $faker->randomElement(['pending', 'confirmed', 'rejected']),
                'payment' => $faker->randomElement(['cash', 'credit card']),
                'check_in_date' => $faker->dateTimeBetween('+1 week', '+2 weeks')->format('Y-m-d'),
                'check_out_date' => $faker->dateTimeBetween('+2 weeks', '+3 weeks')->format('Y-m-d'),
                'total_price' => $faker->randomFloat(2, 50, 500),
                'created_at' => $faker->dateTimeThisMonth()->format('Y-m-d H:i:s'),
                'updated_at' => $faker->dateTimeThisMonth()->format('Y-m-d H:i:s'),
            ];

            $this->db->table('reservation')->insert($data);
        }
    }
}
