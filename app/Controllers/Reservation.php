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
        $authenticator = auth('session')->getAuthenticator();
        $user = $authenticator->getUser();

        $model = new ReservationModel();
        $reservations = $model->getReservation($user->id);

        return view('reservation', [
            'bookings' => $reservations,
        ]);
    }

    public function pay()
    {
        $model = new ReservationModel();

        $booking_id = $this->request->getPost('id');
        $payment_method = $this->request->getPost('payment_method');
        $transferEvidence = $this->request->getFile('transfer_evidence');

        if ($transferEvidence->isValid() && !$transferEvidence->hasMoved()) {
            $newName = $transferEvidence->getRandomName();
            $transferEvidence->move('./uploads/payment', $newName);
            
            $paymentData = [
                'status' => 'transferred',
                'payment' => $payment_method,
                'transfer_evidence' => $newName,
            ];

            $model->updateReservation($booking_id, $paymentData);

            return redirect()->to('/reservation')->with('success', 'Payment created.');
        }

        return redirect()->to('/reservation')->with('error', 'Payment failed.');
    }

    public function cancel()
    {
        $booking_id = $this->request->getPost('id');

        $data = [
            'status' => 'canceled',
        ];

        $model = new ReservationModel();
        $model->updateReservation($booking_id, $data);

        return redirect()->to('/reservation')->with('success', 'Booking cancelled.');
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