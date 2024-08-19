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
            <tr>
                <td>(44) 98899-8899</td>
                <td>31/07/2024</td>
                <td>Celular</td>
                <td class="text-center">
                    <a class="btn btn-default" type="button" href="pix/1/edit"
                    >Editar</a
                    >
                </td>
            </tr>
            </tbody>
        </table>

        <nav class="text-right" aria-label="Navegação">
            <ul class="pagination">
                <li>
                    <a href="#" aria-label="Anterior">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#">5</a></li>
                <li>
                    <a href="#" aria-label="Próximo">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>

</x-layout>
