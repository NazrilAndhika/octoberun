<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function index()
    {
        return view('user.daftar');
    }

    // Tambahkan fungsi ini
    public function payment()
    {
        return view('user.pembayaran');
    }
}