<?php

namespace App\Controllers;

class Home extends WebController
{
    public function index(): string
    {
        return view('welcome_message');
    }
}
