<?php

namespace App\Controllers;

use App\Models\HotelModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Controller;

class Hotel extends BaseController
{
    use ResponseTrait;

    public function index()
    {
        $model = new HotelModel();
        $hotels = $model->getHotels();

        return $this->respond($hotels);
    }

    public function show($id)
    {
        $model = new HotelModel();
        $hotel = $model->getHotel($id);

        if ($hotel === null) {
            return $this->failNotFound('Hotel not found.');
        }

        return $this->respond($hotel);
    }

    public function create()
    {
        $model = new HotelModel();

        $name = $this->request->getPost('name');
        $description = $this->request->getPost('description');
        $address = $this->request->getPost('address');

        $data = [
            'name' => $name,
            'description' => $description,
            'address' => $address,
        ];

        $model->insert($data);

        return redirect()->back()->with('success', 'Hotel created.');
    }

    public function update()
    {
        $model = new HotelModel();

        $id = $this->request->getPost('id');
        $name = $this->request->getPost('name');
        $address = $this->request->getPost('address');

        $hotel = $model->getHotel($id);

        if ($hotel === null) {
            return redirect()->back()->with('error', 'Hotel not found.');
        }

        $data = [
            'name' => $name,
            'address' => $address,
        ];

        $model->updateHotel($id, $data);

        return redirect()->back()->with('success', 'Hotel updated.');
    }

    public function delete()
    {
        $model = new HotelModel();

        $id = $this->request->getPost('id');

        $hotel = $model->getHotel($id);

        if ($hotel === null) {
            return redirect()->back()->with('error', 'Hotel not found.');
        }

        $model->deleteHotel($id);

        return redirect()->back()->with('success', 'Hotel deleted.');
    }
}