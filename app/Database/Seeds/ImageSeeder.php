<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class ImageSeeder extends Seeder
{
    public function run()
    {
        $imgList = [
          'https://cdn.pixabay.com/photo/2016/03/28/09/34/bedroom-1285156_1280.jpg',
          'https://cdn.pixabay.com/photo/2016/10/18/09/02/hotel-1749602_640.jpg',
          'https://cdn.pixabay.com/photo/2020/10/18/09/16/bedroom-5664221_640.jpg',
          'https://cdn.pixabay.com/photo/2019/08/19/13/58/bed-4416515_640.jpg',
          'https://cdn.pixabay.com/photo/2019/05/28/00/15/indoors-4234071_640.jpg',
          'https://cdn.pixabay.com/photo/2018/06/14/21/15/bedroom-3475656_640.jpg',
          'https://cdn.pixabay.com/photo/2016/06/10/01/05/hotel-room-1447201_640.jpg',
          'https://cdn.pixabay.com/photo/2017/01/14/12/48/hotel-1979406_640.jpg',
          'https://cdn.pixabay.com/photo/2016/12/11/18/10/apartment-1899964_640.jpg',
          'https://cdn.pixabay.com/photo/2017/04/28/22/16/room-2269594_640.jpg',
          'https://cdn.pixabay.com/photo/2016/09/18/03/28/travel-1677347_640.jpg',
          'https://cdn.pixabay.com/photo/2018/02/24/17/17/window-3178666_640.jpg',
          'https://cdn.pixabay.com/photo/2018/01/06/16/32/window-3065340_640.jpg',
          'https://cdn.pixabay.com/photo/2016/11/14/02/29/apartment-1822410_640.jpg',
          'https://cdn.pixabay.com/photo/2014/10/16/08/39/bedroom-490779_640.jpg',
          'https://cdn.pixabay.com/photo/2015/09/21/09/53/villa-cortine-palace-949547_640.jpg',
          'https://cdn.pixabay.com/photo/2015/01/16/11/19/hotel-601327_640.jpg',
          'https://cdn.pixabay.com/photo/2016/11/14/02/28/apartment-1822409_640.jpg',
          'https://cdn.pixabay.com/photo/2016/04/15/11/45/hotel-1330841_640.jpg',
          'https://cdn.pixabay.com/photo/2014/05/17/18/03/lobby-346426_640.jpg',
          'https://cdn.pixabay.com/photo/2018/08/17/03/49/apartment-3612030_640.jpg',
          'https://cdn.pixabay.com/photo/2016/07/08/23/36/beach-house-1505461_640.jpg',
          'https://cdn.pixabay.com/photo/2020/01/15/18/01/room-4768551_640.jpg',
          'https://cdn.pixabay.com/photo/2020/02/01/06/12/living-room-4809587_640.jpg',
          'https://cdn.pixabay.com/photo/2016/04/15/11/46/bedroom-1330846_640.jpg',
          'https://cdn.pixabay.com/photo/2016/03/02/20/41/hotel-1233020_640.jpg',
          'https://cdn.pixabay.com/photo/2017/04/28/22/14/room-2269591_640.jpg',
          'https://cdn.pixabay.com/photo/2016/03/16/22/17/hotel-room-1261900_640.jpg',
          'https://cdn.pixabay.com/photo/2014/09/25/18/05/bedroom-460762_640.jpg',
          'https://cdn.pixabay.com/photo/2014/05/21/14/56/bedroom-349699_640.jpg',
          'https://cdn.pixabay.com/photo/2016/04/15/11/43/hotel-1330834_640.jpg',
          'https://cdn.pixabay.com/photo/2016/07/08/23/33/hotel-room-1505455_640.jpg',
          'https://cdn.pixabay.com/photo/2021/10/06/15/05/bedroom-6686061_640.jpg',
          'https://cdn.pixabay.com/photo/2019/06/02/12/27/apartment-4246371_640.jpg',
          'https://cdn.pixabay.com/photo/2020/10/18/09/16/bedroom-5664223_640.jpg'
        ];

        $faker = Factory::create();

        $data = [];

        // Generate 20 fake image records
        for ($i = 0; $i < 10; $i++) {
            $data[] = [
              'first_image' => $imgList[$i],
              'second_image' => $imgList[$i + 10],
              'third_image' => $imgList[$i + 20],
            ];
        }

        $this->db->table('images')->insertBatch($data);
    }
}
