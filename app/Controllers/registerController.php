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
        
        // Get the new user's ID
        $userID = $userModel->getInsertID();

        // Find the basic membership plan
        $membershipModel = new \App\Models\MembershipModel();
        $basicPlan = $membershipModel->where('planName', 'Basic')->first();

        if ($basicPlan) {
            $userMembershipModel = new \App\Models\UserMembershipModel();
            $userMembershipModel->insert([
                'userID' => $userID,
                'membershipID' => $basicPlan['membershipID'],
                'purchase_date' => date('Y-m-d H:i:s'),
                'payment_status' => 'free', // or 'paid' if needed
                'payment_amount' => 0,
                'status' => 'active',
                'classes_used_this_week' => 0,
                'last_week_reset' => date('Y-m-d H:i:s')
            ]);
        }

        return redirect()->to('/login')->with('success', 'Registration successful!');
    }
}
