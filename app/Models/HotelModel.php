<?php

namespace App\Models;

use CodeIgniter\Model;

class HotelModel extends Model
{
    protected $table = 'hotel';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'description', 'address', 'city', 'phone', 'email', 'image_id'];

    public function getHotels()
    {
        return $this->findAll();
    }

    public function getHotelsWithCheapestPrice()
    {
        return $this->select('hotel.*, MIN(room.price_per_night) as price_per_night, images.first_image as hotel_image')
            ->join('room', 'hotel.id = room.hotel_id')
            ->join('images', 'images.id = hotel.image_id')
            ->groupBy('hotel.id')
            ->findAll();
    }

    public function getRoomsOfHotel($id)
    {
        return $this->select('room.*')
            ->join('room', 'hotel.id = room.hotel_id')
            ->where('hotel.id', $id)
            ->findAll();
    }

    public function getHotelWithImage($id)
    {
        return $this->select('hotel.*, images.*')
            ->join('images', 'images.id = hotel.image_id')
            ->where('hotel.id', $id)
            ->first();
    }

    public function getAllHotelsName()
    {
        return $this->select('id, name')->findAll();
    }

    public function getHotel($id)
    {
        return $this->find($id);
    }

    public function createHotel($data)
    {
        return $this->insert($data);
    }

    public function updateHotel($id, $data)
    {
        return $this->update($id, $data);
    }

    public function deleteHotel($id)
    {
        return $this->delete($id);
    }
}
