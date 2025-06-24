<?php

namespace App\Controllers;

use App\Controllers\BaseController;


class DashboardController extends BaseController
{
    public function admin()
    {
         // Check if logged in and is user
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'admin') {
            return redirect()->to('/login');
        }

        return view('/dashboard/admin');
    }


    public function member()
    {
        // Check if logged in and is user
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'member') {
            return redirect()->to('/login');
        }

        return view('/dashboard/member');
    }
}
