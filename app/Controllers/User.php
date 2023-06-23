<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Controller;

class User extends Controller
{
    use ResponseTrait;

    public function index()
    {
        $model = new UserModel();
        $users = $model->getAllUsers();

        return $this->respond($users);
    }

    public function show($id)
    {
        $model = new UserModel();
        $user = $model->getUserById($id);

        if ($user === null) {
            return $this->failNotFound('User not found.');
        }

        return $this->respond($user);
    }

    public function create()
    {
        // Code to create a new user
    }

    public function update($id)
    {
        // Code to update an existing user
    }

    public function delete($id)
    {
        // Code to delete a user
    }
}