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
                                <!-- Loop para exibir opções de clientes -->
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="itens">Itens Vendidos:</label>
                            <!-- Campos para adicionar itens vendidos -->
                        </div>

                        <div class="form-group">
                            <label for="forma_pagamento">Forma de Pagamento:</label>
                            <select id="forma_pagamento" name="forma_pagamento" class="form-control">
                                <option value="">Selecione a forma de pagamento</option>
                                <!-- Opções de formas de pagamento -->
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="parcelas">Gerar Parcelas:</label>
                            <!-- Campos para gerar parcelas -->
                        </div>

                        <button type="submit" class="btn btn-primary">Cadastrar Venda</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection