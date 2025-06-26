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
}
