<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\MerchandiseModel;
use App\Models\StockModel;
use App\Models\ClassModel;
use App\Models\TrainerModel;

class AdminController extends BaseController
{
    public function dashboard()
    {
        // Check if admin is logged in and has the correct role
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'admin') {
            return redirect()->to('/login');
        }

        $adminName = session()->get('adminName');

        // Fetch counts from the database
        $userModel = new \App\Models\UserModel();
        $merchandiseModel = new \App\Models\MerchandiseModel();
        $membershipModel = new \App\Models\MembershipModel();
        $classModel = new \App\Models\ClassModel();
        $adminCount = $userModel->where('role', 'admin')->countAllResults();
        $classCount = $classModel->countAllResults();
        $membershipCount = $membershipModel->countAllResults();
        $merchandiseCount = $merchandiseModel->countAllResults();

        // Get planName and classLimit for bar chart
        $db = \Config\Database::connect();
        $planNameClassLimit = [];
        $query = $db->table('membership')
            ->select('planName, classLimit')
            ->groupBy('planName')
            ->get();
        foreach ($query->getResultArray() as $row) {
            $planNameClassLimit[$row['planName']] = (int)$row['classLimit'];
        }

        // Get merchandise name and stock for pie chart
        $merchandiseStockPie = [];
        $query = $db->table('merchandise')
            ->select('name, stock_quantity')
            ->get();
        foreach ($query->getResultArray() as $row) {
            $merchandiseStockPie[$row['name']] = (int)$row['stock_quantity'];
        }

