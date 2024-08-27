<x-layout>
    <div class="container">
        @if ($errors->any())
            <div class="alert alert-danger">
                <p>Foram encontrados errors nos dados</p>
            </div>
        @endif
        <form id="pix-form" method="post"
              @if(Route::is('pix.create'))
                  action="/pix"
              @else
                  action="/pix/{{$pix->id}}"
            @endif
        >
            @if(Route::is('pix.edit'))
                @method('put')
            @endif
            @csrf
            <fieldset>
                @if ($pix)
                    <legend>Editar chave pix</legend>
                @else
                    <legend>Cadastrar nova chave pix</legend>
                @endif
                <div class="form-group @error('type') has-error @enderror">
                    <label for="type">Tipo</label>
                    <select id="type" class="form-control" name="type" required
                            @error('type') aria-describedby="typeError" @enderror>
                        <option hidden value="">-</option>
                        <option value="phone" @selected(old('type') == 'phone' ||  ($pix && $pix->type == 'phone'))>
                            Celular
                        </option>
                        <option value="email" @selected(old('type') == 'email' ||  ($pix && $pix->type == 'email'))>
                            Email
                        </option>
                        <option value="cpf" @selected(old('type') == 'cpf' ||  ($pix && $pix->type == 'cpf') )>CPF
                        </option>
                    </select>
                </div>

                <div class="form-group @error('key') has-error @enderror">
                    <label for="key">Chave</label>
                    <input
                        type="text"
                        id="key"
                        class="form-control"
                        name="key"
                        placeholder="Chave"
                        value="{{ old('key') ?? $pix->key ?? '' }}"
                        required
                        @error('key') aria-describedby="keyError" @enderror
                    />
                    @error('key')
                    <span id="keyError" class="help-block">
                                {{ $message }}
                    </span>
                    @enderror
                </div>

                <div class="form-group text-right" role="group">
                    <button class="btn btn-default" type="reset">Cancelar</button>
                    <button class="btn btn-primary" type="submit">
                        @if($pix)
                            Salvar
                        @else
                            Cadastrar
                        @endif
                    </button>
                </div>
            </fieldset>
        </form>
    </div>
    @vite('resources/js/pix-form.js')
</x-layout>
