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
                            @if(strlen($p->key) == 11)
                                data-mask="(00) 00000-0000"
                        @else
                            data-mask="(00) 0000-0000"
                        @endif
                        @break
                        @case("email")
                            data-mask=""
                        @break
                        @endswitch
                    >{{$p->key}}</td>
                    <td>{{$p->created_at->format("d/m/Y - H:i")}}</td>
                    <td>{{__($p->type)}}</td>
                    <td class="text-center">
                        <div class="btn-group">
                            <div class="btn-group">
                                <a class="btn btn-default" href="/pix/{{$p->id}}/edit">Editar</a>
                            </div>
                            <form method="post" action="/pix/{{$p->id}}" class="btn-group"
                                  onsubmit="return confirm('Tem certeza que deseja excluir este cartão?')">
                                @csrf
                                @method('delete')
                                <button class="btn btn-danger btn-block" type="submit">Excluir</button>
                            </form>
                        </div>
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
