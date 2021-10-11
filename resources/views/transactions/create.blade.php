@extends('layouts.main')

@section('content')

    <div class="container">
        <h1 class="display-6 mb-5"> Cadastro de transações</h1>


        <form class="" method="POST" autocomplete="off">
            @csrf
            @if (isset($transaction->id))
                @method('PUT')
            @endif

            <div class="row g-3 mb-4 border p-3 shadow-hover">
                <h5 class="card-title">Dados gerais</h5>
                <div class="col-md-6">
                    <label for="tnsDescription" class="form-label">Descrição</label>
                    <input type="text" class="form-control" name="tnsDescription" value="{{ $transaction->description }}"
                        required>
                </div>
                <div class="col-md-3">
                    <label for="tnsModule" class="form-label">Módulo</label>
                    <select class="form-control" name="tnsModule" id="tnsModule" required>
                        @if (!isset($transaction->id)) <option value="" disabled selected></option> @endif
                        <option value="CPR" @if ($transaction->module == 'CPR') selected @endif>Compras</option>
                        <option value="PAG" @if ($transaction->module == 'PAG') selected @endif>Contas a pagar</option>
                        <option value="REC" @if ($transaction->module == 'REC') selected @endif>Contas a receber</option>
                        <option value="TES" @if ($transaction->module == 'TES') selected @endif>Tesouraria</option>
                        <option value="VEN" @if ($transaction->module == 'VEN') selected @endif>Vendas</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="tnsType" class="form-label">Tipo</label>
                    <select class="form-control" name="tnsType" id="tnsType" required>
                        @if (!isset($transaction->id)) <option value="" disabled selected></option> @endif
                        <option value="NA" @if ($transaction->type == 'NA') selected @endif>Não é baixa</option>
                        <option value="DE" @if ($transaction->type == 'DE') selected @endif>Devolução</option>
                        <option value="PG" @if ($transaction->type == 'PG') selected @endif>Pagamento</option>
                        <option value="AD" @if ($transaction->type == 'AD') selected @endif>Adiantamento</option>
                        <option value="CR" @if ($transaction->type == 'CR') selected @endif>Crédito</option>
                        <option value="DB" @if ($transaction->type == 'DB') selected @endif>Débito</option>
                    </select>
                </div>
            </div>

            <div class="col-12 mb-5">
                <button class="btn btn-primary" type="submit"><i class="far fa-save"></i> Gravar transação</button>
                <a class="btn btn-secondary" href="/registers/transactions"><i class="far fa-window-close"></i> Cancelar</a>
            </div>

        </form>
    </div>

@endsection
