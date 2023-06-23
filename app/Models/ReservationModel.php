<?php

namespace App\Models;

use CodeIgniter\Model;

class ReservationModel extends Model
{
    protected $table = 'reservation';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'room_id', 'check_in_date', 'check_out_date', 'total_price'];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function getReservations()
    {
        return $this->select('reservation.*, room.room_type, hotel.name as hotel_name')
            ->join('room', 'room.id = reservation.room_id')
            ->join('hotel', 'hotel.id = room.hotel_id')
            ->findAll();
    }

    public function getReservation($id)
    {
        return $this->find($id);
    }

    public function createReservation($data)
    {
        return $this->insert($data);
    }

    public function updateReservation($id, $data)
    {
        return $this->update($id, $data);
    }

    public function deleteReservation($id)
    {
        return $this->delete($id);
    }
}