<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\MembershipModel;
use App\Models\UserMembershipModel;
use App\Models\BookingModel;
use App\Models\ClassScheduleModel;
use App\Models\ClassModel;
use App\Models\TrainerModel;
use App\Models\MerchandiseModel;
use App\Models\OrderModel;
use App\Models\OrderItemModel;
use App\Models\PointTransactionModel;

class MemberController extends BaseController
{
    public function memberDashboard()
    {
        $userID = session()->get('userID');

        $userMembershipModel = new UserMembershipModel();
        $membershipModel = new MembershipModel();
        $bookingModel = new BookingModel();

        $userMembership = $userMembershipModel
            ->where('userID', $userID)
            ->where('status', 'active')
            ->first();

        $membership = null;
        if ($userMembership) {
            $membership = $membershipModel->find($userMembership['membershipID']);
        }

        $bookings = $bookingModel
            ->select('booking.*, class.class_name, trainer.name as trainer_name, class_schedule.schedule_date, class_schedule.start_time, class_schedule.end_time')
            ->join('class_schedule', 'class_schedule.scheduleID = booking.scheduleID')
            ->join('class', 'class.classID = class_schedule.classID')
            ->join('trainer', 'trainer.trainerID = class.trainerID')
            ->where('booking.userID', $userID)
            ->where('booking.status', 'confirmed')
            ->where('class_schedule.schedule_date >=', date('Y-m-d'))
            ->orderBy('class_schedule.schedule_date', 'ASC')
            ->orderBy('class_schedule.start_time', 'ASC')
            ->findAll();

        return view('member/dashboard', [
            'membership' => $membership,
            'userMembership' => $userMembership,
            'bookings' => $bookings
        ]);
    }

    public function shop()
    {
        $merchandiseModel = new MerchandiseModel();

        $merchandise = $merchandiseModel
            ->where('status', 'active')
            ->where('stock_quantity >', 0)
            ->findAll();

        return view('member/shop', ['merchandise' => $merchandise]);
    }

    public function buyMembership()
    {
        $membershipModel = new MembershipModel();
        $userMembershipModel = new UserMembershipModel();

        $userID = session()->get('userID');

        $memberships = $membershipModel
            ->where('membershipStatus', 'active')
            ->findAll();

        $currentUserMembership = $userMembershipModel
            ->where('userID', $userID)
            ->where('status', 'active')
            ->first();

        $currentMembership = null;
        if ($currentUserMembership) {
            $currentMembership = $membershipModel->find($currentUserMembership['membershipID']);
        }

        return view('member/buy-membership', [
            'memberships' => $memberships,
            'currentMembership' => $currentMembership,
            'currentUserMembership' => $currentUserMembership
        ]);
    }

    public function classes()
    {
        $classModel = new ClassModel();
        $trainerModel = new TrainerModel();
        $bookingModel = new BookingModel();
        $classScheduleModel = new ClassScheduleModel();
        $userMembershipModel = new UserMembershipModel();
        $membershipModel = new MembershipModel();

        $userID = session()->get('userID');

        $classes = $classModel
            ->select('class.*, trainer.name as trainer_name')
            ->join('trainer', 'trainer.trainerID = class.trainerID')
            ->where('class.status', 'active')
            ->where('trainer.status', 'active')
            ->findAll();

        // Get schedules for each class with booking count information
        $classSchedules = [];
        $userModel = new UserModel();
        foreach ($classes as $class) {
            $schedules = $classScheduleModel
                ->where('classID', $class['classID'])
                ->where('schedule_date >=', date('Y-m-d'))
                ->where('status', 'scheduled')
                ->orderBy('schedule_date', 'ASC')
                ->orderBy('start_time', 'ASC')
                ->findAll();
            
            // Add booking count and booked-by info for each schedule
            foreach ($schedules as &$schedule) {
                $booking = $bookingModel
                    ->where('scheduleID', $schedule['scheduleID'])
                    ->where('status', 'confirmed')
                    ->first();
                $bookingCount = $booking ? 1 : 0;
                $schedule['booking_count'] = $bookingCount;
                $schedule['available_spots'] = ($schedule['capacity'] ?? 20) - $bookingCount;
                $schedule['is_full'] = $schedule['available_spots'] <= 0;
                $schedule['is_booked_by_anyone'] = $booking ? true : false;
                if ($booking) {
                    $bookedUser = $userModel->find($booking['userID']);
                    $schedule['booked_by_name'] = $bookedUser['name'] ?? null;
                    $schedule['booked_by_email'] = $bookedUser['email'] ?? null;
                } else {
                    $schedule['booked_by_name'] = null;
                    $schedule['booked_by_email'] = null;
                }
            }
            
            $classSchedules[$class['classID']] = $schedules;
        }

        $userBookings = $bookingModel
            ->select('booking.*, class.class_name, class_schedule.schedule_date, class_schedule.start_time')
            ->join('class_schedule', 'class_schedule.scheduleID = booking.scheduleID')
            ->join('class', 'class.classID = class_schedule.classID')
            ->where('booking.userID', $userID)
            ->where('booking.status', 'confirmed')
            ->findAll();

        // Get user's membership information
        $userMembership = $userMembershipModel
            ->where('userID', $userID)
            ->where('status', 'active')
            ->first();

        $membership = null;
        if ($userMembership) {
            $membership = $membershipModel->find($userMembership['membershipID']);
        }

        return view('member/classes', [
            'classes' => $classes,
            'classSchedules' => $classSchedules,
            'userBookings' => $userBookings,
            'membership' => $membership,
            'userMembership' => $userMembership
        ]);
    }

