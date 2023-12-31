<?php

namespace App\Controllers;

use App\Models\RoomModel;
use App\Models\ReservationModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Controller;
use TCPDF;

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

            $groupReservation = [];
            foreach ($reservations as $reservation) {
                $groupReservation[$reservation['booking_code']][] = $reservation;
            }

            return view('reservation', [
                'bookingGroup' => $groupReservation,
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

            $booking_code = $this->request->getPost('code');
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

                $model->updateReservationByBookingCode($booking_code, $paymentData);

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
            $booking_code = $this->request->getPost('code');

            $data = [
                'status' => 'canceled',
            ];

            $model = new ReservationModel();
            $model->updateReservationByBookingCode($booking_code, $data);

            return redirect()->to('/reservation')->with('success', 'Booking cancelled.');
        } catch (\Exception $e) {
            // Handle the exception
            return redirect()->to('/reservation')->with('error', $e->getMessage());
        }
    }

    public function accept()
    {
        try {
            $booking_code = $this->request->getPost('code');

            $data = [
                'status' => 'confirmed',
            ];

            $model = new ReservationModel();
            $model->updateReservationByBookingCode($booking_code, $data);

            return redirect()->to('/admin/booking')->with('success', 'Booking confirmed.');
        } catch (\Exception $e) {
            // Handle the exception
            return redirect()->to('/admin/booking')->with('error', $e->getMessage());
        }
    }

    public function reject()
    {
        try {
            $booking_code = $this->request->getPost('code');

            $data = [
                'status' => 'rejected',
            ];

            $model = new ReservationModel();
            $model->updateReservationByBookingCode($booking_code, $data);

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
            $hotel_id = $this->request->getPost('hotel_id');
            $user_id = $currentUser->id;

            $roomModel = new RoomModel();
            $room = $roomModel->getRoom($room_id);

            $model = new ReservationModel();

            // Check if there is pending booking for the same hotel
            $pendingBooking = $model->getPendingBooking($user_id, $hotel_id);

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

            if ($pendingBooking) {
                $booking_code = $pendingBooking['booking_code'];
            }

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
            return redirect()->to('/hotel/' . $hotel_id)->with('error', $e->getMessage());
        }
    }

    public function reservationPdf($groupReservation, $user)
    {
        $html = '<table border="1" style="padding: 10px;">';

        $html .= '<tr>';
        $html .= '<td><strong>Hotel Name</strong></td>';
        $html .= '<td><strong>Booking Code</strong></td>';
        $html .= '<td><strong>Room Type</strong></td>';
        $html .= '<td><strong>Date</strong></td>';
        $html .= '<td><strong>Status</strong></td>';
        $html .= '<td><strong>Total Price</strong></td>';
        $html .= '</tr>';
        
        foreach ($groupReservation as $bookings) {
            foreach ($bookings as $booking) {
                $html .= '<tr>';
                $html .= '<td>' . $booking['hotel_name'] . '</td>';
                $html .= '<td>' . strtoupper($booking['booking_code']) . '</td>';
                $html .= '<td>' . $booking['room_type'] . '</td>';
                $html .= '<td>' . date("M d, Y", strtotime($booking['check_in_date'])) . " - " . date("M d, Y", strtotime($booking['check_out_date'])) . '</td>';
                $html .= '<td>' . strtoupper($booking['status']) . '</td>';
                $html .= '<td>Rp ' . number_format($booking['total_price'], 0, '.', '.') . '</td>';
                $html .= '</tr>';
            }
        }
        $html .= '</table>';

        return $html;
    }
    
    public function exportToPdf()
    {
        try {
            $authenticator = auth('session')->getAuthenticator();
            $user = $authenticator->getUser();
    
            $model = new ReservationModel();
            $reservations = [];

            if ($user->is_admin) {
                $reservations = $model->getReservations();
            } else {
                $reservations = $model->getReservation($user->id);
            }
    
            $groupReservation = [];
            foreach ($reservations as $reservation) {
                $groupReservation[$reservation['booking_code']][] = $reservation;
            }

            $html = $this->reservationPdf($groupReservation, $user);
    
            $pdf = new TCPDF();
            $pdf->AddPage();
            $pdf->writeHTML($html, true, false, true, false, '');
            $pdf->Output('booking_management.pdf', 'D');
        } catch (\Exception $e) {
            // Handle the exception
            return $this->failServerError($e->getMessage());
        }
    }
}
