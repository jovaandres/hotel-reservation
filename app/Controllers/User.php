<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Controller;
use CodeIgniter\Shield\Models\UserModel;

class User extends Controller
{
    use ResponseTrait;

    public function index()
    {
        try {
            $authenticator = auth('session')->getAuthenticator();
            $user = $authenticator->getUser();

            return view('profile', ['user' => $user]);
        } catch (\Exception $e) {
            // Handle the exception
            return $this->failServerError($e->getMessage());
        }
    }

    public function changePassword()
    {
        try {
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
        } catch (\Exception $e) {
            // Handle the exception
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function forgetPassword()
    {
        try {
            $email = $this->request->getPost('email');

            $users = auth()->getProvider();
            $user = $users->findByCredentials(['email' => $email]);

            if (!$user) {
                return redirect()->back()->with('error', 'User not found.');
            }

            return view('auth/reset', ['user' => $user]);
        } catch (\Exception $e) {
            // Handle the exception
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function resetPassword()
    {
        try {
            $email = $this->request->getPost('email');

            $users = auth()->getProvider();
            $user = $users->findByCredentials(['email' => $email]);

            $user->password = $this->request->getPost('password');
            $users->save($user);

            return redirect()->to('/login')->with('success', 'Password reset successfully.');
        } catch (\Exception $e) {
            // Handle the exception
            return redirect()->to('/login')->with('error', $e->getMessage());
        }
    }

    public function show($id)
    {
        try {
            $model = new UserModel();
            $user = $model->getUserById($id);

            if ($user === null) {
                return $this->failNotFound('User not found.');
            }

            return $this->respond($user);
        } catch (\Exception $e) {
            // Handle the exception
            return $this->failServerError($e->getMessage());
        }
    }

    public function create()
    {
        // Code to create a new user
    }

    public function updateProfile()
    {
        try {
            $db = db_connect();

            $authenticator = auth('session')->getAuthenticator();
            $user = $authenticator->getUser();

            if ($user === null) {
                return redirect()->back()->with('error', 'User not found.');
            }

            $db->table('users')->where('id', $user->id)->update([
                'name' => $this->request->getPost('name'),
                'phone' => $this->request->getPost('phone'),
            ]);

            return redirect()->back()->with('success', 'Profile updated successfully.');
        } catch (\Exception $e) {
            // Handle the exception
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function delete()
    {
        try {
            $users = auth()->getProvider();

            $id = $this->request->getPost('id');

            $user = $users->findById($id);

            if ($user === null) {
                return redirect()->back()->with('error', 'User not found.');
            }

            $users->delete($user->id);

            return redirect()->back()->with('success', 'User deleted.');
        } catch (\Exception $e) {
            // Handle the exception
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
