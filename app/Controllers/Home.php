<?php

namespace App\Controllers;

use App\Models\RoomModel;

class Home extends BaseController
{
    public function index()
    {
        try {
            $roomModel = new RoomModel();
            $rooms = $roomModel->getRoomsAndHotels();

            return view('home', [
                'rooms' => $rooms,
            ]);
        } catch (\Exception $e) {
            // Handle the exception
            return view('error', ['message' => $e->getMessage()]);
        }
    }
}
