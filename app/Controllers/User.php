<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Controller;

class User extends Controller
{
    use ResponseTrait;

    public function index()
    {
        $authenticator = auth('session')->getAuthenticator();
        $user = $authenticator->getUser();

        return view('profile', ['user' => $user]);
    }

    public function changePassword()
    {
        $authenticator = auth('session')->getAuthenticator();
        $currentUser = $authenticator->getUser();

        $credentials = [
            'email'    => $currentUser->email,
            'password' => $this->request->getPost('currentPassword')
        ];

        $validCreds = auth()->check($credentials);

        if (! $validCreds->isOK()) {
            return redirect()->back()->with('error', $credentials['password']);
        }

        $users = auth()->getProvider();
        $user = $users->findById($currentUser->id);

        $user->password = $this->request->getPost('newPassword');
        $users->save($user); 

        return redirect()->back()->with('success', 'Password changed successfully.');
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