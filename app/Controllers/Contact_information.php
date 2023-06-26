<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Contact_information extends Controller
{
    public function index()
    {
        // Load the contact_information view
        return view('contact_information');
    }
}