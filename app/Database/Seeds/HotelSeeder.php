<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class HotelSeeder extends Seeder
{
    public function run()
    {
        $description = [
            "Selamat datang di hotel mewah kami",
            "Alami lambang kemewahan dan kenyamanan di hotel indah kami. Terletak di jantung kota yang ramai, hotel kami menawarkan perpaduan sempurna antara keanggunan, kenyamanan, dan layanan terbaik. Apakah Anda sedang bepergian untuk bisnis atau kesenangan, kami bertujuan untuk memberikan Anda pengalaman menginap yang tak terlupakan.",
            "Akomodasi Mewah",
            "Manjakan diri Anda di kamar dan suite kami yang luas dan berperabotan indah. Setiap kamar dirancang dengan cermat untuk menyediakan tempat peristirahatan yang tenang, menampilkan fasilitas modern, perabotan mewah, dan pemandangan cakrawala kota yang menakjubkan. Nikmati tidur nyenyak di tempat tidur premium kami dan bangun dengan segar untuk memulai hari Anda.",
            "Santapan Luar Biasa",
            "Nikmati perjalanan kuliner di restoran terkenal kami, tempat koki ahli kami membuat hidangan lezat untuk memuaskan setiap selera. Dari pengalaman bersantap mewah hingga tempat makan kasual, kami menawarkan berbagai macam kuliner yang nikmat. Bersantai dan bersantailah di bar kami yang penuh gaya, menawarkan pilihan koktail buatan tangan dan minuman beralkohol premium.",
            "Fasilitas Kelas Dunia",
            "Manjakan diri Anda dengan fasilitas kelas dunia kami yang dirancang untuk memenuhi setiap kebutuhan Anda. Berenanglah di kolam kami yang berkilauan, segarkan indra Anda di spa dan pusat kesehatan kami, atau pertahankan program kebugaran Anda di pusat kebugaran kami yang canggih. Staf kami yang berdedikasi selalu tersedia untuk memastikan kenyamanan dan kepuasan maksimal Anda.",
            "Peristiwa yang Tak Terlupakan",
            "Selenggarakan acara dan konferensi khusus Anda di ruang acara kami yang canggih. Baik itu pertemuan perusahaan, pernikahan akbar, atau perayaan sosial, tempat serbaguna kami dapat mengakomodasi kebutuhan Anda. Perencana acara profesional kami akan membantu Anda di setiap langkah untuk memastikan acara yang lancar dan berkesan.",
            "Lokasi utama",
            "Berlokasi nyaman di jantung kota, hotel kami menyediakan akses mudah ke tempat-tempat populer, kawasan perbelanjaan, dan pusat bisnis. Jelajahi lanskap kota yang semarak, rendam diri Anda dalam budaya lokal, dan temukan permata tersembunyi yang menjadikan tujuan kami unik.",
            "Layanan Luar Biasa",
            "Di hotel kami, kami bangga memberikan layanan luar biasa yang melebihi harapan Anda. Tim profesional perhotelan kami yang berdedikasi berkomitmen untuk memberikan perhatian khusus kepada setiap tamu. Dari saat Anda tiba hingga keberangkatan Anda, kami berusaha untuk membuat masa tinggal Anda benar-benar tak terlupakan.",
            "Pesan masa tinggal Anda bersama kami hari ini dan rasakan puncak kemewahan dan keramahtamahan. Kami berharap dapat menyambut Anda di hotel kami yang luar biasa."
        ];

        $faker = Factory::create('id_ID');
        $fakerSec = Factory::create();

        $data = [];

        // Generate 5 fake hotel records
        for ($i = 0; $i < 10; $i++) {
            $data[] = [
                'name'        => $fakerSec->company,
                'description' => $faker->randomElement($description),
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
