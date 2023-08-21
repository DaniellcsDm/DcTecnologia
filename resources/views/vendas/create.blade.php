@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Cadastro de Vendas') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('vendas.store') }}">
                        @csrf

                        <div class="form-group">
                            <label for="cliente_id">Cliente (opcional):</label>
                            <select id="cliente_id" name="cliente_id" class="form-control">
                                <option value="">Selecione um cliente</option>
                                @foreach ($clientes as $cliente)
                                    <option value="{{ $cliente->id }}">{{ $cliente->nome }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="itens">Itens Vendidos:</label>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Produto</th>
                                        <th>Quantidade</th>
                                        <th>Valor Unitário</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($produtos as $produto)
                                        <tr>
                                            <td>{{ $produto->nome }}</td>
                                            <td><input type="number" name="produtos[{{ $produto->id }}][quantidade]" class="form-control" value="0"></td>
                                            <td><input type="number" name="produtos[{{ $produto->id }}][valor]" class="form-control" step="0.01"></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="form-group">
                            <label for="forma_pagamento">Forma de Pagamento:</label>
                            <select id="forma_pagamento" name="forma_pagamento" class="form-control">
                                <option value="">Selecione a forma de pagamento</option>
                                <option value="avista">À Vista</option>
                                <option value="parcelado">Parcelado</option>
                            </select>
                        </div>

                        <div class="form-group" id="parcelas-group" style="display: none;">
                            <label for="parcelas">Gerar Parcelas:</label>
                            <input type="number" name="num_parcelas" id="num_parcelas" class="form-control" min="1">
                            <button type="button" id="generate-parcelas" class="btn btn-secondary">Gerar Parcelas</button>
                        </div>

                        <ul id="parcelas-list" style="display: none;"></ul>

                        <button type="submit" class="btn btn-primary">Cadastrar Venda</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const formaPagamentoSelect = document.getElementById("forma_pagamento");
        const parcelasGroup = document.getElementById("parcelas-group");
        const parcelasList = document.getElementById("parcelas-list");
        const numParcelasInput = document.getElementById("num_parcelas");
        const generateParcelasButton = document.getElementById("generate-parcelas");

        formaPagamentoSelect.addEventListener("change", function () {
            if (this.value === "parcelado") {
                parcelasGroup.style.display = "block";
            } else {
                parcelasGroup.style.display = "none";
                parcelasList.style.display = "none";
            }
        });

        const clienteSelect = document.getElementById("cliente_id");
        const itensVendidos = document.getElementById("itens-vendidos");
        const itensVendidosBody = document.getElementById("itens-vendidos-body");
        const addItemButton = document.getElementById("add-item");
        let itemCount = 1;

        clienteSelect.addEventListener("change", function () {
            if (this.value !== "") {
                itensVendidos.style.display = "block";
            } else {
                itensVendidos.style.display = "none";
            }
        });

        addItemButton.addEventListener("click", function () {
            const row = document.createElement("tr");

            const produtoCell = document.createElement("td");
            const produtoSelect = document.createElement("select");
            produtoSelect.name = `itens[${itemCount}][produto_id]`;
            produtoSelect.classList.add("form-control");
            produtoSelect.innerHTML = `<option value="">Selecione um produto</option>
                                        @foreach ($produtos as $produto)
                                            <option value="{{ $produto->id }}">{{ $produto->nome }}</option>
                                        @endforeach`;
            produtoCell.appendChild(produtoSelect);
            row.appendChild(produtoCell);

            const quantidadeInput = document.createElement("input");
            quantidadeInput.type = "number";
            quantidadeInput.name = `itens[${itemCount}][quantidade]`;
            quantidadeInput.classList.add("form-control");
            quantidadeInput.value = "0";
            const quantidadeCell = document.createElement("td");
            quantidadeCell.appendChild(quantidadeInput);
            row.appendChild(quantidadeCell);

            const valorInput = document.createElement("input");
            valorInput.type = "number";
            valorInput.name = `itens[${itemCount}][valor]`;
            valorInput.step = "0.01";
            valorInput.classList.add("form-control");
            const valorCell = document.createElement("td");
            valorCell.appendChild(valorInput);
            row.appendChild(valorCell);

            itensVendidosBody.appendChild(row);
            itemCount++;
        });

        generateParcelasButton.addEventListener("click", function () {
            const numParcelas = parseInt(numParcelasInput.value);
            const parcelas = document.getElementById("parcelas-list");
            parcelas.innerHTML = "";

            for (let i = 0; i < numParcelas; i++) {
                const listItem = document.createElement("li");
                
                const dataInput = document.createElement("input");
                dataInput.type = "date";
                dataInput.name = `parcelas[${i}][data]`;
                dataInput.classList.add("form-control");
                listItem.appendChild(dataInput);
                
                const valorInput = document.createElement("input");
                valorInput.type = "number";
                valorInput.name = `parcelas[${i}][valor]`;
                valorInput.step = "0.01";
                valorInput.classList.add("form-control");
                listItem.appendChild(valorInput);

                const observacoesInput = document.createElement("input");
                observacoesInput.type = "text";
                observacoesInput.name = `parcelas[${i}][observacoes]`;
                observacoesInput.placeholder = "Observações";
                observacoesInput.classList.add("form-control");
                listItem.appendChild(observacoesInput);

                parcelas.appendChild(listItem);
            }

            parcelasList.style.display = "block";
        });
    });
</script>

@endsection