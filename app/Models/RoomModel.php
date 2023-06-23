<?php

namespace App\Models;

use CodeIgniter\Model;

class RoomModel extends Model
{
    protected $table = 'room';
    protected $primaryKey = 'id';
    protected $allowedFields = ['hotel_id', 'room_type', 'price_per_night'];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function getRooms()
    {
        return $this->findAll();
    }

    public function getRoom($id)
    {
        return $this->find($id);
    }

    public function createRoom($data)
    {
        return $this->insert($data);
    }

    public function updateRoom($id, $data)
    {
        return $this->update($id, $data);
    }

    public function deleteRoom($id)
    {
        return $this->delete($id);
    }

    public function searchRooms($location, $startDate, $endDate, $roomType)
    {
        return $this->select('rooms.*, hotels.name as hotel_name')
            ->join('hotels', 'hotels.id = rooms.hotel_id')
            ->where('hotels.location', $location)
            ->where('rooms.room_type', $roomType)
            ->where("NOT (start_date >= '$endDate' OR end_date <= '$startDate')")
            ->findAll();
    }
}