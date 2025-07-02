<?php
namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\MerchandiseModel;
use App\Models\StockModel;

class AdminController extends BaseController
{

    public function admin()
    {
        // Check if logged in and is user
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'admin') {
            return redirect()->to('/login');
        }

        return view('admin/dashboard');

        
    }
    
    public function dashboard()
    {
        // Check if admin is logged in
        if (!session()->get('adminName')) {
            return redirect()->to('/login'); // or your login route
        }

        $adminName = session()->get('adminName');
        // Pass any other data as needed
        return view('admin/dashboard', [
            'adminName' => $adminName
        ]);
    }

    public function login()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $userModel = new \App\Models\UserModel();
        $user = $userModel->where('email', $email)->first();

        if ($user && password_verify($password, $user['password'])) {
            session()->set('adminName', $user['name']);
            session()->set('role', 'admin');
            return redirect()->to('/admin/dashboard');
        } else {
            return redirect()->back()->with('error', 'Invalid credentials');
        }
    }
}
?>
