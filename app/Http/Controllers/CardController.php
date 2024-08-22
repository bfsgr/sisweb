<?php

namespace App\Http\Controllers;

use App\Models\Card;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class CardController extends Controller
{
    public function index(): View
    {
        $cards = Card::where('user_id', auth()->id())->paginate(10);

        return view('cards', compact('cards'));
    }

    public function create(): View
    {
        return view('card-form', ['card' => null]);
    }

    public function store(): RedirectResponse
    {
        $validator = Validator::make(request()->all(), [
            'type' => 'required|in:credit,debit',
            'flag' => 'required|in:Visa,Mastercard,Elo',
            'number' => 'required|digits:16',
            'expiration' => 'required|size:7|date_format:m/Y|after:now',
            'cvv' => 'required|size:3',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $data = $validator->validated();

        $data['user_id'] = auth()->id();

        $card = new Card([
            'type' => $data['type'],
            'flag' => $data['flag'],
            'number' => $data['number'],
            'expiration' => Carbon::createFromFormat('d/m/Y', '01/' . $data['expiration']),
            'cvv' => $data['cvv'],
            'user_id' => $data['user_id'],
        ]);

        if ($card->save()) {
            return redirect()->route('cards.index');
        } else {
            return back()->withInput();
        }
    }

    public function edit(int $id): View|RedirectResponse
    {
        $card = Card::findOrFail($id);

        if ($card->user_id !== auth()->id()) {
            return redirect()->route('cards.index');
        }


        return view('card-form', compact('card'));
    }

    public function update($id): RedirectResponse
    {
        $card = Card::findOrFail($id);

        if ($card->user_id !== auth()->id()) {
            return redirect()->route('cards.index');
        }

        $validator = Validator::make(request()->all(), [
            'type' => 'required|in:credit,debit',
            'flag' => 'required|in:Visa,Mastercard,Elo',
            'number' => 'required|digits:16',
            'expiration' => 'required|size:7|date_format:m/Y|after:now',
            'cvv' => 'required|size:3',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $data = $validator->validated();

        $card->type = $data['type'];
        $card->flag = $data['flag'];
        $card->number = $data['number'];
        $card->expiration = Carbon::createFromFormat('d/m/Y', '01/' . $data['expiration']);
        $card->cvv = $data['cvv'];

        if ($card->save()) {
            return redirect()->route('cards.index');
        } else {
            return back()->withInput();
        }
    }

    public function destroy(int $id): RedirectResponse
    {
        $card = Card::findOrFail($id);

        if ($card->user_id !== auth()->id()) {
            return redirect()->route('cards.index');
        }

        $card->delete();

        return redirect()->route('cards.index');
    }
}
