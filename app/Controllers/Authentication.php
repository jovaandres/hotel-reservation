<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UserModel;


class Authentication extends Controller
{
    public function login()
    {
        return view('auth/login');
    }

    public function register()
    {
        return view('auth/register');
    }

    public function attemptLogin()
    {
        $model = new UserModel();

        if ($this->request->getMethod() === 'post') {

            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');

            $user = $model->getUserByEmail($email);
            if (!$user) {
                $user = $model->getUserByUsername($email);
            }
            
            if ($user && password_verify($password, $user['password'])) {
                return redirect()->to('/');
            } else {
                return redirect()->back()->with('error', 'Invalid credentials');
            }
        }

        return view('auth/login');
    }

    public function attemptRegister()
    {
        $model = new UserModel();

        if ($this->request->getMethod() === 'post') {

            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');

            $data = [
                'username' => strstr($email, '@', true),
                'email' => $email,
                'password' => password_hash($password, PASSWORD_DEFAULT),
            ];
            $model->createUser($data);

            return redirect()->to('/login');
        }

        return view('auth/register');
    }
}