    public function bookClass()
    {
        $bookingModel = new BookingModel();
        $userMembershipModel = new UserMembershipModel();
        $membershipModel = new MembershipModel();
        $classScheduleModel = new ClassScheduleModel();
        
        $scheduleID = $this->request->getPost('scheduleID');
        $userID = session()->get('userID');

        // Check if user has already booked this class
        $existingBooking = $bookingModel
            ->where('userID', $userID)
            ->where('scheduleID', $scheduleID)
            ->first();

        if ($existingBooking) {
            return redirect()->back()->with('error', 'You have already booked this class.');
        }

        // Get user's active membership
        $userMembership = $userMembershipModel
            ->where('userID', $userID)
            ->where('status', 'active')
            ->first();

        if (!$userMembership) {
            return redirect()->back()->with('error', 'You need an active membership to book classes.');
        }

        $membership = $membershipModel->find($userMembership['membershipID']);
        if (!$membership) {
            return redirect()->back()->with('error', 'Membership not found.');
        }

        // Get the schedule date to check weekly limit
        $schedule = $classScheduleModel->find($scheduleID);
        if (!$schedule) {
            return redirect()->back()->with('error', 'Schedule not found.');
        }

        $scheduleDate = $schedule['schedule_date'];
        
        // Calculate the start of the week (Monday) for the schedule date
        $scheduleDateTime = new \DateTime($scheduleDate);
        $weekStart = clone $scheduleDateTime;
        $weekStart->modify('monday this week');
        $weekEnd = clone $weekStart;
        $weekEnd->modify('+6 days');

        // Count user's bookings for this week
        $weeklyBookings = $bookingModel
            ->select('booking.*, class_schedule.schedule_date')
            ->join('class_schedule', 'class_schedule.scheduleID = booking.scheduleID')
            ->where('booking.userID', $userID)
            ->where('booking.status', 'confirmed')
            ->where('class_schedule.schedule_date >=', $weekStart->format('Y-m-d'))
            ->where('class_schedule.schedule_date <=', $weekEnd->format('Y-m-d'))
            ->findAll();

        $weeklyBookingCount = count($weeklyBookings);

        // Check if user has reached their weekly class limit
        if ($weeklyBookingCount >= $membership['classLimit']) {
            return redirect()->back()->with('error', 'You have reached your weekly class limit of ' . $membership['classLimit'] . ' classes. Please wait until next week to book more classes.');
        }

        // Check if the class is full
        $currentBookings = $bookingModel
            ->where('scheduleID', $scheduleID)
            ->where('status', 'confirmed')
            ->countAllResults();
        
        $capacity = $schedule['capacity'] ?? 20;
        
        if ($currentBookings >= $capacity) {
            return redirect()->back()->with('error', 'Sorry, this class is already full. Please try another time slot.');
        }

        // Proceed with booking
        $bookingModel->insert([
            'userID' => $userID,
            'scheduleID' => $scheduleID,
            'status' => 'confirmed',
            'booking_date' => date('Y-m-d H:i:s')
        ]);

        return redirect()->back()->with('success', 'Class booked successfully! You have ' . ($membership['classLimit'] - $weeklyBookingCount - 1) . ' classes remaining this week.');
    }

