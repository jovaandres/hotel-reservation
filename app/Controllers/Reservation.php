<?php

namespace App\Controllers;

use App\Models\ReservationModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Controller;

class Reservation extends Controller
{
    use ResponseTrait;

    public function index()
    {
        $model = new ReservationModel();
        $reservations = $model->getReservations();

        return view('reservation', [
            'bookings' => $reservations,
        ]);
    }

    public function show($id)
    {
        $model = new ReservationModel();
        $reservation = $model->getReservation($id);

        if ($reservation === null) {
            return $this->failNotFound('Reservation not found.');
        }

        return $this->respond($reservation);
    }

    public function create()
    {
        // Code to create a new reservation
    }

    public function update($id)
    {
        // Code to update an existing reservation
    }

    public function delete($id)
    {
        // Code to delete a reservation
    }
}