<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class About_us extends Controller
{
    public function index()
    {
        // Load the about_us view
        return view('about_us');
    }
}