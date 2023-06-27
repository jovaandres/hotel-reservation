<?php

namespace App\Models;

use CodeIgniter\Model;

class RoomModel extends Model
{
    protected $table = 'room';
    protected $primaryKey = 'id';
    protected $allowedFields = ['hotel_id', 'room_type', 'price_per_night', 'occupancy'];

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

    public function getRoomsAndHotels()
    {
        return $this->select('room.*, hotel.name as hotel_name, images.first_image as hotel_image')
            ->join('hotel', 'hotel.id = room.hotel_id')
            ->join('images', 'images.id = hotel.image_id')
            ->findAll();
    }

    public function getRoomAndImage($id)
    {
        return $this->select('room.id as room_id, room.*, hotel.name as hotel_name, images.*')
            ->join('hotel', 'hotel.id = room.hotel_id')
            ->join('images', 'images.id = hotel.image_id')
            ->where('room.id', $id)
            ->first();
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