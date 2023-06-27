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
      $hotelModel = new HotelModel();
      $hotels = $hotelModel->findAll();
      
      return view('admin/manage_hotel', ['hotels' => $hotels]);
    }

    public function manageRoom()
    {
      $roomModel = new RoomModel();
      $rooms = $roomModel->getRoomsAndHotels();
      
      $hotelModel = new HotelModel();
      $hotels = $hotelModel->getAllHotelsName();
      
      return view('admin/manage_room', [
        'rooms' => $rooms,
        'hotels' => $hotels
      ]);
    }

    public function manageBooking()
    {
      $model = new ReservationModel();
      $reservations = $model->getReservations();

      return view('admin/manage_booking', [
        'bookings' => $reservations,
    ]);
    }

    public function manageUser()
    {
      $userModel = auth()->getProvider();
      $users = $userModel->findAll();

      return view('admin/manage_user', ['users' => $users]);
    }
}
