<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ClientController extends Controller
{
    public function index(): View
    {
        $clients = User::whereRole('customer')->paginate(10);

        return view('clients', compact('clients'));
    }

    public function create(): View
    {
        return view('profile', ['user' => null]);
    }
}
