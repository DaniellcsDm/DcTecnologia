@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Editar Venda') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('vendas.update', $venda->id) }}">
                        @csrf
                        @method('PUT')

                        <!-- Campos do formulário de edição -->

                        <button type="submit" class="btn btn-primary">Atualizar Venda</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection