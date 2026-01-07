<?php

namespace App\Controllers;

class About extends WebController
{
    public function index(): string
    {
        $data = [
            'title' => 'About Us',
        ];

        return $this->render('about', $data);
    }
}
