<?php

namespace App\Controllers;

class Home extends WebController
{
    public function index(): string
    {
        $data = [
            'title' => 'Welcome to CodeIgniter 4 + Cockpit CMS',
            'message' => 'This is a starter project using Blade templating',
            'settings' => $this->cockpit->getSingletonCached('settings')
        ];

        return $this->render('welcome', $data);
    }
}
