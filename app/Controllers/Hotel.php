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
        try {
            $model = new HotelModel();
            $hotels = $model->getHotels();

            return $this->respond($hotels);
        } catch (\Exception $e) {
            // Handle the exception
            return $this->failServerError($e->getMessage());
        }
    }

    public function show($id)
    {
        try {
            $model = new HotelModel();
            $hotel = $model->getHotel($id);

            if ($hotel === null) {
                return $this->redirect()->back()->with('error', 'Hotel not found.');
            }

            return $this->respond($hotel);
        } catch (\Exception $e) {
            // Handle the exception
            return $this->failServerError($e->getMessage());
        }
    }

    public function create()
    {
        try {
            $model = new HotelModel();

            $name = $this->request->getPost('name');
            $description = $this->request->getPost('description');
            $address = $this->request->getPost('address');

            $data = [
                'name' => $name,
                'description' => $description,
                'address' => $address,
                'image_id' => rand(1, 10),
            ];

            $model->insert($data);

            return redirect()->back()->with('success', 'Hotel created.');
        } catch (\Exception $e) {
            // Handle the exception
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function update()
    {
        try {
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
        } catch (\Exception $e) {
            // Handle the exception
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function delete()
    {
        try {
            $model = new HotelModel();

            $id = $this->request->getPost('id');

            $hotel = $model->getHotel($id);

            if ($hotel === null) {
                return redirect()->back()->with('error', 'Hotel not found.');
            }

            $model->deleteHotel($id);

            return redirect()->to('admin/hotel')->with('success', 'Hotel deleted.');
        } catch (\Exception $e) {
            // Handle the exception
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
