@extends('layouts.app')

@section('content')
    <h1>Detalhes da Venda</h1>
    <p><strong>Cliente:</strong> {{ $venda->cliente->nome }}</p>
    <p><strong>Valor Total:</strong> R$ {{ number_format($venda->valor_total, 2) }}</p>
    <p><strong>Forma de Pagamento:</strong> {{ $venda->formaPagamento->nome }}</p>
    <!-- Mostrar outros detalhes da venda aqui -->

    <a href="{{ route('vendas.index') }}">Voltar para a lista de vendas</a>
@endsection