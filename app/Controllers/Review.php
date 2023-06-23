<?php

namespace App\Controllers;

use App\Models\ReviewModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Controller;

class Review extends Controller
{
    use ResponseTrait;

    public function index()
    {
        $model = new ReviewModel();
        $reviews = $model->getReviews();

        return $this->respond($reviews);
    }

    public function show($id)
    {
        $model = new ReviewModel();
        $review = $model->getReview($id);

        if ($review === null) {
            return $this->failNotFound('Review not found.');
        }

        return $this->respond($review);
    }

    public function create()
    {
        // Code to create a new review
    }

    public function update($id)
    {
        // Code to update an existing review
    }

    public function delete($id)
    {
        // Code to delete a review
    }
}