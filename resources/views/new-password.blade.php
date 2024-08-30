<x-layout>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="text-center welcome-img">
                    <img alt="Logomarca" src="{{ asset("logo.svg") }}" height="100px" />
                </div>

                <form id="reset-form" method="post">
                    @csrf
                    <legend>Nova senha</legend>
                    <div class="form-group @error('email') has-error @enderror">
                        <label for="Email">Email</label>
                        <input
                            id="email"
                            class="form-control"
                            type="email"
                            name="email"
                            placeholder="Email"
                            required
                            minlength="3"
                            readonly
                            value="{{ $email }}"
                            @error('email') aria-describedby="emailError" @enderror
                        />
                        @error('email')
                        <span id="emailError" class="help-block">
                                {{ $message }}
                        </span>
                        @enderror
                    </div>
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
                    <div class="form-group @error('password_confirmation') has-error @enderror ">
                        <label for="password_confirmation">Confirme sua senha</label>
                        <input
                            id="password_confirmation"
                            class="form-control"
                            type="password"
                            name="password_confirmation"
                            placeholder="Confirme sua senha"
                            required
                            @error('password_confirmation') aria-describedby="passwordConfirmationError" @enderror
                        />
                        @error('password_confirmation')
                        <span id="passwordConfirmationError" class="help-block">
                                {{ $message }}
                        </span>
                        @enderror
                    </div>
                    <div class="form-group text-right" role="group">
                        <button class="btn btn-primary" type="submit">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-layout>
