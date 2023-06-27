<?php

namespace App\Controllers;

use App\Models\ReservationModel;
use App\Models\RoomModel;
use App\Models\HotelModel;
use CodeIgniter\API\ResponseTrait;

class AdminDashboard extends BaseController
{
    use ResponseTrait;

    public function index()
    {
        return view('admin/dashboard');
    }

    public function manageHotel()
    {
        try {
            $hotelModel = new HotelModel();
            $hotels = $hotelModel->findAll();

            return view('admin/manage_hotel', ['hotels' => $hotels]);
        } catch (\Exception $e) {
            // Handle the exception
            return $this->failServerError($e->getMessage());
        }
    }

    public function manageRoom()
    {
        try {
            $roomModel = new RoomModel();
            $rooms = $roomModel->getRoomsAndHotels();

            $hotelModel = new HotelModel();
            $hotels = $hotelModel->getAllHotelsName();

            return view('admin/manage_room', [
                'rooms' => $rooms,
                'hotels' => $hotels
            ]);
        } catch (\Exception $e) {
            // Handle the exception
            return $this->failServerError($e->getMessage());
        }
    }

    public function manageBooking()
    {
        try {
            $model = new ReservationModel();
            $reservations = $model->getReservations();

            return view('admin/manage_booking', [
                'bookings' => $reservations,
            ]);
        } catch (\Exception $e) {
            // Handle the exception
            return $this->failServerError($e->getMessage());
        }
    }

    public function manageUser()
    {
        try {
            $userModel = auth()->getProvider();
            $users = $userModel->findAll();

            return view('admin/manage_user', ['users' => $users]);
        } catch (\Exception $e) {
            // Handle the exception
            return $this->failServerError($e->getMessage());
        }
    }
}
