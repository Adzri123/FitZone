<?php
namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\MerchandiseModel;
use App\Models\StockModel;

class AdminController extends BaseController
{
    public function dashboard()
    {
        // Check if admin is logged in and has the correct role
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'admin') {
            return redirect()->to('/login');
        }

        $adminName = session()->get('adminName');
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
            session()->set('isLoggedIn', true);
            session()->set('adminName', $user['name']);
            session()->set('role', 'admin');
            return redirect()->to('/admin/dashboard');
        } else {
            return redirect()->back()->with('error', 'Invalid credentials');
        }
    }
}
?>
