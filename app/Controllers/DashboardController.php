<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;


class DashboardController extends BaseController
{
    public function admin()
    {
        // Check if logged in and is user
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'admin') {
            return redirect()->to('/login');
        }

        return view('admin/dashboard');
    }


    public function member()
    {
        // Check if logged in and is user
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'member') {
            return redirect()->to('/login');
        }

        return view('/dashboard/member');
    }

    public function dashboard()
    {
        return view('admin/dashboard');
    }

    public function manageAdmin()
    {
        $adminModel = new UserModel();
        //$data['admins'] = $adminModel->where('role', 'admin')->findAll();
        //return view('admin/manage_admin', $data);

        // Get only admins
        $admins = $adminModel->where('role', 'admin')->findAll();
    

        // Count how many
        $adminCount = count($admins);

        // Pass both to the view
        return view('admin/manage_admin', [
        'admins' => $admins,
        'adminCount' => $adminCount
    ]);
    
    }

    
}
