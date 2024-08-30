<x-layout>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form id="comment-form" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="text">Novo comentário</label>
                        <textarea
                            id="text"
                            name="text"
                            class="form-control"
                            placeholder="Adicione um comentário ou sugestão"
                            rows="3"
                            required
                            minlength="3"
                        ></textarea>
                    </div>
                    <div class="form-group text-right">
                        <button class="btn btn-outline" type="reset">Limpar</button>
                        <button class="btn btn-primary" type="submit">Adicionar</button>
                    </div>
                </form>
            </div>
        </div>

        @forelse($comments as $comment)
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            {{$comment->text}}
                        </div>
                        <div class="panel-footer legend-with-btn">
                            {{$comment->user->name}}
                            - {{ $comment->created_at->setTimezone('America/Sao_Paulo')->format('d/m/Y, H:i')  }}
                            <form method="post" action="/comments/{{$comment->id}}">
                                @csrf
                                @method('delete')
                                <button class="btn btn-danger">
                                    <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="row">
                <div class="col-md-12 text-center">
                    <p>Nenhum comentário ou sugestão cadastrado</p>
                </div>
            </div>

        @endforelse
    </div>
</x-layout>
