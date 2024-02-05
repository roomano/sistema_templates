<?php

namespace app\controllers;

class LoginController
{
    public function index()
    {
        view('auth/index', ['name' => 'Romano']);
    }
}
