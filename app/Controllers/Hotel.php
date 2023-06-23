<?php

namespace App\Controllers;

use App\Models\HotelModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Controller;

class Hotel extends BaseController
{
    use ResponseTrait;

    public function index()
    {
        $model = new HotelModel();
        $hotels = $model->getHotels();

        return $this->respond($hotels);
    }

    public function show($id)
    {
        $model = new HotelModel();
        $hotel = $model->getHotel($id);

        if ($hotel === null) {
            return $this->failNotFound('Hotel not found.');
        }

        return $this->respond($hotel);
    }

    public function create()
    {
        // Code to create a new hotel
    }

    public function update($id)
    {
        // Code to update an existing hotel
    }

    public function delete($id)
    {
        // Code to delete a hotel
    }
}