@extends('layouts.main')

@section('content')

<div class="container">
    <h1 class="display-6 mb-5"> Movimento de tesouraria - {{ $bankaccount->bank->name }}</h1>

    <form class="" method="POST" autocomplete="off">
        @csrf
        @if (isset($treasurymove->id))
            @method('PUT')
        @endif

        <div class="row g-3 mb-4 border p-3 shadow-hover">
            <div class="col-md-3">
                <label for="datemove" class="form-label">Data</label>
                <input type="date" class="form-control" name="datemove" value="{{ $treasurymove->date }}" required>
            </div>
            <div class="col-md-3">
                <label for="value" class="form-label">Valor</label>
                <input type="text"
                data-inputmask="'alias': 'decimal', 'numericInput': 'true', 'radixPoint': ',', 'groupSeparator': '.', 'removeMaskOnSubmit': 'true' "
                class="form-control" name="value" value="{{ $treasurymove->value }}" required>
            </div>
            <div class="col-md-6">
                <label for="transaction" class="form-label">Transação</label>
                <select name="transaction" id="transaction" class="form-select" aria-label="Default select example"
                    required>
                    @foreach ($transactions as $transaction)
                        <option value="{{ $transaction->id }}" @if ($transaction->id == $treasurymove->idTransaction) selected @endif>
                            {{ $transaction->description }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-12">
                <label for="description" class="form-label">Descrição</label>
                <input type="string" class="form-control" name="description" value="{{ $treasurymove->description }}"
                    required>
            </div>
            <div class="col-md-3">
                <label for="financeplan" class="form-label">Plano financeiro</label>
                <select name="financeplan" id="financeplan" class="form-select" aria-label="Default select example"
                    required>
                    @foreach ($financeplans as $financeplan)
                        <option value="{{ $financeplan->id }}" @if ($financeplan->id == $treasurymove->idFinancePlan) selected @endif>
                            {{ $financeplan->classification . ' - ' . $financeplan->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <label for="people" class="form-label">Pessoa</label>
                <select name="people" id="people" class="form-select" aria-label="Default select example"
                    required>
                    @foreach ($people as $person)
                        <option value="{{ $person->id }}" @if ($person->id == $treasurymove->idPerson) selected @endif>{{ $person->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label for="destinyAccount" class="form-label">Conta destino</label>
                <select name="destinyAccount" id="destinyAccount" class="form-select" aria-label="Default select example">
                    <option value="" selected></option>
                    @foreach ($bankaccounts as $bankaccount)
                        <option value="{{ $bankaccount->id }}" >
                            {{ $bankaccount->description }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-12 mb-5">
            <button class="btn btn-primary" type="submit">Gravar movimento</button>
            <a class="btn btn-secondary" href="/finance/treasury/{{$bankaccount->id}}">Cancelar</a>
        </div>
    </form>

</div>
    
@endsection