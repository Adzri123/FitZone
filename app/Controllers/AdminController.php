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
        // Fetch admin name from session
        $adminName = session()->get('admin_name');

        // Fetch statistics (replace with your actual models/tables)
        $userCount = (new UserModel())->countAll();
        //$merchCount = (new MerchandiseModel())->countAll();
       // $stockCount = (new StockModel())->countAll();

        return view('admin/dashboard', [
            'adminName' => $adminName,
            'userCount' => $userCount,
           // 'merchCount' => $merchCount,
           // 'stockCount' => $stockCount,
        ]);
    }
}
?>
