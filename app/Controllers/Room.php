<?php

namespace App\Controllers;

use App\Models\HotelModel;
use App\Models\RoomModel;
use App\Models\ReviewModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Controller;

class Room extends Controller
{
    use ResponseTrait;

    public function index($id)
    {
        try {
            $model = new RoomModel();
            $room = $model->getRoomAndImage($id);

            if ($room === null) {
                return view('404');
            }

            $modelReview = new ReviewModel();
            $reviews = $modelReview->getReview($room['hotel_id']);

            $modelHotel = new HotelModel();
            $hotel = $modelHotel->getHotel($room['hotel_id']);

            return view('room', [
                'rooms' => $room,
                'reviews' => $reviews,
                'hotel' => $hotel
            ]);
        } catch (\Exception $e) {
            // Handle the exception
            return $this->failServerError($e->getMessage());
        }
    }

    public function create()
    {
        try {
            $hotel_id = $this->request->getPost('hotel_id');

            $hotelModel = new HotelModel();
            $hotel = $hotelModel->getHotel($hotel_id);

            if ($hotel === null) {
                return $this->failNotFound('Hotel not found.');
            }

            $model = new RoomModel();

            $data = [
                'hotel_id' => $hotel_id,
                'room_type' => $this->request->getPost('room_type'),
                'occupancy' => $this->request->getPost('occupancy'),
                'price_per_night' => $this->request->getPost('price_per_night'),
            ];

            $model->insert($data);

            return redirect()->back()->with('success', 'Room created.');
        } catch (\Exception $e) {
            // Handle the exception
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function update()
    {
        try {
            $model = new RoomModel();

            $id = $this->request->getPost('id');
            $room_type = $this->request->getPost('room_type');
            $occupancy = $this->request->getPost('capacity');
            $price_per_night = $this->request->getPost('price_per_night');

            $room = $model->getRoom($id);

            if ($room === null) {
                return redirect()->back()->with('error', 'Room not found.');
            }

            $data = [
                'room_type' => $room_type,
                'occupancy' => $occupancy,
                'price_per_night' => $price_per_night
            ];

            $model->updateRoom($id, $data);

            return redirect()->back()->with('success', 'Room updated.');
        } catch (\Exception $e) {
            // Handle the exception
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function delete()
    {
        try {
            $model = new RoomModel();

            $id = $this->request->getPost('id');

            $room = $model->getRoom($id);

            if ($room === null) {
                return redirect()->back()->with('error', 'Room not found.');
            }

            $model->deleteRoom($id);

            return redirect()->back()->with('success', 'Room deleted.');
        } catch (\Exception $e) {
            // Handle the exception
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function showReview($id)
    {
        try {
            $model = new ReviewModel();
            $review = $model->getReview($id);

            if ($review === null) {
                return $this->failNotFound('Review not found.');
            }

            return $this->respond($review);
        } catch (\Exception $e) {
            // Handle the exception
            return $this->failServerError($e->getMessage());
        }
    }

    public function createReview()
    {
        try {
            $model = new ReviewModel();

            $authenticator = auth('session')->getAuthenticator();
            $currentUser = $authenticator->getUser();

            $room_id = $this->request->getPost('room_id');

            $data = [
                'rating' => $this->request->getPost('rating'),
                'comment' => $this->request->getPost('comment'),
                'hotel_id' => $this->request->getPost('hotel_id'),
                'user_id' => $currentUser->id
            ];

            $model->createReview($data);

            // Redirect back to the room detail page after creating the review
            return redirect()->back()->with('success', 'Review created.');
        } catch (\Exception $e) {
            // Handle the exception
            return redirect()->to('/room/' . $room_id)->with('error', $e->getMessage());
        }
    }
}
