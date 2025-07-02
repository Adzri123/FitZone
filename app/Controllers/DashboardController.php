<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;


class DashboardController extends BaseController
{
    


    public function member()
    {
        // Check if logged in and is user
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'member') {
            return redirect()->to('/login');
        }

        return view('member/dashboard');
    }

    

    
}
