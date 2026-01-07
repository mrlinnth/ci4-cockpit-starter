<?php

namespace App\Controllers;

class Home extends WebController
{
    public function index(): string
    {
        // Example data - replace with actual Cockpit CMS data
        $data = [
            'title' => 'Welcome to CodeIgniter 4 + Cockpit CMS',
            'message' => 'This is a starter project using Blade templating',
        ];

        return $this->render('welcome', $data);
    }
}
