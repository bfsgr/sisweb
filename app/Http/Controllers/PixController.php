<?php

namespace App\Http\Controllers;

use App\Models\Pix;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PixController extends Controller
{

    public function index(): View
    {
        $pix = Pix::where('user_id', auth()->id())->paginate(10);

        return view('pix', compact('pix'));
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
