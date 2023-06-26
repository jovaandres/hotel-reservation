<?php

namespace App\Controllers;

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

        #return $this->respond($rooms);
        return view('room', [
            'rooms' => $room,
            'reviews' => $reviews
        ]);
    }

    public function create()
    {
        $model = new RoomModel();
        $hotel = $model->getHotel($this->request->getVar('hotel_id'));

        if ($hotel === null) {
            return $this->failNotFound('Hotel not found.');
        }

        $data = [
            'hotel_id' => $this->request->getVar('hotel_id'),
            'room_type' => $this->request->getVar('room_type'),
            'price_per_night' => $this->request->getVar('price_per_night'),
        ];

        $model->createRoom($data);

        return $this->respondCreated($data);
    }

    public function update($id)
    {
        // Code to update an existing room
    }

    public function delete($id)
    {
        // Code to delete a room
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
        // Code to create a new review
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