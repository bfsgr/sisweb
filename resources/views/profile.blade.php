<x-layout>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if(Route::is('clients.create'))
                    <div class="alert alert-info">
                        <p>O cliente receberá um link por e-mail para criar a senha de acesso</p>
                    </div>
                @endif

                @if (Route::is('register'))
                    <div class="text-center welcome-img">
                        <img alt="Logomarca" src="/logo.svg" height="100px" />
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <p>Foram encontrados errors nos dados</p>
                    </div>
                @endif

                <form method="post"
                      @if(Route::is('clients.create'))
                          action="{{ route('clients.store') }}"
                      @elseif (Route::is('clients.edit'))
                          action="{{ route('clients.update', $user->id) }}"
                    @endif
                >
                    @if(Route::is('clients.edit'))
                        @method('put')
                    @endif
                    
                    @csrf
                    <fieldset>
                        <legend>Informações de acesso</legend>
                        <div class="form-group @error('email') has-error @enderror">
                            <label for="email">Email</label>
                            <input
                                id="email"
                                type="email"
                                class="form-control"
                                name="email"
                                placeholder="Email"
                                required
                                value="{{ old('email') ?? $user->email ?? "" }}"
                                @if($user && !Route::is('clients.edit')) readonly @endif
                                @error('email') aria-describedby="emailError" @enderror
                            />
                            @error('email')
                            <span id="emailError" class="help-block">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                        @if(Route::is('register') || Route::is('profile'))
                            <div class="form-group @error('password') has-error @enderror">
                                <label for="password">Senha</label>
                                <input
                                    id="password"
                                    class="form-control"
                                    type="password"
                                    name="password"
                                    placeholder="Senha"
                                    required
                                    @error('password') aria-describedby="passwordError" @enderror
                                />
                                @error('password')
                                <span id="passwordError" class="help-block">
                                {{ $message }}
                            </span>
                                @enderror
                            </div>
                        @endif
                    </fieldset>

                    <fieldset>
                        <legend>Informações pessoais</legend>
                        <div class="form-group @error('name') has-error @enderror">
                            <label for="name">Nome</label>
                            <input
                                id="name"
                                class="form-control"
                                type="text"
                                name="name"
                                placeholder="Nome"
                                required
                                minlength="3"
                                value="{{ old('name') ?? $user->name ?? "" }}"
                                @error('name') aria-describedby="nameError" @enderror
                            />
                            @error('name')
                            <span id="nameError" class="help-block">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                        <div class="form-group @error('rg') has-error @enderror">
                            <label for="rg">RG</label>
                            <input
                                type="text"
                                id="rg"
                                class="form-control"
                                name="rg"
                                placeholder="00.000.000-0"
                                data-mask="00.000.000-A"
                                minlength="12"
                                maxlength="12"
                                required
                                value="{{ old('rg') ?? $user->rg ?? "" }}"
                                @if($user && !Route::is('clients.edit')) readonly @endif
                                @error('rg') aria-describedby="rgError" @enderror
                            />
                            @error('rg')
                            <span id="rgError" class="help-block">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>

                        <div class="form-group @error('cpf') has-error @enderror">
                            <label for="cpf">CPF</label>
                            <input
                                type="text"
                                id="cpf"
                                class="form-control"
                                name="cpf"
                                placeholder="000.000.000-00"
                                data-mask="000.000.000-00"
                                minlength="14"
                                maxlength="14"
                                required
                                value="{{ old('cpf') ?? $user->cpf ?? "" }}"
                                @if($user && !Route::is('clients.edit')) readonly @endif
                                @error('cpf') aria-describedby="cpfError" @enderror
                            />
                            @error('cpf')
                            <span id="cpfError" class="help-block">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>

                    </fieldset>

                    <fieldset>
                        <legend>Endereço</legend>
                        <div class="form-group @error('cep') has-error @enderror">
                            <label for="cep">CEP</label>
                            <input
                                type="text"
                                id="cep"
                                class="form-control "
                                name="cep"
                                placeholder="00000-000"
                                data-mask="00000-000"
                                minlength="9"
                                maxlength="9"
                                required
                                value="{{ old('cep') ?? $user->cep ?? "" }}"
                                @error('cep') aria-describedby="cepError" @enderror
                            />


                            @error('cep')
                            <span id="cepError" class="help-block">
                                {{ $message }}
                            </span>
                            @else
                                <span id="cepHelper" class="help-block">
                                Digite o CEP para buscar o endereço automaticamente
                            </span>
                                @enderror


                        </div>

                        <div class="form-group @error('address') has-error @enderror">
                            <label for="address">Endereço</label>
                            <input
                                type="text"
                                id="address"
                                class="form-control"
                                name="address"
                                placeholder="Endereço"
                                readonly
                                minlength="3"
                                required
                                value="{{ old('address') ?? $user->address ?? "" }}"
                                @error('address') aria-describedby="addressError" @enderror
                            />
                            @error('address')
                            <span id="addressError" class="help-block">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>

                        <div class="form-group @error('addressNumber') has-error @enderror">
                            <label for="addressNumber">Número</label>
                            <input
                                type="text"
                                id="addressNumber"
                                class="form-control"
                                name="addressNumber"
                                placeholder="Número"
                                minlength="1"
                                required
                                value="{{ old('addressNumber') ?? $user->addressNumber ?? "" }}"
                                @error('addressNumber') aria-describedby="addressNumberError" @enderror
                            />
                            @error('addressNumber')
                            <span id="addressNumberError" class="help-block">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>

                        <div class="form-group @error('complement') has-error @enderror">
                            <label for="complement">Complemento</label>
                            <input
                                type="text"
                                id="complement"
                                class="form-control"
                                name="complement"
                                required
                                placeholder="Complemento"
                                value="{{ old('complement') ?? $user->complement ?? "" }}"
                                @error('complement') aria-describedby="complementError" @enderror
                            />
                            @error('complement')
                            <span id="complementError" class="help-block">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>

                        <div class="form-group @error('neighborhood') has-error @enderror">
                            <label for="neighborhood">Bairro</label>
                            <input
                                type="text"
                                id="neighborhood"
                                class="form-control"
                                name="neighborhood"
                                placeholder="Bairro"
                                readonly
                                required
                                value="{{ old('neighborhood') ??  $user->neighborhood ?? "" }}"
                                @error('neighborhood') aria-describedby="neighborhoodError" @enderror
                            />
                            @error('neighborhood')
                            <span id="neighborhoodError" class="help-block">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>

                        <div class="form-group @error('city') has-error @enderror">
                            <label for="city">Cidade</label>
                            <input
                                type="text"
                                id="city"
                                class="form-control"
                                name="city"
                                placeholder="Cidade"
                                required
                                readonly
                                value="{{ old('city') ?? $user->city ?? "" }}"
                                @error('city') aria-describedby="cityError" @enderror
                            />
                            @error('city')
                            <span id="cityError" class="help-block">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>

                        <div class="form-group @error('state') has-error @enderror">
                            <label for="state">Estado</label>
                            <select class="form-control" id="state" name="state" required autocomplete="off" readonly=""
                                    @error('state') aria-describedby="stateError" @enderror>
                                <option value="" hidden @selected($user == null && old('state') == null)>Selecione
                                </option>
                                @foreach(array_column(App\Enums\States::cases(), 'value') as $state)
                                    <option
                                        value="{{ $state }}"
                                        @if(old('state') == $state)
                                            selected=""
                                        @elseif (old('state') == null && $user != null && $user->state == $state)
                                            selected=""
                                        @endif
                                    >
                                        {{ $state }}
                                    </option>
                                @endforeach
                            </select>
                            @error('state')
                            <span id="stateError" class="help-block">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </fieldset>

                    <div class="form-group text-right" role="group">
                        @if($user)
                            <button id="revert-btn" class="btn btn-default" type="reset">
                                Limpar
                            </button>
                            <button class="btn btn-primary" type="submit">
                                Salvar alterações
                            </button>
                        @else
                            @auth
                                <button id="revert-btn" class="btn btn-default" type="reset">
                                    Limpar
                                </button>
                            @else
                                <a class="btn btn-default" href="/login">
                                    Login
                                </a>
                            @endauth
                            <button class="btn btn-primary" type="submit">
                                Cadastrar
                            </button>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
    @vite('resources/js/profile.js')
</x-layout>
