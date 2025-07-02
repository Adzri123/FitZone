<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\UserModel;

class AuthController extends BaseController
{
    public function login()
    {
        return view('auth/login');
    }

    public function loginSubmit()
    {
    if ($this->request->getMethod() === 'POST') {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $model = new UserModel();
        $user = $model->where('email', $email)->first();


        if ($user && $password === $user['password']) {
            session()->set([
                'userID'     => $user['UserID'],
                'email'      => $user['email'],
                'role'       => $user['role'],
                'balancePoint' => $user['balancePoint'],
                'isLoggedIn' => true
            ]);

            return redirect()->to('/dashboard//'. $user['role']);
        } else {
            $referer = $_SERVER['HTTP_REFERER'] ?? site_url('/login'); // fallback
            return redirect()->to($referer)->with('error', 'Invalid email or password');
        }
    }

    return view('auth/login');
    }

    public function logout()
    {
        session()->destroy();
        return view('welcome_message');
    }

}