    public function purchaseMembership()
    {
        $membershipModel = new MembershipModel();
        $userMembershipModel = new UserMembershipModel();
        $userModel = new UserModel();
        $orderModel = new OrderModel();

        $membershipID = $this->request->getPost('membershipID');
        $userID = session()->get('userID');

        $membership = $membershipModel->find($membershipID);

        if (!$membership) {
            return redirect()->back()->with('error', 'Membership not found.');
        }

        // Check if user already has an active membership and validate upgrade-only policy
        $existingUserMembership = $userMembershipModel
            ->where('userID', $userID)
            ->where('status', 'active')
            ->first();

        if ($existingUserMembership) {
            $currentMembership = $membershipModel->find($existingUserMembership['membershipID']);
            
            if ($currentMembership) {
                // Define plan hierarchy for upgrade-only logic
                $planHierarchy = ['Basic' => 1, 'Silver' => 2, 'Gold' => 3, 'Platinum' => 4];
                
                $currentPlanName = $currentMembership['planName'];
                $newPlanName = $membership['planName'];
                
                $currentPlanLevel = $planHierarchy[$currentPlanName] ?? 0;
                $newPlanLevel = $planHierarchy[$newPlanName] ?? 0;
                
                // Check if this is a downgrade (not allowed)
                if ($newPlanLevel <= $currentPlanLevel) {
                    return redirect()->back()->with('error', 'You can only upgrade your membership plan. Downgrading is not allowed.');
                }
            }
        }

        // Create order for membership purchase (no points earned)
        $orderID = $orderModel->insert([
            'userID' => $userID,
            'order_type' => 'membership',
            'total_amount' => $membership['price'],
            'discount_amount' => 0,
            'final_amount' => $membership['price'],
            'points_earned' => 0,
            'points_used' => 0,
            'status' => 'paid',
            'order_date' => date('Y-m-d H:i:s')
        ]);

        // Update or create user membership
        if ($existingUserMembership) {
            // Update the existing membership row
            $userMembershipModel->update($existingUserMembership['id'], [
                'membershipID' => $membershipID,
                'payment_status' => 'paid',
                'payment_amount' => $membership['price'],
                'status' => 'active',
                'purchase_date' => date('Y-m-d H:i:s')
            ]);
        } else {
            // Insert new membership row
            $userMembershipModel->insert([
                'userID' => $userID,
                'membershipID' => $membershipID,
                'payment_status' => 'paid',
                'payment_amount' => $membership['price'],
                'status' => 'active',
                'purchase_date' => date('Y-m-d H:i:s')
            ]);
        }

        $userModel->update($userID, ['membershipID' => $membershipID]);

        return redirect()->back()->with('success', 'Membership purchased successfully!');
    }

    public function purchaseMerchandise()
    {
        $merchandiseModel = new MerchandiseModel();
        $orderModel = new OrderModel();
        $orderItemModel = new OrderItemModel();
        $pointTransactionModel = new PointTransactionModel();
        $userModel = new UserModel();
        $userMembershipModel = new UserMembershipModel();
        $membershipModel = new MembershipModel();

        $merchandiseID = $this->request->getPost('merchandiseID');
        $quantity = $this->request->getPost('quantity');
        $userID = session()->get('userID');

        $merchandise = $merchandiseModel->find($merchandiseID);

        if (!$merchandise || $merchandise['stock_quantity'] < $quantity) {
            return redirect()->back()->with('error', 'Item not available in requested quantity.');
        }

        // Check user's membership for points earning eligibility
        $userMembership = $userMembershipModel
            ->where('userID', $userID)
            ->where('status', 'active')
            ->first();

        $canEarnPoints = false;
        if ($userMembership) {
            $membership = $membershipModel->find($userMembership['membershipID']);
            if ($membership) {
                // Only Silver, Gold, and Platinum members can earn points
                $eligiblePlans = ['Silver', 'Gold', 'Platinum'];
                $canEarnPoints = in_array($membership['planName'], $eligiblePlans);
            }
        }

        $totalAmount = $merchandise['price'] * $quantity;
        $pointsEarned = $canEarnPoints ? floor($totalAmount) : 0; // Only earn points if eligible
        $pointsUsed = $merchandise['point_cost'] * $quantity;

        // Get user's current points
        $user = $userModel->find($userID);
        $userPoints = $user['balancePoint'] ?? 0;

        // Check if user has enough points for redeemable items
        if ($pointsUsed > $userPoints) {
            return redirect()->back()->with('error', "Insufficient points. You need {$pointsUsed} points but have {$userPoints} points.");
        }

        // Create order
        $orderID = $orderModel->insert([
            'userID' => $userID,
            'order_type' => 'merchandise',
            'total_amount' => $totalAmount,
            'discount_amount' => 0,
            'final_amount' => $totalAmount,
            'points_earned' => $pointsEarned,
            'points_used' => $pointsUsed,
            'status' => 'paid',
            'order_date' => date('Y-m-d H:i:s')
        ]);

        // Save order item
        $orderItemModel->insert([
            'orderID' => $orderID,
            'merchandiseID' => $merchandiseID,
            'quantity' => $quantity,
            'unit_price' => $merchandise['price'],
            'total_price' => $totalAmount,
            'points_used' => $pointsUsed
        ]);

        // Update stock quantity
        $merchandiseModel->update($merchandiseID, [
            'stock_quantity' => $merchandise['stock_quantity'] - $quantity
        ]);

        // Handle points transactions
        $newBalance = $userPoints;
        
        // Deduct points used (if any)
        if ($pointsUsed > 0) {
            $pointTransactionModel->insert([
                'userID' => $userID,
                'points' => -$pointsUsed, // Negative for deduction
                'type' => 'purchase',
                'description' => 'Points used for merchandise purchase',
                'reference_id' => $orderID,
                'reference_type' => 'order',
                'transaction_date' => date('Y-m-d H:i:s')
            ]);
            $newBalance -= $pointsUsed;
        }
        
        // Add points earned (only for eligible memberships)
        if ($pointsEarned > 0) {
            $pointTransactionModel->insert([
                'userID' => $userID,
                'points' => $pointsEarned, // Positive for earning
                'type' => 'earned',
                'description' => 'Points earned from merchandise purchase',
                'reference_id' => $orderID,
                'reference_type' => 'order',
                'transaction_date' => date('Y-m-d H:i:s')
            ]);
            $newBalance += $pointsEarned;
        }
        
        // Update user's point balance
        $userModel->update($userID, [
            'balancePoint' => $newBalance
        ]);
        
        // Update session points
        session()->set('balancePoint', $newBalance);

        // Customize success message based on points earned
        $successMessage = 'Purchase completed successfully!';
        if ($pointsEarned > 0) {
            $successMessage .= " You earned {$pointsEarned} points from this purchase.";
        } elseif (!$canEarnPoints && $userMembership) {
            $membership = $membershipModel->find($userMembership['membershipID']);
            $successMessage .= " Upgrade to Silver, Gold, or Platinum membership to earn points on purchases.";
        }

        return redirect()->back()->with('success', $successMessage);
    }

