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

        $newUser = $this->instantiate(null, request()->all());

        if ($newUser instanceof RedirectResponse) {
            return $newUser;
        }

        if ($newUser->save()) {
            Password::sendResetLink(['email' => $newUser['email']]);

            return redirect()->route('clients.index');
        } else {
            return back()->with('error', 'Erro ao criar usuário')->withInput(request()->except('password'));
        }
    }

    public function edit(int $id): View
    {
        $user = User::findOrFail($id);

        if (request()->user()->cannot('update', auth()->user(), $user)) {
            abort(403);
        }

        return view('profile', compact('user'));
    }

    public function update(int $id): RedirectResponse
    {
        $user = $this->instantiate($id, request()->all());

        if ($user instanceof RedirectResponse) {
            return $user;
        }

        if ($user->save()) {
            if ($user->wasChanged('email')) {
                Password::sendResetLink(['email' => $user['email']]);
            }
            return redirect()->route('clients.index');
        } else {
            return back()->with('error', 'Erro ao atualizar usuário')->withInput(request()->except('password'));
        }
    }

    public function destroy(int $id): RedirectResponse
    {
        $user = User::findOrFail($id);

        if (request()->user()->cannot('delete', auth()->user(), $user)) {
            abort(403);
        }

        if ($user->delete()) {
            return redirect()->route('clients.index');
        } else {
            return back()->with('error', 'Erro ao deletar usuário');
        }
    }

    private function instantiate(int|null $id, array $data): User|RedirectResponse
    {
        $validator = Validator::make($data, [
            'name' => 'required',
            'email' => [
                'required',
                'email',
                'unique:users,email,' . $id,
            ],
            'cpf' => [
                'required',
                new CpfRule(),
                'unique:users,cpf,' . $id,
                'size:11'
            ],
            'rg' => [
                'required',
                'size:9',
                'unique:users,rg,' . $id
            ],
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

        if ($id) {
            $user = User::findOrFail($id);

        } else {
            $user = new User();
            $user->password = bcrypt(Str::random(8));
        }

        $user->fill([
            'name' => $data['name'],
            'email' => $data['email'],
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


        return $user;
    }
}
