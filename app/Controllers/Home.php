<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use App\Models\HotelModel;

class Home extends BaseController
{
    use ResponseTrait;

    public function index()
    {
        try {
            $hotelModel = new HotelModel();
            $hotels = $hotelModel->getHotelsWithCheapestPrice();

            return view('home', [
                'hotels' => $hotels,
            ]);
        } catch (\Exception $e) {
            // Handle the exception
            return view('error', ['message' => $e->getMessage()]);
        }
    }
}
