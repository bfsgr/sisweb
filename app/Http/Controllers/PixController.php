<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class PixController extends Controller
{
    public function index(): View
    {
        return view('pix');
    }

    public function create(): View
    {
        return view('pix-form');
    }

    public function edit(int $id): View
    {
        return view('pix-form');
    }
}
