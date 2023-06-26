<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;
use CodeIgniter\Shield\Entities\User;

class UserSeeder extends Seeder
{
    public function run()
    {
       $faker = Factory::create('id_ID');

       $users = auth()->getProvider();

        // Create users with additional fields
        $user = new User([
            'username' => 'admin',
            'email' => 'admin@admin.com',
            'password' => 'admin123',
        ]);

        $users->save($user);

        $db = \Config\Database::connect();
        $builder = $db->table('users');
        $builder->where('username', 'admin')->update(['is_admin' => 1, 'name' => 'Admin User', 'phone' => $faker->phoneNumber]);


        // using faker
        for ($i = 0; $i < 10; $i++) {
            $username = $faker->unique()->userName;
            $user = new User([
                'username' => $username,
                'email' => $username . '@user.com',
                'password' => 'user123',
            ]);

            $users->save($user);
            $builder->where('username', $username)->update(['name' => $faker->name, 'phone' => $faker->phoneNumber]);
        }
    }
}