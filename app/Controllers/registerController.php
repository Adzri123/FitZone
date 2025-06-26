<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\UserModel;

class registerController extends BaseController
{
    public function index()
    {
        return view('auth/register');
    }

    public function process()
    {
        $userModel = new UserModel();

        $data = [
            'name'     => $this->request->getPost('name'),
            'password' => $this->request->getPost('password'),
            'phone'    => $this->request->getPost('phone'),
            'email'    => $this->request->getPost('email'),
            'role'     => $this->request->getPost('role'),
            'membershipID' => $this->request->getPost('membershipID')
        ];

        $userModel->insert($data);

        return redirect()->to('/login')->with('success', 'Registration successful!');
    }
}
