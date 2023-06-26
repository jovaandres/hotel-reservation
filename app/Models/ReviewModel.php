<?php

namespace App\Models;

use CodeIgniter\Model;

class ReviewModel extends Model
{
    protected $table = 'review';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'hotel_id', 'rating', 'comment'];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function getReviews()
    {
        return $this->findAll();
    }

    public function getReview($hotel_id)
    {
        return $this->where('hotel_id', $hotel_id)->findAll();
    }

    public function createReview($data)
    {
        return $this->insert($data);
    }

    public function updateReview($id, $data)
    {
        return $this->update($id, $data);
    }

    public function deleteReview($id)
    {
        return $this->delete($id);
    }

    public function getMeanRating($hotelId)
    {
        $ratings = $this->selectAvg('rating')->where('hotel_id', $hotelId)->get()->getRow();

        if ($ratings) {
            return $ratings->rating;
        }

        return 0;
    }
}