<x-layout>
    <div class="container">
        @if ($errors->any())
            <div class="alert alert-danger">
                <p>Foram encontrados errors nos dados</p>
            </div>
        @endif

        <form
            method="post"
            @if(Route::is('cards.create'))
                action="/cards"
            @else
                action="/cards/{{$card->id}}"
            @endif
        >
            @if(Route::is('cards.edit'))
                @method('put')
            @endif
            @csrf
            <fieldset>
                @if(Route::is('cards.create'))
                    <legend>Cadastrar novo cartão</legend>
                @else
                    <legend>Editar cartão</legend>
                @endif
                <div class="form-group @error('type') has-error @enderror">
                    <label for="type">Tipo</label>
                    <select id="type" class="form-control" name="type" required
                            @error('type') aria-describedby="typeError" @enderror>
                        <option hidden value="">-</option>
                        <option value="debit" @selected(old('type') == 'debit' ||  ($card && $card->type == 'debit') )>
                            Débito
                        </option>
                        <option
                            value="credit" @selected(old('type') == 'credit'  || ($card && $card->type == 'credit'))>
                            Crédito
                        </option>
                    </select>
                    @error('type')
                    <span id="stateError" class="help-block">
                                {{ $message }}
                    </span>
                    @enderror
                </div>

                <div class="form-group @error('flag') has-error @enderror">
                    <label for="flag">Bandeira</label>
                    <select id="flag" class="form-control" name="flag" required
                            @error('flag') aria-describedby="flagError" @enderror>
                        <option hidden value="">-</option>
                        <option
                            value="Mastercard" @selected(old('flag') == 'Mastercard' || ($card && $card->flag === 'Mastercard') )>
                            Mastercard
                        </option>
                        <option value="Visa" @selected(old('flag') == 'Visa' || ($card && $card->flag === 'Visa'))>
                            Visa
                        </option>
                        <option value="Elo" @selected(old('flag') == 'Elo' || ($card && $card->flag === 'Elo'))>Elo
                        </option>
                    </select>
                    @error('flag')
                    <span id="flagError" class="help-block">
                                {{ $message }}
                    </span>
                    @enderror
                </div>

                <div class="form-group @error('number') has-error @enderror">
                    <label for="number">Número</label>
                    <input
                        type="text"
                        id="number"
                        class="form-control"
                        name="number"
                        placeholder="Número"
                        data-mask="0000 0000 0000 0000"
                        minlength="19"
                        value="{{ old('number') ?? $card->number ?? '' }}"
                        required
                        @error('number') aria-describedby="numberError" @enderror
                    />
                    @error('number')
                    <span id="numberError" class="help-block">
                                {{ $message }}
                    </span>
                    @enderror
                </div>

                <div class="form-group @error('expiration') has-error @enderror">
                    <label for="expiration">Data de validade</label>
                    <input
                        type="text"
                        id="expiration"
                        class="form-control"
                        name="expiration"
                        placeholder="MM/AAAA"
                        data-mask="00/0000"
                        value="{{ old('expiration') ?? (isset($card) && $card->expiration ? date_format($card->expiration, 'm/Y') : '') }}"
                        data-ignore-submit-unmask="true"
                        required
                        @error('expiration') aria-describedby="expirationError" @enderror
                    />
                    @error('expiration')
                    <span id="expirationError" class="help-block">
                                {{ $message }}
                    </span>
                    @enderror
                </div>

                <div class="form-group @error('cvv') has-error @enderror">
                    <label for="cvv">CVV</label>
                    <input
                        type="text"
                        id="cvv"
                        class="form-control"
                        name="cvv"
                        placeholder="CVV"
                        data-mask="000"
                        value="{{ old('cvv') ?? $card->cvv ?? '' }}"
                        required
                        @error('cvv') aria-describedby="cvvError" @enderror
                    />
                    @error('cvv')
                    <span id="cvvError" class="help-block">
                                {{ $message }}
                    </span>
                    @enderror
                </div>

                <div class="form-group text-right" role="group">
                    <a class="btn btn-default" type="button" href="/cards">Voltar</a>
                    <button class="btn btn-primary" type="submit">
                        @if(Route::is('cards.create'))
                            Cadastrar
                        @else
                            Salvar
                        @endif
                    </button>
                </div>
            </fieldset>
        </form>
    </div>
</x-layout>
