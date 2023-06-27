<?php

namespace App\Controllers;

use App\Models\RoomModel;
use App\Models\ReservationModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Controller;

class Reservation extends Controller
{
    use ResponseTrait;

    public function index()
    {
        try {
            $authenticator = auth('session')->getAuthenticator();
            $user = $authenticator->getUser();

            $model = new ReservationModel();
            $reservations = $model->getReservation($user->id);

            return view('reservation', [
                'bookings' => $reservations,
            ]);
        } catch (\Exception $e) {
            // Handle the exception
            return $this->failServerError($e->getMessage());
        }
    }

    public function pay()
    {
        try {
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
        } catch (\Exception $e) {
            // Handle the exception
            return redirect()->to('/reservation')->with('error', $e->getMessage());
        }
    }

    public function cancel()
    {
        try {
            $booking_id = $this->request->getPost('id');

            $data = [
                'status' => 'canceled',
            ];

            $model = new ReservationModel();
            $model->updateReservation($booking_id, $data);

            return redirect()->to('/reservation')->with('success', 'Booking cancelled.');
        } catch (\Exception $e) {
            // Handle the exception
            return redirect()->to('/reservation')->with('error', $e->getMessage());
        }
    }

    public function accept()
    {
        try {
            $booking_id = $this->request->getPost('id');

            $data = [
                'status' => 'confirmed',
            ];

            $model = new ReservationModel();
            $model->updateReservation($booking_id, $data);

            return redirect()->to('/admin/booking')->with('success', 'Booking confirmed.');
        } catch (\Exception $e) {
            // Handle the exception
            return redirect()->to('/admin/booking')->with('error', $e->getMessage());
        }
    }

    public function reject()
    {
        try {
            $booking_id = $this->request->getPost('id');

            $data = [
                'status' => 'rejected',
            ];

            $model = new ReservationModel();
            $model->updateReservation($booking_id, $data);

            return redirect()->to('/admin/booking')->with('success', 'Booking rejected.');
        } catch (\Exception $e) {
            // Handle the exception
            return redirect()->to('/admin/booking')->with('error', $e->getMessage());
        }
    }

    public function show($id)
    {
        try {
            $model = new ReservationModel();
            $reservation = $model->getReservation($id);

            if ($reservation === null) {
                return $this->redirect()->to('/reservation')->with('error', 'Booking not found.');
            }

            return $this->respond($reservation);
        } catch (\Exception $e) {
            // Handle the exception
            return $this->failServerError($e->getMessage());
        }
    }

    public function create()
    {
        try {
            $authenticator = auth('session')->getAuthenticator();
            $currentUser = $authenticator->getUser();

            $room_id = $this->request->getPost('room_id');
            $user_id = $currentUser->id;

            $roomModel = new RoomModel();
            $room = $roomModel->getRoom($room_id);

            $model = new ReservationModel();

            $words = range('a', 'z');

            // Get a random word from the array
            $randomWord1 = $words[array_rand($words)];
            $randomWord2 = $words[array_rand($words)];
            $randomWord3 = $words[array_rand($words)];

            // Generate a random number with four digits
            $randomNumber = sprintf("%04d", mt_rand(0, 9999));

            // Concatenate the random word and number
            $randomCode = $randomWord1 . $randomWord2 . $randomWord3 . $randomNumber;
            $booking_code = $randomCode;

            $status = 'pending';
            $check_in_date = $this->request->getPost('check_in_date');
            $check_out_date = $this->request->getPost('check_out_date');

            // Create DateTime objects for the check-in and check-out dates
            $checkIn = new \DateTime($check_in_date);
            $checkOut = new \DateTime($check_out_date);

            // Calculate the interval between the dates
            $interval = $checkIn->diff($checkOut);

            // Get the number of days in the interval
            $numberOfDays = $interval->days;

            $total_price = $room['price_per_night'] * $numberOfDays;

            $data = [
                'user_id' => $user_id,
                'room_id' => $room_id,
                'booking_code' => $booking_code,
                'status' => $status,
                'check_in_date' => $check_in_date,
                'check_out_date' => $check_out_date,
                'total_price' => $total_price
            ];

            $model->createReservation($data);

            // Redirect back to the room detail page after creating the review
            return redirect()->back()->with('success', 'Booking created.');
        } catch (\Exception $e) {
            // Handle the exception
            return redirect()->to('/room/' . $room_id)->with('error', $e->getMessage());
        }
    }
}
