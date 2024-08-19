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
            <tr>
                <td>9876</td>
                <td>Mastercard</td>
                <td>Crédito</td>
                <td class="text-center">
                    <a class="btn btn-default" type="button" href="cards/1/edit"
                    >Editar</a
                    >
                </td>
            </tr>

            <tr>
                <td>9873</td>
                <td>Visa</td>
                <td>Débito</td>
                <td class="text-center">
                    <a class="btn btn-default" type="button" href="cards/2/edit"
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
