<?php

namespace App\Http\Controllers;

use App\Enums\States;
use App\Models\User;
use App\Rules\CpfRule;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Symfony\Component\Console\Input\Input;


class UserController extends Controller
{
    public function index(): View
    {
        $user = auth()->user();

        return view('profile', ['user' => $user]);
    }

    public function create(): View
    {
        return view('profile', ['user' => null]);
    }

    public function store(): View|RedirectResponse
    {
        $validator = Validator::make(request()->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'cpf' => ['required', new CpfRule(), 'unique:users', 'size:11'],
            'rg' => 'required|size:9',
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
            'password' => bcrypt($data['password']),
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
            auth()->login($newUser);

            return redirect('/comments');
        } else {
            return back()->with('error', 'Erro ao criar usuário')->withInput(request()->except('password'));
        }
    }

    public function update(): RedirectResponse
    {
        $validator = Validator::make(request()->all(), [
            'name' => 'required',
            'password' => 'required',
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

        $loggerUser = auth()->user();

        $user = User::find($loggerUser['id']);

        $user['name'] = $data['name'];
        $user['password'] = bcrypt($data['password']);
        $user['cep'] = $data['cep'];
        $user['city'] = $data['city'];
        $user['address'] = $data['address'];
        $user['addressNumber'] = $data['addressNumber'];
        $user['complement'] = $data['complement'];
        $user['neighborhood'] = $data['neighborhood'];
        $user['state'] = $data['state'];

        if ($user->save()) {
            return redirect('/profile');
        } else {
            return back()->with('error', 'Erro ao atualizar usuário')->withInput(request()->except('password'));
        }
    }
}
