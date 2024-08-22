<x-layout>
    <div class="container">
        <table class="table table-bordered table-hover">
            <legend class="legend-with-btn">
                <p>Cartões</p>
                <a class="btn btn-primary" href="cards/create"
                >Cadastrar novo cartão</a
                >
            </legend>
            <thead>
            <tr>
                <th>Final do cartão</th>
                <th>Bandeira</th>
                <th>Tipo</th>
                <th class="text-center">Ações</th>
            </tr>
            </thead>

            <tbody>
            @forelse($cards as $card)
                <tr>
                    <td>{{substr($card->number, 12)}}</td>
                    <td>{{$card->flag}}</td>
                    <td>{{__($card->type)}}</td>
                    <td class="text-center">
                        <div class="btn-group">
                            <div class="btn-group">
                                <a class="btn btn-default" href="/cards/{{$card->id}}/edit">Editar</a>
                            </div>
                            <form method="post" action="/cards/{{$card->id}}" class="btn-group"
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
                    <td colspan="4" class="text-center">Nenhum cartão cadastrado</td>
                </tr>
            @endforelse


            </tbody>
        </table>

        <nav class="text-right" aria-label="Navegação">
            {{ $cards->links() }}
        </nav>
    </div>

</x-layout>
