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
                <th class="text-center">Ações</th>
            </tr>
            </thead>

            <tbody>

            @forelse($clients as $client)
                <tr>
                    <td>{{$client->name}}</td>
                    <td data-mask="000.000.000-00">{{$client->cpf}}</td>
                    <td>{{$client->email}}</td>
                    <td class="text-center">
                        <a class="btn btn-default" type="button" href="/clients/{{$client->id}}/edit"
                        >Editar</a
                        >
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
