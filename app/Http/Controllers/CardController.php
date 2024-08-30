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
        $result = $this->instantiate(null, request()->all());

        if ($result instanceof RedirectResponse) {
            return $result;
        }

        $card = $result;

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
        $result = $this->instantiate($id, request()->all());

        if ($result instanceof RedirectResponse) {
            return $result;
        }

        $card = $result;

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

    private function instantiate(int|null $id, array $data): Card|RedirectResponse
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

        if ($id) {
            $card = Card::findOrFail($id);

            if ($card->user_id !== auth()->id()) {
                return redirect()->route('cards.index');
            }
        } else {
            $card = new Card();
        }

        $card->type = $data['type'];
        $card->flag = $data['flag'];
        $card->number = $data['number'];
        $card->expiration = Carbon::createFromFormat('d/m/Y', '01/' . $data['expiration']);
        $card->cvv = $data['cvv'];
        if (!$id) {
            $card->user_id = auth()->id();
        }

        return $card;
    }
}
