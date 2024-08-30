<x-layout>
    <div class="container">
        <table class="table table-bordered table-hover">
            <legend class="legend-with-btn">
                <p>Clientes</p>
                <a class="btn btn-primary" href="/clients/create"
                >Cadastrar novo cliente</a
                >
            </legend>
            <thead>
            <tr>
                <th>Nome</th>
                <th>CPF</th>
                <th>Email</th>
                <th>Pedidos</th>
                <th class="text-center">Ações</th>
            </tr>
            </thead>

            <tbody>

            @forelse($clients as $client)
                <tr>
                    <td>{{$client->name}}</td>
                    <td data-mask="000.000.000-00">{{$client->cpf}}</td>
                    <td>{{$client->email}}</td>
                    <td>0</td>
                    <td class="text-center">
                        <div class="btn-group">
                            <div class="btn-group">
                                <a class="btn btn-default" href="/clients/{{$client->id}}/edit">Editar</a>
                            </div>
                            <form method="post" action="/clients/{{$client->id}}" class="btn-group"
                                  onsubmit="return confirm('Tem certeza que deseja excluir este cliente?')">
                                @csrf
                                @method('delete')
                                <button class="btn btn-danger btn-block" type="submit">Excluir</button>
                            </form>
                        </div>
                    </td>
                </tr>

            @empty
                <tr>
                    <td colspan="4" class="text-center">Nenhum cliente cadastrado</td>
                </tr>
            @endforelse

            </tbody>
        </table>

        <nav class="text-right" aria-label="Navegação">
            {{$clients->links()}}
        </nav>
    </div>
</x-layout>
