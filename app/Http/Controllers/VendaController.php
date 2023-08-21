<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Parcela;
use App\Models\Venda;
use Illuminate\Http\Request;
use Dompdf\Adapter\PDFLib;
use App\Models\FormaPagamento;
use App\Models\Produto;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use PDF; 


class VendaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // Middleware para verificar autenticação
    }

    public function create()
    {
        $clientes = Cliente::all();
        $formasPagamento = ['avista', 'parcelado'];
        $produtos = Produto::all();
        $chequeCount=Venda::where('forma_pagamento_id','cheque')->count();
    
        return view('vendas.create', [
            'clientes' => $clientes,
            'formasPagamento' => $formasPagamento,
            'chequeCount' => $chequeCount,
            'produtos' => $produtos,
    
        ]);
    }  

    public function store(Request $request)
    {
        $request->validate([
            'cliente_id' => 'nullable|exists:clientes,id', 
            'valor_total' => 'required|numeric|min:0',
            'forma_pagamento' => 'required|in:dinheiro,cheque,credito,debito',
            'num_parcelas' => 'required|integer|min:1',
            'data_vencimento' => 'required|date|after:today',
            'produtos' => 'required|array|min:1',
            'produtos.*.id' => 'required|exists:produtos,id',
            'produtos.*.quantidade' => 'required|integer|min:1',
        ]);
    
        $venda = Venda::create([
            'cliente_id' => $request->input('cliente_id'), 
            'valor_total' => $request->input('valor_total'),
            'forma_pagamento' => $request->input('forma_pagamento'),
            'produtos' => $request->input('produtos'),
        ]);
    
        foreach ($request->input('produtos') as $produtoId => $produtoData) {
            $produto = Produto::findOrFail($produtoId);
            $quantidade = $produtoData['quantidade'];
            $valorUnitario = $produtoData['valor'];

            $venda->produtos()->attach($produto, [
                'quantidade' => $quantidade,
                'valor_unitario' => $valorUnitario,
            ]);
        }
        // Geração de parcelas
        $valorTotal = $request->input('valor_total');
        $numParcelas = $request->input('num_parcelas');
        $dataVencimento = $request->input('data_vencimento');
    
        $valorParcela = $valorTotal / $numParcelas;
    
        for ($i = 1; $i <= $numParcelas; $i++) {
            $parcela = new Parcela([
                'vencimento' => $dataVencimento,
                'valor' => $valorParcela,
            ]);
            $venda->parcelas()->save($parcela);
    
            
            $dataVencimento = date('Y-m-d', strtotime("+1 month", strtotime($dataVencimento)));
        }
    
        return redirect()->route('vendas.index')->with('success', 'Venda criada com sucesso.');

    }



    public function index(Request $request)
    {
        $chequeCount=Venda::where('forma_pagamento_id','cheque')->count();
        $filtroCliente = $request->input('cliente');
        $filtroFormaPagamento = $request->input('formaPagamento');

        $vendas = Venda::when($filtroCliente, function ($query) use ($filtroCliente) {
            return $query->where('cliente_id', $filtroCliente);
        })
        ->when($filtroFormaPagamento, function ($query) use ($filtroFormaPagamento) {
            return $query->whereHas('formaPagamento', function ($query) use ($filtroFormaPagamento) {
                $query->where('nome', $filtroFormaPagamento);
            });
        })
        ->orderBy('created_at', 'desc')
        ->paginate(10);

        $clientes = Cliente::all();
        $formasPagamento = ['avista', 'parcelado'];

        return view('vendas.index', [
            'vendas' => $vendas,
            'clientes' => $clientes,
            'formasPagamento' => $formasPagamento,
            'chequeCount' => $chequeCount,
        ]);
    }
    

    public function show(Venda $venda)
    {
        return view('vendas.show', ['venda' => $venda]);
    }



    public function edit(Venda $venda)
    {
    // Carregue os dados necessários para os selects de cliente e forma de pagamento
    $clientes = Cliente::all();
    $formasPagamento = ['avista', 'parcelado'];
    $produtos = Produto::all(); // Carregue todos os produtos

    return view('vendas.edit', [
        'venda' => $venda,
        'clientes' => $clientes,
        'formasPagamento' => $formasPagamento,
        'produtos' => $produtos,
    ]);
    }

    public function destroy(Venda $venda)
    {
        $venda->delete();
        return redirect()->route('vendas.index')->with('success', 'Venda excluída com sucesso.');
    }

    public function generatePDF(Venda $venda)
    {
        
        $pdf = FacadePdf::loadView('vendas.pdf', ['venda' => $venda]);
        return $pdf->download('resumo_venda.pdf');
    }

}
