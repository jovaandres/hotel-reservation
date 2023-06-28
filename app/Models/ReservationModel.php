<?php

namespace App\Models;

use CodeIgniter\Model;

class ReservationModel extends Model
{
    protected $table = 'reservation';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'room_id', 'booking_code', 'status', 'payment', 'transfer_evidence', 'check_in_date', 'check_out_date', 'total_price'];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function getReservations()
    {
        return $this->select('reservation.*, room.room_type, hotel.name as hotel_name, images.first_image as hotel_image')
            ->join('room', 'room.id = reservation.room_id')
            ->join('hotel', 'hotel.id = room.hotel_id')
            ->join('images', 'images.id = hotel.image_id')
            ->findAll();
    }

    public function getReservation($user_id)
    {
        return $this->select('reservation.*, room.room_type, hotel.id as hotel_id, hotel.name as hotel_name, images.first_image as hotel_image')
            ->join('room', 'room.id = reservation.room_id')
            ->join('hotel', 'hotel.id = room.hotel_id')
            ->join('images', 'images.id = hotel.image_id')
            ->where('reservation.user_id', $user_id)
            ->findAll();
    }

    public function getPendingBooking($user_id, $hotel_id)
    {
        return $this->select('reservation.*')
            ->join('room', 'room.id = reservation.room_id')
            ->join('hotel', 'hotel.id = room.hotel_id')
            ->where('reservation.user_id', $user_id)
            ->where('reservation.status', 'pending')
            ->where('hotel.id', $hotel_id)
            ->first();
    }

    public function createReservation($data)
    {
        return $this->insert($data);
    }

    public function updateReservation($id, $data)
    {
        return $this->update($id, $data);
    }

    public function updateReservationByBookingCode($booking_code, $data)
    {
        return $this->where('booking_code', $booking_code)->set($data)->update();
    }

    public function deleteReservation($id)
    {
        return $this->delete($id);
    }
}