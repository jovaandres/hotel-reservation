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
            return redirect()->back()->with('error', $validCreds->reason());
        }

        $users = auth()->getProvider();
        $user = $users->findById($currentUser->id);

        $user->password = $this->request->getPost('newPassword');
        $users->save($user); 

        return redirect()->back()->with('success', 'Password changed successfully.');
    }

    public function forgetPassword()
    {
        $email = $this->request->getPost('email');

        $users = auth()->getProvider();
        $user = $users->findByCredentials(['email' => $email]);

        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }

        return view('auth/reset', ['user' => $user]);
    }

    public function resetPassword()
    {
        $email = $this->request->getPost('email');

        $users = auth()->getProvider();
        $user = $users->findByCredentials(['email' => $email]);

        $user->password = $this->request->getPost('password');
        $users->save($user);

        return redirect()->to('/login')->with('success', 'Password reset successfully.');
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

    public function delete()
    {
        $users = auth()->getProvider();

        $id = $this->request->getPost('id');

        $user = $users->findById($id);

        if ($user === null) {
            return redirect()->back()->with('error', 'User not found.');
        }

        $users->delete($user->id);

        return redirect()->back()->with('success', 'User deleted.');
    }
}