        return view('admin/dashboard', [
            'adminName' => $adminName,
            'adminCount' => $adminCount,
            'classCount' => $classCount,
            'membershipCount' => $membershipCount,
            'merchandiseCount' => $merchandiseCount,
            'planNameClassLimit' => $planNameClassLimit,
            'merchandiseStockPie' => $merchandiseStockPie
        ]);
    }

    public function manageMembership()
    {
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'admin') {
            return redirect()->to('/login');
        }
        $membershipModel = new \App\Models\MembershipModel();
        $perPage = 5;
        $memberships = $membershipModel->paginate($perPage);
        $pager = $membershipModel->pager;
        $adminName = session()->get('adminName');
        return view('admin/manage_membership', [
            'adminName' => $adminName,
            'memberships' => $memberships,
            'pager' => $pager
        ]);
    }

    public function manageTrainer()
    {
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'admin') {
            return redirect()->to('/login');
        }
        $trainerModel = new TrainerModel();
        $perPage = 5;
        $trainers = $trainerModel->paginate($perPage);
        $pager = $trainerModel->pager;
        $adminName = session()->get('adminName');
        return view('admin/manage_trainer', [
            'adminName' => $adminName,
            'trainers' => $trainers,
            'pager' => $pager
        ]);
    }

    public function createTrainer()
    {
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'admin') {
            return $this->response->setJSON(['success' => false, 'message' => 'Unauthorized']);
        }
        $trainerModel = new TrainerModel();
        $rules = [
            'name' => 'required|min_length[3]|max_length[100]',
            'specialization' => 'required|min_length[3]|max_length[100]',
            'phone' => 'required|min_length[10]|max_length[15]',
            'email' => 'required|valid_email|max_length[100]',
        ];
        if (!$this->validate($rules)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $this->validator->getErrors()
            ]);
        }
        $data = [
            'name' => $this->request->getPost('name'),
            'specialization' => $this->request->getPost('specialization'),
            'phone' => $this->request->getPost('phone'),
            'email' => $this->request->getPost('email'),
            'status' => $this->request->getPost('status') ?? 'active',
        ];
        try {
            $trainerModel->insert($data);
            return $this->response->setJSON(['success' => true, 'message' => 'Trainer created successfully']);
        } catch (\Exception $e) {
            return $this->response->setJSON(['success' => false, 'message' => 'Failed to create trainer: ' . $e->getMessage()]);
        }
    }

    public function updateTrainer()
    {
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'admin') {
            return $this->response->setJSON(['success' => false, 'message' => 'Unauthorized']);
        }
        $trainerModel = new TrainerModel();
        $trainerId = $this->request->getPost('trainer_id');
        $trainer = $trainerModel->find($trainerId);
        if (!$trainer) {
            return $this->response->setJSON(['success' => false, 'message' => 'Trainer not found']);
        }
        $rules = [
            'name' => 'required|min_length[3]|max_length[100]',
            'specialization' => 'required|min_length[3]|max_length[100]',
            'phone' => 'required|min_length[10]|max_length[15]',
            'email' => 'required|valid_email|max_length[100]',
        ];
        if (!$this->validate($rules)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $this->validator->getErrors()
            ]);
        }
        $data = [
            'name' => $this->request->getPost('name'),
            'specialization' => $this->request->getPost('specialization'),
            'phone' => $this->request->getPost('phone'),
            'email' => $this->request->getPost('email'),
            'status' => $this->request->getPost('status') ?? 'active',
        ];
        try {
            $trainerModel->update($trainerId, $data);
            return $this->response->setJSON(['success' => true, 'message' => 'Trainer updated successfully']);
        } catch (\Exception $e) {
            return $this->response->setJSON(['success' => false, 'message' => 'Failed to update trainer: ' . $e->getMessage()]);
        }
    }

    public function deleteTrainer()
    {
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'admin') {
            return $this->response->setJSON(['success' => false, 'message' => 'Unauthorized']);
        }

        $trainerModel = new TrainerModel();
        $jsonData = $this->request->getJSON();

        if (!$jsonData || !isset($jsonData->trainer_id)) {
            return $this->response->setJSON(['success' => false, 'message' => 'Trainer ID is required']);
        }

        $trainerId = $jsonData->trainer_id;
        $trainer = $trainerModel->find($trainerId);

        if (!$trainer) {
            return $this->response->setJSON(['success' => false, 'message' => 'Trainer not found']);
        }

        try {
            $trainerModel->delete($trainerId);
            return $this->response->setJSON(['success' => true, 'message' => 'Trainer deleted successfully']);
        } catch (\Exception $e) {
            return $this->response->setJSON(['success' => false, 'message' => 'Failed to delete trainer: ' . $e->getMessage()]);
        }
    }

    public function manageClass()
    {
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'admin') {
            return redirect()->to('/login');
        }

        // Check if class table exists
        $db = \Config\Database::connect();
        $classTableExists = $db->tableExists('class');
        if (!$classTableExists) {
            return view('admin/manage_class', [
                'adminName' => session()->get('adminName'),
                'classes' => [],
                'trainers' => [],
                'pager' => null,
                'error' => 'Class table does not exist. Please create tables first by visiting /admin/create-tables'
            ]);
        }

        $classModel = new ClassModel();
        $trainerModel = new \App\Models\TrainerModel();
        $perPage = 5;

        try {
            // Join with trainer table to get trainer name
            $classes = $classModel->select('class.*, trainer.name as trainer_name')
                ->join('trainer', 'trainer.TrainerID = class.trainerID', 'left')
                ->paginate($perPage);
            $pager = $classModel->pager;

            // Get all trainers for dropdown
            $trainers = $trainerModel->findAll();

            $adminName = session()->get('adminName');
            return view('admin/manage_class', [
                'adminName' => $adminName,
                'classes' => $classes,
                'trainers' => $trainers,
                'pager' => $pager,
                'error' => null
            ]);
        } catch (\Exception $e) {
            return view('admin/manage_class', [
                'adminName' => session()->get('adminName'),
                'classes' => [],
                'trainers' => [],
                'pager' => null,
                'error' => 'Database error: ' . $e->getMessage() . '. Please create tables first by visiting /admin/create-tables'
            ]);
        }
    }

    public function createClass()
    {
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'admin') {
            return $this->response->setJSON(['success' => false, 'message' => 'Unauthorized']);
        }
        $classModel = new ClassModel();
        $rules = [
            'class_name' => 'required|min_length[3]|max_length[100]',
            'trainerID' => 'required|integer',
        ];
        if (!$this->validate($rules)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $this->validator->getErrors()
            ]);
        }
        $data = [
            'class_name' => $this->request->getPost('class_name'),
            'trainerID' => $this->request->getPost('trainerID'),
        ];
        try {
            $classModel->insert($data);
            return $this->response->setJSON(['success' => true, 'message' => 'Class created successfully']);
        } catch (\Exception $e) {
            return $this->response->setJSON(['success' => false, 'message' => 'Failed to create class: ' . $e->getMessage()]);
        }
    }

    public function updateClass()
    {
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'admin') {
            return $this->response->setJSON(['success' => false, 'message' => 'Unauthorized']);
        }
        $classModel = new ClassModel();
        $classId = $this->request->getPost('class_id');
        $class = $classModel->find($classId);
        if (!$class) {
            return $this->response->setJSON(['success' => false, 'message' => 'Class not found']);
        }
        $rules = [
            'class_name' => 'required|min_length[3]|max_length[100]',
            'trainerID' => 'required|integer',
        ];
        if (!$this->validate($rules)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $this->validator->getErrors()
            ]);
        }
        $data = [
            'class_name' => $this->request->getPost('class_name'),
            'trainerID' => $this->request->getPost('trainerID'),
        ];
        try {
            $classModel->update($classId, $data);
            return $this->response->setJSON(['success' => true, 'message' => 'Class updated successfully']);
        } catch (\Exception $e) {
            return $this->response->setJSON(['success' => false, 'message' => 'Failed to update class: ' . $e->getMessage()]);
        }
    }

    public function deleteClass()
    {
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'admin') {
            return $this->response->setJSON(['success' => false, 'message' => 'Unauthorized']);
        }
        $classModel = new ClassModel();
        $classId = $this->request->getJSON()->class_id;
        $class = $classModel->find($classId);
        if (!$class) {
            return $this->response->setJSON(['success' => false, 'message' => 'Class not found']);
        }
        try {
            $classModel->delete($classId);
            return $this->response->setJSON(['success' => true, 'message' => 'Class deleted successfully']);
        } catch (\Exception $e) {
            return $this->response->setJSON(['success' => false, 'message' => 'Failed to delete class: ' . $e->getMessage()]);
        }
    }

    public function getClass()
    {
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'admin') {
            return $this->response->setJSON(['success' => false, 'message' => 'Unauthorized']);
        }
        $classModel = new ClassModel();
        $classId = $this->request->getGet('class_id');
        $class = $classModel->find($classId);
        if (!$class) {
            return $this->response->setJSON(['success' => false, 'message' => 'Class not found']);
        }
        return $this->response->setJSON(['success' => true, 'data' => $class]);
    }

    public function manageAdmin()
    {
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'admin') {
            return redirect()->to('/login');
        }
        $userModel = new \App\Models\UserModel();
        $perPage = 5;
        $admins = $userModel->where('role', 'admin')->paginate($perPage);
        $pager = $userModel->pager;
        $adminName = session()->get('adminName');
        return view('admin/manage_admin', [
            'adminName' => $adminName,
            'admins' => $admins,
            'pager' => $pager
        ]);
    }

    public function createAdmin()
    {
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'admin') {
            return $this->response->setJSON(['success' => false, 'message' => 'Unauthorized']);
        }
        $userModel = new \App\Models\UserModel();
        $rules = [
            'name' => 'required|min_length[3]|max_length[100]',
            'email' => 'required|valid_email|is_unique[user.email]',
            'phone' => 'required|min_length[10]|max_length[15]',
            'password' => 'required|min_length[6]'
        ];
        if (!$this->validate($rules)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $this->validator->getErrors()
            ]);
        }
        $data = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'phone' => $this->request->getPost('phone'),
            'password' => $this->request->getPost('password'), // plain text
            'role' => 'admin'
        ];
        try {
            $userModel->insert($data);
            return $this->response->setJSON(['success' => true, 'message' => 'Admin created successfully']);
        } catch (\Exception $e) {
            return $this->response->setJSON(['success' => false, 'message' => 'Failed to create admin: ' . $e->getMessage()]);
        }
    }

    public function updateAdmin()
    {
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'admin') {
            return $this->response->setJSON(['success' => false, 'message' => 'Unauthorized']);
        }
        $userModel = new \App\Models\UserModel();
        $adminId = $this->request->getPost('admin_id');
        $admin = $userModel->find($adminId);
        if (!$admin || $admin['role'] !== 'admin') {
            return $this->response->setJSON(['success' => false, 'message' => 'Admin not found']);
        }
        $rules = [
            'name' => 'required|min_length[3]|max_length[100]',
            'email' => 'required|valid_email',
            'phone' => 'required|min_length[10]|max_length[15]'
        ];
        // Ensure email is unique (exclude current admin)
        $existingUser = $userModel->where('email', $this->request->getPost('email'))
            ->where('UserID !=', $adminId)
            ->first();
        if ($existingUser) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Email already exists',
                'errors' => ['email' => 'Email already exists']
            ]);
        }
        if (!$this->validate($rules)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $this->validator->getErrors()
            ]);
        }
        $data = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'phone' => $this->request->getPost('phone')
        ];
        $password = $this->request->getPost('password');
        if (!empty($password)) {
            $data['password'] = $password; // plain text
        }
        try {
            $userModel->update($adminId, $data);
            return $this->response->setJSON(['success' => true, 'message' => 'Admin updated successfully']);
        } catch (\Exception $e) {
            return $this->response->setJSON(['success' => false, 'message' => 'Failed to update admin: ' . $e->getMessage()]);
        }
    }

    public function deleteAdmin()
    {
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'admin') {
            return $this->response->setJSON(['success' => false, 'message' => 'Unauthorized']);
        }
        $userModel = new \App\Models\UserModel();
        $jsonData = $this->request->getJSON();
        if (!$jsonData || !isset($jsonData->admin_id)) {
            return $this->response->setJSON(['success' => false, 'message' => 'Admin ID is required']);
        }
        $adminId = $jsonData->admin_id;
        $admin = $userModel->find($adminId);
        if (!$admin || $admin['role'] !== 'admin') {
            return $this->response->setJSON(['success' => false, 'message' => 'Admin not found']);
        }
        try {
            $userModel->delete($adminId);
            return $this->response->setJSON(['success' => true, 'message' => 'Admin deleted successfully']);
        } catch (\Exception $e) {
            return $this->response->setJSON(['success' => false, 'message' => 'Failed to delete admin: ' . $e->getMessage()]);
        }
    }

    public function manageMerchandise()
    {
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'admin') {
            return redirect()->to('/login');
        }
        $merchModel = new \App\Models\MerchandiseModel();
        $perPage = 5;
        $merchandise = $merchModel->paginate($perPage);
        $pager = $merchModel->pager;
        $adminName = session()->get('adminName');
        return view('admin/manage_merchandise', [
            'adminName' => $adminName,
            'merchandise' => $merchandise,
            'pager' => $pager
        ]);
    }

    public function createMerchandise()
    {
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'admin') {
            return $this->response->setJSON(['success' => false, 'message' => 'Unauthorized']);
        }
        $merchModel = new \App\Models\MerchandiseModel();
        $rules = [
            'name' => 'required|min_length[2]|max_length[100]',
            'price' => 'required|decimal',
            'stock_quantity' => 'required|integer',
            'category' => 'required',
            'point_cost' => 'required|integer',
            'is_redeemable' => 'required|in_list[0,1]',
        ];
        if (!$this->validate($rules)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $this->validator->getErrors()
            ]);
        }
        $data = [
            'name' => $this->request->getPost('name'),
            'price' => $this->request->getPost('price'),
            'stock_quantity' => $this->request->getPost('stock_quantity'),
            'category' => $this->request->getPost('category'),
            'point_cost' => $this->request->getPost('point_cost'),
            'is_redeemable' => $this->request->getPost('is_redeemable'),
        ];
        try {
            $merchModel->insert($data);
            return $this->response->setJSON(['success' => true, 'message' => 'Merchandise created successfully']);
        } catch (\Exception $e) {
            return $this->response->setJSON(['success' => false, 'message' => 'Failed to create merchandise: ' . $e->getMessage()]);
        }
    }

    public function updateMerchandise()
    {
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'admin') {
            return $this->response->setJSON(['success' => false, 'message' => 'Unauthorized']);
        }
        $merchModel = new \App\Models\MerchandiseModel();
        $id = $this->request->getPost('merchandise_id');
        $merch = $merchModel->find($id);
        if (!$merch) {
            return $this->response->setJSON(['success' => false, 'message' => 'Merchandise not found']);
        }
        $rules = [
            'name' => 'required|min_length[2]|max_length[100]',
            'price' => 'required|decimal',
            'stock_quantity' => 'required|integer',
            'category' => 'required',
            'point_cost' => 'required|integer',
            'is_redeemable' => 'required|in_list[0,1]',
        ];
        if (!$this->validate($rules)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $this->validator->getErrors()
            ]);
        }
        $data = [
            'name' => $this->request->getPost('name'),
            'price' => $this->request->getPost('price'),
            'stock_quantity' => $this->request->getPost('stock_quantity'),
            'category' => $this->request->getPost('category'),
            'point_cost' => $this->request->getPost('point_cost'),
            'is_redeemable' => $this->request->getPost('is_redeemable'),
        ];
        try {
            $merchModel->update($id, $data);
            return $this->response->setJSON(['success' => true, 'message' => 'Merchandise updated successfully']);
        } catch (\Exception $e) {
            return $this->response->setJSON(['success' => false, 'message' => 'Failed to update merchandise: ' . $e->getMessage()]);
        }
    }

    public function deleteMerchandise()
    {
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'admin') {
            return $this->response->setJSON(['success' => false, 'message' => 'Unauthorized']);
        }
        $merchModel = new \App\Models\MerchandiseModel();
        $jsonData = $this->request->getJSON();
        if (!$jsonData || !isset($jsonData->merchandise_id)) {
            return $this->response->setJSON(['success' => false, 'message' => 'Merchandise ID is required']);
        }
        $id = $jsonData->merchandise_id;
        $merch = $merchModel->find($id);
        if (!$merch) {
            return $this->response->setJSON(['success' => false, 'message' => 'Merchandise not found']);
        }
        try {
            $merchModel->delete($id);
            return $this->response->setJSON(['success' => true, 'message' => 'Merchandise deleted successfully']);
        } catch (\Exception $e) {
            return $this->response->setJSON(['success' => false, 'message' => 'Failed to delete merchandise: ' . $e->getMessage()]);
        }
    }

    public function createMembership()
    {
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'admin') {
            return $this->response->setJSON(['success' => false, 'message' => 'Unauthorized']);
        }
        $membershipModel = new \App\Models\MembershipModel();
        $rules = [
            'planName' => 'required|min_length[2]|max_length[100]',
            'tier' => 'required',
            'discountRate' => 'required|decimal',
            'classLimit' => 'required|integer',
            'redeemStatus' => 'required',
            'price' => 'required|decimal',
        ];
        if (!$this->validate($rules)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $this->validator->getErrors()
            ]);
        }
        $data = [
            'planName' => $this->request->getPost('planName'),
            'tier' => $this->request->getPost('tier'),
            'discountRate' => $this->request->getPost('discountRate'),
            'classLimit' => $this->request->getPost('classLimit'),
            'redeemStatus' => $this->request->getPost('redeemStatus'),
            'price' => $this->request->getPost('price'),
        ];
        try {
            $membershipModel->insert($data);
            return $this->response->setJSON(['success' => true, 'message' => 'Membership created successfully']);
        } catch (\Exception $e) {
            return $this->response->setJSON(['success' => false, 'message' => 'Failed to create membership: ' . $e->getMessage()]);
        }
    }

    public function updateMembership()
    {
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'admin') {
            return $this->response->setJSON(['success' => false, 'message' => 'Unauthorized']);
        }
        $membershipModel = new \App\Models\MembershipModel();
        $id = $this->request->getPost('membership_id');
        $membership = $membershipModel->find($id);
        if (!$membership) {
            return $this->response->setJSON(['success' => false, 'message' => 'Membership not found']);
        }
        $rules = [
            'planName' => 'required|min_length[2]|max_length[100]',
            'tier' => 'required',
            'discountRate' => 'required|decimal',
            'classLimit' => 'required|integer',
            'redeemStatus' => 'required',
            'price' => 'required|decimal',
        ];
        if (!$this->validate($rules)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $this->validator->getErrors()
            ]);
        }
        $data = [
            'planName' => $this->request->getPost('planName'),
            'tier' => $this->request->getPost('tier'),
            'discountRate' => $this->request->getPost('discountRate'),
            'classLimit' => $this->request->getPost('classLimit'),
            'redeemStatus' => $this->request->getPost('redeemStatus'),
            'price' => $this->request->getPost('price'),
        ];
        try {
            $membershipModel->update($id, $data);
            return $this->response->setJSON(['success' => true, 'message' => 'Membership updated successfully']);
        } catch (\Exception $e) {
            return $this->response->setJSON(['success' => false, 'message' => 'Failed to update membership: ' . $e->getMessage()]);
        }
    }

    public function deleteMembership()
    {
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'admin') {
            return $this->response->setJSON(['success' => false, 'message' => 'Unauthorized']);
        }
        $membershipModel = new \App\Models\MembershipModel();
        $jsonData = $this->request->getJSON();
        if (!$jsonData || !isset($jsonData->membership_id)) {
            return $this->response->setJSON(['success' => false, 'message' => 'Membership ID is required']);
        }
        $id = $jsonData->membership_id;
        $membership = $membershipModel->find($id);
        if (!$membership) {
            return $this->response->setJSON(['success' => false, 'message' => 'Membership not found']);
        }
        try {
            $membershipModel->delete($id);
            return $this->response->setJSON(['success' => true, 'message' => 'Membership deleted successfully']);
        } catch (\Exception $e) {
            return $this->response->setJSON(['success' => false, 'message' => 'Failed to delete membership: ' . $e->getMessage()]);
        }
    }

    // --- Manage Schedule ---
    public function manageSchedule()
    {
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'admin') {
            return redirect()->to('/login');
        }

        $scheduleModel = new \App\Models\ClassScheduleModel();
        $classModel = new \App\Models\ClassModel();
        $trainerModel = new \App\Models\TrainerModel();
        $perPage = 5;

        // Get filter values from GET
        $filterTrainerID = $this->request->getGet('trainerID');
        $filterClassID = $this->request->getGet('classID');

        try {
            $builder = $scheduleModel
                ->select('class_schedule.*, class.class_name, trainer.name as trainer_name')
                ->join('class', 'class.classID = class_schedule.classID', 'left')
                ->join('trainer', 'trainer.trainerID = class.trainerID', 'left');

            if ($filterTrainerID) {
                $builder = $builder->where('trainer.trainerID', $filterTrainerID);
            }
            if ($filterClassID) {
                $builder = $builder->where('class.classID', $filterClassID);
            }

            $schedules = $builder->paginate($perPage);
            $pager = $scheduleModel->pager;

            $classes = $classModel
                ->select('class.classID, class.class_name, trainer.name as trainer_name')
                ->join('trainer', 'trainer.trainerID = class.trainerID', 'left')
                ->findAll();

            $trainers = $trainerModel->findAll();

            $adminName = session()->get('adminName');
            return view('admin/manage_schedule', [
                'adminName' => $adminName,
                'schedules' => $schedules,
                'classes' => $classes,
                'trainers' => $trainers,
                'pager' => $pager,
                'filterTrainerID' => $filterTrainerID,
                'filterClassID' => $filterClassID
            ]);
        } catch (\Exception $e) {
            return view('admin/manage_schedule', [
                'adminName' => session()->get('adminName'),
                'schedules' => [],
                'classes' => [],
                'trainers' => [],
                'pager' => null,
                'filterTrainerID' => $filterTrainerID,
                'filterClassID' => $filterClassID
            ]);
        }
    }
    public function createSchedule()
    {
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'admin') {
            return $this->response->setJSON(['success' => false, 'message' => 'Unauthorized']);
        }
        $scheduleModel = new \App\Models\ClassScheduleModel();
        $rules = [
            'classID' => 'required|integer',
            'schedule_date' => 'required|valid_date',
            'start_time' => 'required',
            'end_time' => 'required',
        ];
        if (!$this->validate($rules)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $this->validator->getErrors()
            ]);
        }
        $data = [
            'classID' => $this->request->getPost('classID'),
            'schedule_date' => $this->request->getPost('schedule_date'),
            'start_time' => $this->request->getPost('start_time'),
            'end_time' => $this->request->getPost('end_time'),
        ];
        try {
            $scheduleModel->insert($data);
            return $this->response->setJSON(['success' => true, 'message' => 'Schedule created successfully']);
        } catch (\Exception $e) {
            return $this->response->setJSON(['success' => false, 'message' => 'Failed to create schedule: ' . $e->getMessage()]);
        }
    }
    public function updateSchedule()
    {
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'admin') {
            return $this->response->setJSON(['success' => false, 'message' => 'Unauthorized']);
        }
        $scheduleModel = new \App\Models\ClassScheduleModel();
        $scheduleId = $this->request->getPost('schedule_id');
        $schedule = $scheduleModel->find($scheduleId);
        if (!$schedule) {
            return $this->response->setJSON(['success' => false, 'message' => 'Schedule not found']);
        }
        $rules = [
            'classID' => 'required|integer',
            'schedule_date' => 'required|valid_date',
            'start_time' => 'required',
            'end_time' => 'required',
        ];
        if (!$this->validate($rules)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $this->validator->getErrors()
            ]);
        }
        $data = [
            'classID' => $this->request->getPost('classID'),
            'schedule_date' => $this->request->getPost('schedule_date'),
            'start_time' => $this->request->getPost('start_time'),
            'end_time' => $this->request->getPost('end_time'),
        ];
        try {
            $scheduleModel->update($scheduleId, $data);
            return $this->response->setJSON(['success' => true, 'message' => 'Schedule updated successfully']);
        } catch (\Exception $e) {
            return $this->response->setJSON(['success' => false, 'message' => 'Failed to update schedule: ' . $e->getMessage()]);
        }
    }
    public function deleteSchedule()
    {
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'admin') {
            return $this->response->setJSON(['success' => false, 'message' => 'Unauthorized']);
        }
        $scheduleModel = new \App\Models\ClassScheduleModel();
        $scheduleId = $this->request->getJSON()->schedule_id;
        $schedule = $scheduleModel->find($scheduleId);
        if (!$schedule) {
            return $this->response->setJSON(['success' => false, 'message' => 'Schedule not found']);
        }
        try {
            $scheduleModel->delete($scheduleId);
            return $this->response->setJSON(['success' => true, 'message' => 'Schedule deleted successfully']);
        } catch (\Exception $e) {
            return $this->response->setJSON(['success' => false, 'message' => 'Failed to delete schedule: ' . $e->getMessage()]);
        }
    }
    public function getSchedule()
    {
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'admin') {
            return $this->response->setJSON(['success' => false, 'message' => 'Unauthorized']);
        }
        $scheduleModel = new \App\Models\ClassScheduleModel();
        $scheduleId = $this->request->getGet('schedule_id');
        $schedule = $scheduleModel->find($scheduleId);
        if (!$schedule) {
            return $this->response->setJSON(['success' => false, 'message' => 'Schedule not found']);
        }
        return $this->response->setJSON(['success' => true, 'data' => $schedule]);
    }

    public function getSchedules()
    {
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'admin') {
            return $this->response->setJSON(['success' => false, 'message' => 'Unauthorized']);
        }

        try {
            $scheduleModel = new \App\Models\ClassScheduleModel();

            $schedules = $scheduleModel
                ->select('class_schedule.*, class.trainerID as class_trainerID, class.class_name, trainer.name as trainer_name')
                ->join('class', 'class.classID = class_schedule.classID', 'left')
                ->join('trainer', 'trainer.trainerID = class.trainerID', 'left')
                ->findAll();

            return $this->response->setJSON([
                'success' => true,
                'schedules' => $schedules
            ]);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Failed to load schedules: ' . $e->getMessage()
            ]);
        }
    }

    public function updateScheduleDate()
    {
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'admin') {
            return $this->response->setJSON(['success' => false, 'message' => 'Unauthorized']);
        }

        $scheduleModel = new \App\Models\ClassScheduleModel();
        $scheduleId = $this->request->getPost('schedule_id');
        $schedule = $scheduleModel->find($scheduleId);

        if (!$schedule) {
            return $this->response->setJSON(['success' => false, 'message' => 'Schedule not found']);
        }

        $data = [
            'schedule_date' => $this->request->getPost('schedule_date'),
            'start_time' => $this->request->getPost('start_time'),
            'end_time' => $this->request->getPost('end_time'),
        ];

        try {
            $scheduleModel->update($scheduleId, $data);
            return $this->response->setJSON(['success' => true, 'message' => 'Schedule updated successfully']);
        } catch (\Exception $e) {
            return $this->response->setJSON(['success' => false, 'message' => 'Failed to update schedule: ' . $e->getMessage()]);
        }
    }

    public function updateScheduleTime()
    {
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'admin') {
            return $this->response->setJSON(['success' => false, 'message' => 'Unauthorized']);
        }

        $scheduleModel = new \App\Models\ClassScheduleModel();
        $scheduleId = $this->request->getPost('schedule_id');
        $schedule = $scheduleModel->find($scheduleId);

        if (!$schedule) {
            return $this->response->setJSON(['success' => false, 'message' => 'Schedule not found']);
        }

        $data = [
            'start_time' => $this->request->getPost('start_time'),
            'end_time' => $this->request->getPost('end_time'),
        ];

        try {
            $scheduleModel->update($scheduleId, $data);
            return $this->response->setJSON(['success' => true, 'message' => 'Schedule time updated successfully']);
        } catch (\Exception $e) {
            return $this->response->setJSON(['success' => false, 'message' => 'Failed to update schedule time: ' . $e->getMessage()]);
        }
    }

    public function createTables()
    {
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'admin') {
            return $this->response->setJSON(['success' => false, 'message' => 'Unauthorized']);
        }

        $db = \Config\Database::connect();

        try {
            // Create trainer table if it doesn't exist
            $trainerTableSQL = "CREATE TABLE IF NOT EXISTS `trainer` (
                `TrainerID` int(11) unsigned NOT NULL AUTO_INCREMENT,
                `name` varchar(100) NOT NULL,
                `specialty` varchar(100) NOT NULL,
                `phone` varchar(15) NOT NULL,
                `email` varchar(100) DEFAULT NULL,
                `status` enum('active','inactive') DEFAULT 'active',
                `created_at` datetime DEFAULT NULL,
                `updated_at` datetime DEFAULT NULL,
                PRIMARY KEY (`TrainerID`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci";

            $db->query($trainerTableSQL);

            // Create class table if it doesn't exist
            $classTableSQL = "CREATE TABLE IF NOT EXISTS `class` (
                `classID` int(11) unsigned NOT NULL AUTO_INCREMENT,
                `class_name` varchar(100) NOT NULL,
                `trainerID` int(11) unsigned DEFAULT NULL,
                `created_at` datetime DEFAULT NULL,
                `updated_at` datetime DEFAULT NULL,
                PRIMARY KEY (`classID`),
                KEY `trainerID` (`trainerID`),
                CONSTRAINT `fk_class_trainer` FOREIGN KEY (`trainerID`) REFERENCES `trainer` (`TrainerID`) ON DELETE SET NULL ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci";

            $db->query($classTableSQL);

            // Create class_schedule table if it doesn't exist
            $scheduleTableSQL = "CREATE TABLE IF NOT EXISTS `class_schedule` (
                `scheduleID` int(11) unsigned NOT NULL AUTO_INCREMENT,
                `trainerID` int(11) unsigned NOT NULL,
                `classID` int(11) unsigned NOT NULL,
                `schedule_date` date NOT NULL,
                `start_time` time NOT NULL,
                `end_time` time NOT NULL,
                `status` enum('active','inactive') DEFAULT 'active',
                `created_at` datetime DEFAULT NULL,
                `updated_at` datetime DEFAULT NULL,
                PRIMARY KEY (`scheduleID`),
                KEY `trainerID` (`trainerID`),
                KEY `classID` (`classID`),
                CONSTRAINT `fk_schedule_trainer` FOREIGN KEY (`trainerID`) REFERENCES `trainer` (`TrainerID`) ON DELETE CASCADE ON UPDATE CASCADE,
                CONSTRAINT `fk_schedule_class` FOREIGN KEY (`classID`) REFERENCES `class` (`classID`) ON DELETE CASCADE ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci";

            $db->query($scheduleTableSQL);

            // Insert some sample data if tables are empty
            $trainerCount = $db->table('trainer')->countAllResults();
            if ($trainerCount == 0) {
                $db->table('trainer')->insertBatch([
                    [
                        'name' => 'John Trainer',
                        'specialty' => 'Weight Training',
                        'phone' => '1234567890',
                        'email' => 'john@fitzone.com',
                        'status' => 'active'
                    ],
                    [
                        'name' => 'Sarah Coach',
                        'specialty' => 'Cardio',
                        'phone' => '0987654321',
                        'email' => 'sarah@fitzone.com',
                        'status' => 'active'
                    ]
                ]);
            }

            $classCount = $db->table('class')->countAllResults();
            if ($classCount == 0) {
                $db->table('class')->insertBatch([
                    [
                        'class_name' => 'Weight Training',
                        'trainerID' => 1
                    ],
                    [
                        'class_name' => 'Cardio Class',
                        'trainerID' => 2
                    ]
                ]);
            }

            return $this->response->setJSON(['success' => true, 'message' => 'All tables created successfully with sample data']);
        } catch (\Exception $e) {
            return $this->response->setJSON(['success' => false, 'message' => 'Failed to create tables: ' . $e->getMessage()]);
        }
    }

    public function debugTables()
    {
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'admin') {
            return $this->response->setJSON(['success' => false, 'message' => 'Unauthorized']);
        }

        $db = \Config\Database::connect();

        try {
            $tables = [];

            // Check if trainer table exists
            $trainerExists = $db->tableExists('trainer');
            $tables['trainer'] = [
                'exists' => $trainerExists,
                'columns' => []
            ];

            if ($trainerExists) {
                $trainerColumns = $db->getFieldNames('trainer');
                $tables['trainer']['columns'] = $trainerColumns;
            }

            // Check if class table exists
            $classExists = $db->tableExists('class');
            $tables['class'] = [
                'exists' => $classExists,
                'columns' => []
            ];

            if ($classExists) {
                $classColumns = $db->getFieldNames('class');
                $tables['class']['columns'] = $classColumns;
            }

            // Check if class_schedule table exists
            $scheduleExists = $db->tableExists('class_schedule');
            $tables['class_schedule'] = [
                'exists' => $scheduleExists,
                'columns' => []
            ];

            if ($scheduleExists) {
                $scheduleColumns = $db->getFieldNames('class_schedule');
                $tables['class_schedule']['columns'] = $scheduleColumns;
            }

            return $this->response->setJSON([
                'success' => true,
                'tables' => $tables,
                'database' => $db->database
            ]);
        } catch (\Exception $e) {
            return $this->response->setJSON(['success' => false, 'message' => 'Debug failed: ' . $e->getMessage()]);
        }
    }
}
