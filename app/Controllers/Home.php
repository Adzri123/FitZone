<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('welcome_message');
    }

    public function about()
    {
        return view('about');
    }

    public function contactus()
{
    return view('contactus');
}


    public function membership()
    {
        return view('membership'); // Membership page view
    }

    public function merchandise()
{
    return view('merchandise');
}

public function earnRedeem()
{
    return view('earn_redeem');
}


    public function trainers()
{
    return view('trainers');
}
public function save()
{
    $trainer = $this->request->getPost('trainer');
    $date = $this->request->getPost('booking_date');
    $userId = session()->get('user_id');

    // Save to bookings table
    $this->bookingModel->save([
        'user_id' => $userId,
        'trainer' => $trainer,
        'booking_date' => $date
    ]);

    return redirect()->to('/trainers')->with('success', 'Booking confirmed!');
}



}
