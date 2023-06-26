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
        $model = new RoomModel();
        $room = $model->getRoom($id);

        $modelReview = new ReviewModel();
        $reviews = $modelReview->getReview($room['hotel_id']);

        $modelHotel = new HotelModel();
        $hotel = $modelHotel->getHotel($room['hotel_id']);

        #return $this->respond($rooms);
        return view('room', [
            'rooms' => $room,
            'reviews' => $reviews,
            'hotel' => $hotel
        ]);
    }

    public function create()
    {
        $hotel_id = $this->request->getPost('hotel_id');

        $model = new RoomModel();

        $hotelModel = new HotelModel();
        $hotel = $hotelModel->getHotel($hotel_id);

        if ($hotel === null) {
            return $this->failNotFound('Hotel not found.');
        }

        $data = [
            'hotel_id' => $hotel_id,
            'room_type' => $this->request->getPost('room_type'),
            'occupancy' => $this->request->getPost('occupancy'),
            'price_per_night' => $this->request->getPost('price_per_night'),
        ];

        $model->insert($data);

        return redirect()->back()->with('success', 'Room created.');
    }

    public function update()
    {
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
    }

    public function delete()
    {
        $model = new RoomModel();

        $id = $this->request->getPost('id');

        $room = $model->getRoom($id);

        if ($room === null) {
            return redirect()->back()->with('error', 'Room not found.');
        }

        $model->deleteRoom($id);

        return redirect()->back()->with('success', 'Room deleted.');
    }

    public function showReview($id)
    {
        $model = new ReviewModel();
        $review = $model->getReview($id);

        if ($review === null) {
            return $this->failNotFound('Review not found.');
        }

        return $this->respond($review);
    }

    public function createReview()
    {
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
        return redirect()->to('/room/' . $room_id);
    }

    public function updateReview($id)
    {
        // Code to update an existing review
    }

    public function deleteReview($id)
    {
        // Code to delete a review
    }
}