@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Listagem de Vendas') }}</div>

                <div class="card-body">
                    <!-- Filtros de pesquisa -->
                    <form method="GET" action="{{ route('vendas.index') }}">
                        <div class="form-group">
                            <label for="cliente">Filtrar por Cliente:</label>
                            <select id="cliente" name="cliente" class="form-control">
                                <option value="">Todos</option>
                                @foreach ($clientes as $cliente)
                                    <option value="{{ $cliente->id }}">{{ $cliente->nome }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="forma_pagamento">Filtrar por Forma de Pagamento:</label>
                            <select id="forma_pagamento" name="forma_pagamento" class="form-control">
                                <option value="">Todas</option>
                                @foreach ($formasPagamento as $forma)
                                    <option value="{{ $forma }}">{{ $forma }}</option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Filtrar</button>
                    </form>

                    <!-- Tabela de listagem de vendas -->
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Data</th>
                                <th>Cliente</th>
                                <th>Forma de Pagamento</th>
                                <!-- Outros cabeçalhos de coluna -->
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($vendas as $venda)
                                <tr>
                                    <td>{{ $venda->created_at->format('d/m/Y H:i:s') }}</td>
                                    <td>{{ $venda->cliente ? $venda->cliente->nome : '-' }}</td>
                                    <td>{{ $venda->forma_pagamento }}</td>
                                    <!-- Outras colunas -->
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{ $vendas->links() }} <!-- Paginação -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection