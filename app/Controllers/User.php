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
        return view('profile');
    }

    public function changePassword()
    {
        $model = new UserModel();

        if ($this->request->getMethod() === 'post') {

            $currentPassword = $this->request->getPost('currentPassword');
            $newPassword = $this->request->getPost('newPassword');
            $confirmPassword = $this->request->getPost('confirmPassword');

            return redirect()->back()->with('success', 'Password changed successfully.');
        }

        return view('profile');
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