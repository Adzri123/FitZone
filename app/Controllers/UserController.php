<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class UserController extends BaseController
{
   public function login()
    {
        return view('auth/login');
    }

    public function loginSubmit()
    {
        $session = session();
        $model = new UserModel();
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $model->where('email', $email)->first();

        if ($user && password_verify($password, $user['password'])) {
            $session->set([
                'userID' => $user['userID'],
                'email' => $user['email'],
                'role' => $user['role'],
                'isLoggedIn' => true,
            ]);

            if ($user['role'] == 'admin') {
                return redirect()->to('/dashboard/admin');
            } else {
                return redirect()->to('/dashboard/user');
            }
        } else {
            return redirect()->back()->with('error', 'Invalid credentials');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
