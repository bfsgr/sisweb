<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class CardController extends Controller
{
    public function index(): View
    {
        return view('cards');
    }

    public function create(): View
    {
        return view('card-form');
    }

    public function edit(int $id): View
    {
        return view('card-form');
    }
}
