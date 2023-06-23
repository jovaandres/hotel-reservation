<?php

namespace App\Controllers;

use App\Models\HotelModel;
use App\Models\RoomModel;

class Home extends BaseController
{
    public function index()
    {
        $roomModel = new RoomModel();

        $rooms = $roomModel->getRoomsAndHotels();

        return view('home', [
            'rooms' => $rooms,
        ]);
    }
}
