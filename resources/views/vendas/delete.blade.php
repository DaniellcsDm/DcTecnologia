@extends('layouts.app')

@section('content')
    <h1>Excluir Venda</h1>
    <p>Você tem certeza que deseja excluir esta venda?</p>
    <form action="{{ route('vendas.destroy', $venda->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit">Confirmar Exclusão</button>
    </form>

    <a href="{{ route('vendas.index') }}">Cancelar e voltar para a lista de vendas</a>
@endsection