    public function addToCart()
    {
        $merchandiseModel = new MerchandiseModel();
        
        $merchandiseID = $this->request->getPost('merchandiseID');
        $quantity = (int)$this->request->getPost('quantity');
        
        if ($quantity <= 0) {
            return redirect()->back()->with('error', 'Please select a valid quantity.');
        }

        $merchandise = $merchandiseModel->find($merchandiseID);
        
        if (!$merchandise || $merchandise['stock_quantity'] < $quantity) {
            return redirect()->back()->with('error', 'Item not available in requested quantity.');
        }

        // Get current cart from session
        $cart = session()->get('cart') ?? [];
        
        // Check if item already exists in cart
        if (isset($cart[$merchandiseID])) {
            $newQuantity = $cart[$merchandiseID]['quantity'] + $quantity;
            if ($newQuantity > $merchandise['stock_quantity']) {
                return redirect()->back()->with('error', 'Cannot add more items than available in stock.');
            }
            $cart[$merchandiseID]['quantity'] = $newQuantity;
        } else {
            $cart[$merchandiseID] = [
                'merchandiseID' => $merchandiseID,
                'name' => $merchandise['name'],
                'price' => $merchandise['price'],
                'point_cost' => $merchandise['point_cost'],
                'quantity' => $quantity,
                'image_url' => $merchandise['image_url'],
                'category' => $merchandise['category']
            ];
        }
        
        // Update cart in session
        session()->set('cart', $cart);
        
        return redirect()->back()->with('success', 'Item added to cart successfully!');
    }

    public function viewCart()
    {
        $cart = session()->get('cart') ?? [];
        
        // Get user's membership information for discount calculation
        $userID = session()->get('userID');
        $userMembershipModel = new UserMembershipModel();
        $membershipModel = new MembershipModel();
        
        $userMembership = $userMembershipModel
            ->where('userID', $userID)
            ->where('status', 'active')
            ->first();
        
        $membership = null;
        $discountRate = 0;
        $discountAmount = 0;
        $subtotal = 0;
        $totalAmount = 0;
        $totalPoints = 0;
        
        // Calculate totals and discount
        foreach ($cart as $merchandiseID => $item) {
            $itemTotal = $item['price'] * $item['quantity'];
            $itemPoints = $item['point_cost'] * $item['quantity'];
            $subtotal += $itemTotal;
            $totalPoints += $itemPoints;
        }
        
        // Apply membership discount if user has active membership
        if ($userMembership) {
            $membership = $membershipModel->find($userMembership['membershipID']);
            if ($membership && $membership['discountRate'] > 0) {
                $discountRate = $membership['discountRate'];
                $discountAmount = ($subtotal * $discountRate) / 100;
                $totalAmount = $subtotal - $discountAmount;
            } else {
                $totalAmount = $subtotal;
            }
        } else {
            $totalAmount = $subtotal;
        }
        
        return view('member/cart', [
            'cart' => $cart,
            'membership' => $membership,
            'userMembership' => $userMembership,
            'subtotal' => $subtotal,
            'discountRate' => $discountRate,
            'discountAmount' => $discountAmount,
            'totalAmount' => $totalAmount,
            'totalPoints' => $totalPoints,
            'shippingCost' => 0 // Default to 0, will be updated by JavaScript
        ]);
    }

    public function updateCart()
    {
        $merchandiseModel = new MerchandiseModel();
        $merchandiseID = $this->request->getPost('merchandiseID');
        $quantity = (int)$this->request->getPost('quantity');
        
        $cart = session()->get('cart') ?? [];
        
        if ($quantity <= 0) {
            // Remove item from cart
            unset($cart[$merchandiseID]);
        } else {
            $merchandise = $merchandiseModel->find($merchandiseID);
            if (!$merchandise || $merchandise['stock_quantity'] < $quantity) {
                return redirect()->back()->with('error', 'Item not available in requested quantity.');
            }
            $cart[$merchandiseID]['quantity'] = $quantity;
        }
        
        session()->set('cart', $cart);
        return redirect()->back()->with('success', 'Cart updated successfully!');
    }

