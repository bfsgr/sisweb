<x-layout>
    <div class="container">
        <form method="post">
            <fieldset>
                <legend>Cadastrar nova chave pix</legend>
                <div class="form-group">
                    <label for="type">Tipo</label>
                    <select id="type" class="form-control" name="type" required>
                        <option hidden value="">-</option>
                        <option value="celular">Celular</option>
                        <option value="email">Email</option>
                        <option value="cpf">CPF</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="key">Chave</label>
                    <input
                        type="text"
                        id="key"
                        class="form-control"
                        name="key"
                        placeholder="Chave"
                        required
                    />
                </div>

                <div class="form-group text-right" role="group">
                    <button class="btn btn-default" type="button">Cancelar</button>
                    <button class="btn btn-primary" type="submit">Cadastrar</button>
                </div>
            </fieldset>
        </form>
    </div>
</x-layout>
