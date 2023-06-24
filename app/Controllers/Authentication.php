<?php

namespace App\Controllers;

class Authentication extends BaseController
{
    public function forget()
    {
        return view('auth/forget');
    }
}