    public function removeFromCart()
    {
        $merchandiseID = $this->request->getPost('merchandiseID');
        $cart = session()->get('cart') ?? [];
        
        unset($cart[$merchandiseID]);
        session()->set('cart', $cart);
        
        return redirect()->back()->with('success', 'Item removed from cart successfully!');
    }

    public function checkout()
    {
        $cart = session()->get('cart') ?? [];
        
        if (empty($cart)) {
            return redirect()->to('/shop')->with('error', 'Your cart is empty.');
        }

        // Get shipping option from form
        $shippingOption = $this->request->getPost('shipping_option') ?? 'pickup';
        
        // Store shipping option in session for the checkout page
        session()->set('checkout_shipping_option', $shippingOption);

        $merchandiseModel = new MerchandiseModel();
        $userMembershipModel = new UserMembershipModel();
        $membershipModel = new MembershipModel();
        $userID = session()->get('userID');
        
        $subtotal = 0;
        $totalPoints = 0;
        $errors = [];

        // Get user's membership information for discount
        $userMembership = $userMembershipModel
            ->where('userID', $userID)
            ->where('status', 'active')
            ->first();
        
        $membership = null;
        $discountRate = 0;
        $discountAmount = 0;
        $totalAmount = 0;

        // Fetch user data for pre-filling checkout fields
        $userModel = new UserModel();
        $user = $userModel->find($userID);

        // Calculate totals
        foreach ($cart as $merchandiseID => $item) {
            $subtotal += $item['price'] * $item['quantity'];
            $totalPoints += $item['point_cost'] * $item['quantity'];
        }
        
        // Apply membership discount if user has active membership
        if ($userMembership) {
            $membership = $membershipModel->find($userMembership['membershipID']);
            if ($membership && $membership['discountRate'] > 0) {
                $discountRate = $membership['discountRate'];
                $discountAmount = ($subtotal * $discountRate) / 100;
                $totalAmount = $subtotal - $discountAmount;
            } else {
                $totalAmount = $subtotal;
            }
        } else {
            $totalAmount = $subtotal;
        }
        
        // Add shipping cost to total amount
        $shippingCost = ($shippingOption === 'delivery') ? 5.00 : 0.00;
        $totalAmount += $shippingCost;
        
        return view('member/checkout', [
            'cart' => $cart,
            'membership' => $membership,
            'userMembership' => $userMembership,
            'subtotal' => $subtotal,
            'discountRate' => $discountRate,
            'discountAmount' => $discountAmount,
            'totalAmount' => $totalAmount,
            'totalPoints' => $totalPoints,
            'shippingOption' => $shippingOption,
            'shippingCost' => $shippingCost,
            'user' => $user // Pass user data to view
        ]);
    }

