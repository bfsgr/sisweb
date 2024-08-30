<?php

namespace App\Http\Controllers;

use App\Enums\States;
use App\Models\User;
use App\Rules\CpfRule;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Str;

class ClientController extends Controller
{
    public function index(): View
    {
        if (request()->user()->cannot('viewAny', User::class)) {
            abort(403);
        }

        $clients = User::whereRole('customer')->paginate(10);

        return view('clients', compact('clients'));
    }

    public function create(): View
    {
        if (request()->user()->cannot('create', User::class)) {
            abort(403);
        }

        return view('profile', ['user' => null]);
    }

    public function store(): RedirectResponse
    {
        if (request()->user()->cannot('create', User::class)) {
            abort(403);
        }

        $validator = Validator::make(request()->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'cpf' => ['required', new CpfRule(), 'unique:users', 'size:11'],
            'rg' => 'required|size:9|unique:users',
            'cep' => 'required|size:8',
            'city' => 'required',
            'address' => 'required',
            'addressNumber' => 'required',
            'complement' => 'required',
            'neighborhood' => 'required',
            'state' => ['required', Rule::enum(States::class)]
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput(request()->except('password'));
        }

        $data = $validator->validated();

        $newUser = new User([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt(Str::random(16)),
            'cpf' => $data['cpf'],
            'rg' => $data['rg'],
            'cep' => $data['cep'],
            'city' => $data['city'],
            'address' => $data['address'],
            'addressNumber' => $data['addressNumber'],
            'complement' => $data['complement'],
            'neighborhood' => $data['neighborhood'],
            'state' => $data['state']
        ]);

        if ($newUser->save()) {
            Password::sendResetLink(['email' => $newUser['email']]);

            return redirect()->route('clients.index');
        } else {
            return back()->with('error', 'Erro ao criar usuário')->withInput(request()->except('password'));
        }
    }
}
