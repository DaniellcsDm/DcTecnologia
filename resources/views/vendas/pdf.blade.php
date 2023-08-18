<h1>Resumo da Venda</h1>

<p><strong>Cliente:</strong> {{ $venda->cliente->nome ?? 'N/A' }}</p>
<p><strong>Valor Total:</strong> R$ {{ $venda->valor_total }}</p>
<p><strong>Forma de Pagamento:</strong> {{ $venda->forma_pagamento }}</p>

<h2>Parcelas:</h2>
<ul>
    @foreach($venda->parcelas as $parcela)
        <li>{{ $parcela->vencimento }} - R$ {{ $parcela->valor }}</li>
    @endforeach
    <a href="{{ route('vendas.parcelas.pdf', $venda->id) }}" class="btn btn-primary">Baixar PDF</a>
</ul>