    public function placeOrder()
    {
        $cart = session()->get('cart') ?? [];
        
        if (empty($cart)) {
            return redirect()->to('/shop')->with('error', 'Your cart is empty.');
        }

        // Get form data
        $shippingOption = $this->request->getPost('shipping_option') ?? 'pickup';
        $paymentMethod = $this->request->getPost('payment_method') ?? 'card';
        
        // Get delivery address if delivery is selected
        $deliveryAddress = null;
        if ($shippingOption === 'delivery') {
            $deliveryAddress = [
                'fullName' => $this->request->getPost('fullName'),
                'phone' => $this->request->getPost('phone'),
                'address' => $this->request->getPost('address'),
                'city' => $this->request->getPost('city'),
                'state' => $this->request->getPost('state'),
                'postcode' => $this->request->getPost('postcode')
            ];
        }

        $merchandiseModel = new MerchandiseModel();
        $orderModel = new OrderModel();
        $userModel = new UserModel();
        $userMembershipModel = new UserMembershipModel();
        $membershipModel = new MembershipModel();
        $userID = session()->get('userID');
        
        $subtotal = 0;
        $totalPoints = 0;
        $errors = [];

        // Get user's current points
        $user = $userModel->find($userID);
        $userPoints = $user['balancePoint'] ?? 0;

        // Get user's membership information for discount
        $userMembership = $userMembershipModel
            ->where('userID', $userID)
            ->where('status', 'active')
            ->first();
        
        $membership = null;
        $discountRate = 0;
        $discountAmount = 0;
        $finalAmount = 0;

        // Validate stock availability and calculate totals
        foreach ($cart as $merchandiseID => $item) {
            $merchandise = $merchandiseModel->find($merchandiseID);
            if (!$merchandise) {
                $errors[] = "Item '{$item['name']}' is no longer available.";
                continue;
            }
            
            if ($merchandise['stock_quantity'] < $item['quantity']) {
                $errors[] = "Only {$merchandise['stock_quantity']} units of '{$item['name']}' are available.";
                continue;
            }
            
            $subtotal += $merchandise['price'] * $item['quantity'];
            $totalPoints += $merchandise['point_cost'] * $item['quantity'];
        }

        if (!empty($errors)) {
            return redirect()->back()->with('error', implode(' ', $errors));
        }

        // Apply membership discount if user has active membership
        if ($userMembership) {
            $membership = $membershipModel->find($userMembership['membershipID']);
            if ($membership && $membership['discountRate'] > 0) {
                $discountRate = $membership['discountRate'];
                $discountAmount = ($subtotal * $discountRate) / 100;
                $finalAmount = $subtotal - $discountAmount;
            } else {
                $finalAmount = $subtotal;
            }
        } else {
            $finalAmount = $subtotal;
        }
        
        // Add shipping cost to final amount
        $shippingCost = ($shippingOption === 'delivery') ? 5.00 : 0.00;
        $finalAmount += $shippingCost;

        // Check if user has enough points for redeemable items
        if ($totalPoints > $userPoints) {
            return redirect()->back()->with('error', "Insufficient points. You need {$totalPoints} points but have {$userPoints} points.");
        }

        // Calculate points earned from purchase (e.g., 1 point per $1 spent)
        $pointsEarned = floor($finalAmount); // 1 point per dollar spent
        
        // Create order with all information
        $orderData = [
            'userID' => $userID,
            'order_type' => 'merchandise',
            'total_amount' => $subtotal,
            'discount_amount' => $discountAmount,
            'final_amount' => $finalAmount,
            'points_earned' => $pointsEarned,
            'points_used' => $totalPoints,
            'shipping_option' => $shippingOption,
            'shipping_cost' => $shippingCost,
            'payment_method' => $paymentMethod,
            'status' => 'paid',
            'order_date' => date('Y-m-d H:i:s')
        ];
        
        // Add delivery address if delivery is selected
        if ($shippingOption === 'delivery' && $deliveryAddress) {
            $orderData['delivery_address'] = json_encode($deliveryAddress);
        }
        
        $orderID = $orderModel->insert($orderData);

        // Save order items
        $orderItemModel = new OrderItemModel();
        foreach ($cart as $merchandiseID => $item) {
            $merchandise = $merchandiseModel->find($merchandiseID);
            
            // Save order item
            $orderItemModel->insert([
                'orderID' => $orderID,
                'merchandiseID' => $merchandiseID,
                'quantity' => $item['quantity'],
                'unit_price' => $merchandise['price'],
                'total_price' => $merchandise['price'] * $item['quantity'],
                'points_used' => $item['point_cost'] * $item['quantity']
            ]);
            
            // Update stock quantity
            $merchandiseModel->update($merchandiseID, [
                'stock_quantity' => $merchandise['stock_quantity'] - $item['quantity']
            ]);
        }

        // Handle points transactions
        $pointTransactionModel = new PointTransactionModel();
        $newBalance = $userPoints;
        
        // Deduct points used (if any)
        if ($totalPoints > 0) {
            $pointTransactionModel->insert([
                'userID' => $userID,
                'points' => -$totalPoints, // Negative for deduction
                'type' => 'purchase',
                'description' => 'Points used for merchandise purchase',
                'reference_id' => $orderID,
                'reference_type' => 'order',
                'transaction_date' => date('Y-m-d H:i:s')
            ]);
            $newBalance -= $totalPoints;
        }
        
        // Add points earned (if any)
        if ($pointsEarned > 0) {
            $pointTransactionModel->insert([
                'userID' => $userID,
                'points' => $pointsEarned, // Positive for earning
                'type' => 'earned',
                'description' => 'Points earned from merchandise purchase',
                'reference_id' => $orderID,
                'reference_type' => 'order',
                'transaction_date' => date('Y-m-d H:i:s')
            ]);
            $newBalance += $pointsEarned;
        }
        
        // Update user's point balance
        $userModel->update($userID, [
            'balancePoint' => $newBalance
        ]);
        
        // Update session points
        session()->set('balancePoint', $newBalance);

        // Clear cart
        session()->remove('cart');
        session()->remove('checkout_shipping_option');
        
        $message = 'Order completed successfully! ';
        if ($shippingOption === 'pickup') {
            $message .= 'Your items will be ready for pickup at the gym.';
        } else {
            $message .= 'Your items will be delivered to your address.';
        }
        
        if ($totalPoints > 0) {
            $message .= " {$totalPoints} points have been deducted from your account.";
        }
        if ($discountAmount > 0) {
            $message .= " You saved $" . number_format($discountAmount, 2) . " with your membership discount!";
        }
        if ($shippingCost > 0) {
            $message .= " Shipping cost: $" . number_format($shippingCost, 2);
        }
        
        return redirect()->to('/shop')->with('success', $message);
    }

