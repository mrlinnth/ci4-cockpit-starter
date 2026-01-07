<?php

namespace App\Controllers;

class Contact extends WebController
{
    public function index(): string
    {
        $data = [
            'title' => 'Contact Us',
        ];

        return $this->render('contact', $data);
    }
}
