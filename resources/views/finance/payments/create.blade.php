@extends('layouts.main')

@section('content')

<div class="container">

    <h1 class="display-6 mb-5"> Cadastro de Contas a Pagar</h1>

    <form class="" method="POST" autocomplete="off" enctype="multipart/form-data">
        @csrf
        @if (isset($payment->id))
            @method('PUT')
        @endif

        <div class="row g-3 mb-4 border p-3 shadow-hover">
            <h5 class="card-title">Dados gerais</h5>
            <div class="col-md-2">
                <label for="date" class="form-label">Data da compra</label>
                <input type="date" class="form-control" name="date" value="{{ $payment->date }}" required>
            </div>
            <div class="col-md-6">
                <label for="supplier" class="form-label">Fornecedor</label>
                <select name="supplier" id="supplier" class="form-select" aria-label="Default select example"
                    required>
                    @foreach ($suppliers as $supplier)
                        <option value="{{ $supplier->id }}" @if ($supplier->id == $payment->idSupplier) selected @endif>{{ $supplier->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <label for="docnumber" class="form-label">Documento</label>
                <input type="text" class="form-control" name="docnumber" id="docnumber"
                    value="{{ $payment->docnumber }}">
            </div>
            <div class="col-md-2">
                <label for="value" class="form-label">Valor</label>
                <input type="text"
                    data-inputmask="'alias': 'decimal', 'numericInput': 'true', 'radixPoint': ',', 'groupSeparator': '.', 'removeMaskOnSubmit': 'true' "
                    class="form-control" name="value" id="value" value="{{ $payment->value }}" required>
            </div>
            <div class="col-md-2">
                <label for="duedate" class="form-label">Vencimento</label>
                <input type="date" class="form-control" name="duedate" value="{{ $payment->duedate }}" required>
            </div>
            <div class="col-md-4">
                <label for="financeplan" class="form-label">Plano financeiro</label>
                <select name="financeplan" id="financeplan" class="form-select" aria-label="Default select example"
                    required>
                    @foreach ($financeplans as $financeplan)
                        <option value="{{ $financeplan->id }}" @if ($financeplan->id == $payment->idFinancePlan) selected @endif>
                            {{ $financeplan->classification . ' - ' . $financeplan->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <label for="transaction" class="form-label">Transação</label>
                <select name="transaction" id="transaction" class="form-select" aria-label="Default select example"
                    required>
                    @foreach ($transactions as $transaction)
                        <option value="{{ $transaction->id }}" @if ($transaction->id == $payment->idTransaction) selected @endif>
                            {{ $transaction->description }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-12">
                <label for="description" class="form-label">Descrição</label>
                <input type="string" class="form-control" name="description" value="{{ $payment->description }}"
                    required>
            </div>
            <div class="col-md-12">
                <label for="formFile" class="form-label">Arquivo</label>
                <input class="form-control" type="file" id="formFile" name="formFile">
            </div>
        </div>

        <div class="col-12 mb-5">
            <button class="btn btn-primary" type="submit">Gravar título</button>
            <a class="btn btn-secondary" href="/finance/payments">Cancelar</a>
        </div>
    </form>
</div>
    
@endsection