    public function redeemMerchandise()
    {
        $merchandiseModel = new MerchandiseModel();
        $userModel = new UserModel();
        $orderModel = new OrderModel();
        
        $merchandiseID = $this->request->getPost('merchandiseID');
        $quantity = 1; // Fixed quantity for redemption
        $userID = session()->get('userID');

        $merchandise = $merchandiseModel->find($merchandiseID);
        
        if (!$merchandise) {
            return redirect()->back()->with('error', 'Item not found.');
        }
        
        if (!$merchandise['is_redeemable']) {
            return redirect()->back()->with('error', 'This item cannot be redeemed with points.');
        }
        
        if ($merchandise['stock_quantity'] < $quantity) {
            return redirect()->back()->with('error', 'Item not available in requested quantity.');
        }
        
        $totalPoints = $merchandise['point_cost'] * $quantity;
        
        // Get user's current points
        $user = $userModel->find($userID);
        $userPoints = $user['balancePoint'] ?? 0;
        
        if ($userPoints < $totalPoints) {
            return redirect()->back()->with('error', "Insufficient points. You need {$totalPoints} points but have {$userPoints} points.");
        }
        
        // Create order for redemption
        $orderID = $orderModel->insert([
            'userID' => $userID,
            'order_type' => 'redemption',
            'total_amount' => 0, // Free with points
            'discount_amount' => 0,
            'final_amount' => 0,
            'points_earned' => 0, // No points earned for redemption
            'points_used' => $totalPoints,
            'status' => 'paid',
            'order_date' => date('Y-m-d H:i:s')
        ]);
        
        // Save order item
        $orderItemModel = new OrderItemModel();
        $orderItemModel->insert([
            'orderID' => $orderID,
            'merchandiseID' => $merchandiseID,
            'quantity' => $quantity,
            'unit_price' => 0, // Free with points
            'total_price' => 0,
            'points_used' => $totalPoints
        ]);
        
        // Update stock quantity
        $merchandiseModel->update($merchandiseID, [
            'stock_quantity' => $merchandise['stock_quantity'] - $quantity
        ]);
        
        // Record point transaction
        $pointTransactionModel = new PointTransactionModel();
        $pointTransactionModel->insert([
            'userID' => $userID,
            'points' => -$totalPoints, // Negative for deduction
            'type' => 'redemption',
            'description' => 'Points used for merchandise redemption',
            'reference_id' => $orderID,
            'reference_type' => 'order',
            'transaction_date' => date('Y-m-d H:i:s')
        ]);
        
        // Update user's point balance
        $userModel->update($userID, [
            'balancePoint' => $userPoints - $totalPoints
        ]);
        
        // Update session points
        session()->set('balancePoint', $userPoints - $totalPoints);
        
        return redirect()->back()->with('success', "Item redeemed successfully! {$totalPoints} points have been deducted from your account.");
    }

    public function orderHistory()
    {
        $userID = session()->get('userID');
        $orderModel = new OrderModel();
        $orderItemModel = new OrderItemModel();
        $merchandiseModel = new MerchandiseModel();
        $orders = $orderModel->where('userID', $userID)->orderBy('order_date', 'DESC')->findAll();
        // For each order, get its items and merchandise names
        foreach ($orders as &$order) {
            $items = $orderItemModel->where('orderID', $order['orderID'])->findAll();
            foreach ($items as &$item) {
                $merch = $merchandiseModel->find($item['merchandiseID']);
                $item['merchandise_name'] = $merch ? $merch['name'] : 'Unknown';
            }
            $order['items'] = $items;
        }
        unset($order); // break reference
        return view('member/order_history', ['orders' => $orders]);
    }

    public function pointCheckout()
    {
        $itemId = $this->request->getPost('item_id');
        $shippingOption = $this->request->getPost('shipping_option') ?? 'pickup';
        $userID = session()->get('userID');
        $userModel = new UserModel();
        $user = $userModel->find($userID);
        $userPoints = $user['balancePoint'] ?? 0;
        $merchandiseModel = new MerchandiseModel();
        $item = $merchandiseModel->find($itemId);
        $address = [
            'fullName' => $this->request->getPost('fullName'),
            'phone' => $this->request->getPost('phone'),
            'address' => $this->request->getPost('address'),
            'city' => $this->request->getPost('city'),
            'state' => $this->request->getPost('state'),
            'postcode' => $this->request->getPost('postcode'),
        ];
        $errors = [];
        if (!$item || !$item['is_redeemable'] || $item['point_cost'] <= 0) {
            return redirect()->to('/shop')->with('error', 'Item not available for point redemption.');
        }
        if ($item['stock_quantity'] <= 0) {
            return redirect()->to('/shop')->with('error', 'Item is out of stock.');
        }
        $shippingCost = ($shippingOption === 'delivery') ? 5.00 : 0.00;
        $shippingPoints = ($shippingOption === 'delivery') ? 5 : 0;
        $totalPoints = $item['point_cost'] + $shippingPoints;
        // If delivery, validate address fields
        if ($shippingOption === 'delivery') {
            foreach ($address as $key => $val) {
                if (empty($val)) {
                    $errors[] = ucfirst($key) . ' is required for delivery.';
                }
            }
        }
        if (!empty($errors)) {
            return view('member/point_checkout', [
                'item' => $item,
                'pointsRequired' => $item['point_cost'],
                'userPoints' => $userPoints,
                'shippingOption' => $shippingOption,
                'shippingCost' => $shippingCost,
                'address' => $address,
                'errors' => $errors,
                'userName' => $user['name'] ?? '',
                'userPhone' => $user['phone'] ?? ''
            ]);
        }
        // Store in session for confirmation
        session()->set('redeem_item', $item);
        session()->set('redeem_shipping_option', $shippingOption);
        session()->set('redeem_shipping_points', $shippingPoints);
        if ($shippingOption === 'delivery') {
            session()->set('redeem_address', $address);
        } else {
            session()->remove('redeem_address');
        }
        return view('member/point_checkout', [
            'item' => $item,
            'pointsRequired' => $item['point_cost'],
            'userPoints' => $userPoints,
            'shippingOption' => $shippingOption,
            'shippingCost' => $shippingCost,
            'address' => $address,
            'errors' => $errors,
            'userName' => $user['name'] ?? '',
            'userPhone' => $user['phone'] ?? ''
        ]);
    }

