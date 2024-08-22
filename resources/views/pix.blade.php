<x-layout>
    <div class="container">
        <table class="table table-bordered table-hover">
            <legend class="legend-with-btn">
                <p>Chaves pix</p>
                <a class="btn btn-primary" href="pix/create">
                    Cadastrar nova chave
                </a>
            </legend>
            <thead>
            <tr>
                <th>Chave</th>
                <th>Data de criação</th>
                <th>Tipo</th>
                <th class="text-center">Ações</th>
            </tr>
            </thead>

            <tbody>
            @forelse($pix as $p)
                <tr>
                    <td
                        @switch($p->type)
                            @case("cpf")
                                data-mask="000.000.000-00"
                        @break
                        @case("phone")
                            data-mask="(00) 00000-0000"
                        @break
                        @case("email")
                            data-mask=""
                        @break
                        @endswitch
                    >{{$p->key}}</td>
                    <td>{{$p->created_at->format("d/m/Y - H:i")}}</td>
                    <td>{{__($p->type)}}</td>
                    <td class="text-center">
                        <a class="btn btn-default" type="button" href="pix/{{$p->id}}/edit"
                        >Editar</a
                        >
                    </td>
                </tr>

            @empty
                <tr>
                    <td colspan="4" class="text-center">Nenhuma chave pix cadastrada</td>
                </tr>
            @endforelse

            </tbody>
        </table>

        <nav class="text-right" aria-label="Navegação">
            {{ $pix->links() }}
        </nav>
    </div>

</x-layout>
