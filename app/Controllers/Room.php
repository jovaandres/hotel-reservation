<?php

namespace App\Controllers;

use App\Models\RoomModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Controller;

class Room extends Controller
{
    use ResponseTrait;

    public function index()
    {
        $model = new RoomModel();
        $rooms = $model->getRooms();

        return $this->respond($rooms);
    }

    public function show($id)
    {
        $model = new RoomModel();
        $room = $model->getRoom($id);

        if ($room === null) {
            return $this->failNotFound('Room not found.');
        }

        return $this->respond($room);
    }

    public function create()
    {
        // Code to create a new room
    }

    public function update($id)
    {
        // Code to update an existing room
    }

    public function delete($id)
    {
        // Code to delete a room
    }
}