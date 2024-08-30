<x-layout>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="text-center welcome-img">
                    <img alt="Logomarca" src="{{ asset("logo.svg") }}" height="100px" />
                </div>
                @if (session("error"))
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        {{ session("error") }}
                    </div>
                @endif
                @if (session("status"))
                    <div class="alert alert-info alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        {{ session("status") }}
                    </div>
                @endif
                <form id="login-form" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="Email">Email</label>
                        <input
                            id="email"
                            class="form-control"
                            type="email"
                            name="email"
                            placeholder="Email"
                            required
                            minlength="3"
                        />
                    </div>
                    <div class="form-group">
                        <label for="password">Senha</label>
                        <input
                            id="password"
                            class="form-control"
                            type="password"
                            name="password"
                            placeholder="Senha"
                            required
                        />
                    </div>
                    <div class="form-group text-right" role="group">
                        <a class="btn btn-default" type="button" href="/register">
                            Cadastrar-se
                        </a>
                        <button class="btn btn-primary" type="submit">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-layout>
