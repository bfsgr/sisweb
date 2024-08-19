<x-layout>
    <div class="container">
        <form method="post">
            @csrf
            <fieldset>
                <legend>Cadastrar novo cartão</legend>
                <div class="form-group">
                    <label for="type">Tipo</label>
                    <select id="type" class="form-control" name="type" required>
                        <option hidden value="">-</option>
                        <option value="debit">Débito</option>
                        <option value="credit">Crédito</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="flag">Bandeira</label>
                    <select id="flag" class="form-control" name="flag" required>
                        <option hidden value="">-</option>
                        <option value="mastercard">Mastercard</option>
                        <option value="visa">Visa</option>
                        <option value="elo">Elo</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="number">Número</label>
                    <input
                        type="text"
                        id="number"
                        class="form-control"
                        name="number"
                        placeholder="Número"
                        data-mask="0000 0000 0000 0000"
                        minlength="19"
                        required
                    />
                </div>

                <div class="form-group">
                    <label for="expiration">Data de validade</label>
                    <input
                        type="text"
                        id="expiration"
                        class="form-control"
                        name="expiration"
                        placeholder="MM/AA"
                        data-mask="00/00"
                        required
                    />
                </div>

                <div class="form-group">
                    <label for="cvv">CVV</label>
                    <input
                        type="text"
                        id="cvv"
                        class="form-control"
                        name="cvv"
                        placeholder="CVV"
                        data-mask="000"
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