    public function confirmPointRedemption()
    {
        $item = session()->get('redeem_item');
        $shippingOption = session()->get('redeem_shipping_option') ?? 'pickup';
        $shippingPoints = session()->get('redeem_shipping_points') ?? 0;
        $address = session()->get('redeem_address');
        if (!$item) {
            return redirect()->to('/shop')->with('error', 'No item selected for redemption.');
        }
        $userID = session()->get('userID');
        $userModel = new UserModel();
        $user = $userModel->find($userID);
        $userPoints = $user['balancePoint'] ?? 0;
        $totalPoints = $item['point_cost'] + $shippingPoints;
        $shippingCost = ($shippingOption === 'delivery') ? 5.00 : 0.00;
        if ($userPoints < $totalPoints) {
            return redirect()->to('member/pointCheckout')->with('error', 'Not enough points.');
        }
        $merchandiseModel = new MerchandiseModel();
        $orderModel = new OrderModel();
        $orderItemModel = new OrderItemModel();
        $pointTransactionModel = new PointTransactionModel();
        // Double-check stock
        $freshItem = $merchandiseModel->find($item['merchandiseID']);
        if ($freshItem['stock_quantity'] <= 0) {
            session()->remove('redeem_item');
            return redirect()->to('/shop')->with('error', 'Item is out of stock.');
        }
        // Create order for redemption
        $orderData = [
            'userID' => $userID,
            'order_type' => 'redemption',
            'total_amount' => 0,
            'discount_amount' => 0,
            'final_amount' => 0,
            'points_earned' => 0,
            'points_used' => $totalPoints,
            'status' => 'paid',
            'order_date' => date('Y-m-d H:i:s'),
            'shipping_option' => $shippingOption,
            'shipping_cost' => $shippingCost
        ];
        if ($shippingOption === 'delivery' && $address) {
            $orderData['delivery_address'] = json_encode($address);
        }
        $orderID = $orderModel->insert($orderData);
        $orderItemModel->insert([
            'orderID' => $orderID,
            'merchandiseID' => $item['merchandiseID'],
            'quantity' => 1,
            'unit_price' => 0,
            'total_price' => 0,
            'points_used' => $item['point_cost']
        ]);
        // If delivery, record shipping as a separate point transaction (optional)
        if ($shippingPoints > 0) {
            $orderItemModel->insert([
                'orderID' => $orderID,
                'merchandiseID' => null,
                'quantity' => 1,
                'unit_price' => 0,
                'total_price' => 0,
                'points_used' => $shippingPoints,
                'description' => 'Shipping (delivery)'
            ]);
        }
        $merchandiseModel->update($item['merchandiseID'], [
            'stock_quantity' => $freshItem['stock_quantity'] - 1
        ]);
        $pointTransactionModel->insert([
            'userID' => $userID,
            'points' => -$totalPoints,
            'type' => 'redemption',
            'description' => 'Points used for merchandise redemption' . ($shippingPoints > 0 ? ' (including shipping)' : ''),
            'reference_id' => $orderID,
            'reference_type' => 'order',
            'transaction_date' => date('Y-m-d H:i:s')
        ]);
        $userModel->update($userID, [
            'balancePoint' => $userPoints - $totalPoints
        ]);
        session()->set('balancePoint', $userPoints - $totalPoints);
        session()->remove('redeem_item');
        session()->remove('redeem_shipping_option');
        session()->remove('redeem_shipping_points');
        session()->remove('redeem_address');
        return redirect()->to('/shop')->with('success', 'Item redeemed successfully! ' . $totalPoints . ' points have been deducted from your account.' . ($shippingPoints > 0 ? ' (including 5 points for delivery)' : ''));
    }
}