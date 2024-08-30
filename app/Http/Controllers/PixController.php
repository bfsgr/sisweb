<?php

namespace App\Http\Controllers;

use App\Models\Pix;
use App\Rules\CpfRule;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
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
        return view('pix-form', ['pix' => null]);
    }

    public function store(): RedirectResponse
    {
        $result = $this->instantiate(null, request()->all());

        if ($result instanceof RedirectResponse) {
            return $result;
        }

        $pix = $result;

        if ($pix->save()) {
            return redirect()->route('pix.index');
        } else {
            return back()->withInput();
        }
    }

    public function edit(int $id): View|RedirectResponse
    {
        $pix = Pix::findOrFail($id);

        if ($pix->user_id !== auth()->id()) {
            return redirect()->route('pix.index');
        }

        return view('pix-form', compact('pix'));
    }

    public function update($id): RedirectResponse
    {
        $result = $this->instantiate($id, request()->all());

        if ($result instanceof RedirectResponse) {
            return $result;
        }

        $pix = $result;

        if ($pix->save()) {
            return redirect()->route('pix.index');
        } else {
            return back()->withInput();
        }
    }

    public function destroy(int $id): RedirectResponse
    {
        $pix = Pix::findOrFail($id);

        if ($pix->user_id !== auth()->id()) {
            return redirect()->route('pix.index');
        }

        $pix->delete();

        return redirect()->route('pix.index');
    }

    private function instantiate(int|null $id, array $data): Pix|RedirectResponse
    {
        $validator = Validator::make(request()->all(), [
            'type' => 'required|in:cpf,phone,email',
            'key' => [
                'required',
                Rule::unique('pix')->where(function ($query) {
                    return $query->where('user_id', auth()->id())
                        ->where('key', request()->get('key'))
                        ->where('type', request()->get('type'));
                }),
                'max:255'
            ]
        ]);

        $validator->sometimes('key', 'email', function ($input) {
            return $input->type === 'email';
        });

        $validator->sometimes('key', 'min:10|max:11', function ($input) {
            return $input->type === 'phone';
        });

        $validator->sometimes('key', ['size:11', new CpfRule()], function ($input) {
            return $input->type === 'cpf';
        });

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $data = $validator->validated();

        if ($id) {
            $pix = Pix::findOrFail($id);

            if ($pix->user_id !== auth()->id()) {
                return redirect()->route('pix.index');
            }
        } else {
            $pix = new Pix();
        }

        $pix->type = $data['type'];
        $pix->key = $data['key'];
        if (!$id) {
            $pix->user_id = auth()->id();
        }

        return $pix;
    }
}
