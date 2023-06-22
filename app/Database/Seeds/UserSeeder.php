<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class UserSeeder extends Seeder
{
    public function run()
    {
        $faker = Factory::create();

        $data = [
            [
                'username'   => 'admin',
                'password'   => password_hash('admin123', PASSWORD_DEFAULT),
                'email'      => 'admin@example.com',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];

        // Generate 10 fake user records
        for ($i = 0; $i < 10; $i++) {
            $data[] = [
                'username'   => $faker->userName,
                'password'   => password_hash('password123', PASSWORD_DEFAULT),
                'email'      => $faker->email,
                'created_at' => $faker->dateTimeThisMonth()->format('Y-m-d H:i:s'),
                'updated_at' => $faker->dateTimeThisMonth()->format('Y-m-d H:i:s'),
            ];
        }

        $this->db->table('users')->insertBatch($data);
    }
}
