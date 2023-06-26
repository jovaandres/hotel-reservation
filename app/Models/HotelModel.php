<?php

namespace App\Models;

use CodeIgniter\Model;

class HotelModel extends Model
{
    protected $table = 'hotel';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'description', 'address', 'city', 'phone', 'email', 'image'];

    public function getHotels()
    {
        return $this->findAll();
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
