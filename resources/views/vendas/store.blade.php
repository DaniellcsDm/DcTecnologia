@extends('layouts.app')

@section('content')
    <h1>Criar Nova Venda</h1>
    <form action="{{ route('vendas.store') }}" method="POST">
        @csrf
        <!-- Campos do formulário -->
        <!-- Cliente, Valor Total, Forma de Pagamento, Produtos vendidos, etc. -->
        <button type="submit">Criar Venda</button>
    </form>

    <a href="{{ route('vendas.index') }}">Voltar para a lista de vendas</a>
@endsection