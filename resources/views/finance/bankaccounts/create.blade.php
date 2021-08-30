@extends('layouts.main')

@section('content')

    <div class="container">

        <h1 class="display-6 mb-5"> Cadastro de Contas Bancárias</h1>

        <form class="" method="POST" autocomplete="off">
            @csrf
            @if (isset($bankaccount->id))
                @method('PUT')
            @endif

            <div class="row g-3 mb-4 border p-3 shadow-hover">
                <div class="col-md-6">
                    <label for="description" class="form-label">Descrição</label>
                    <input type="text" class="form-control" name="description" value="{{ $bankaccount->description }}"
                        required>
                </div>
                <div class="col-md-6">
                    <label for="bank" class="form-label">Instituição Bancária</label>
                    <select name="bank" id="bank" class="form-select" aria-label="Default select example">
                        <option value="0">Caixa físico</option>
                        @foreach ($banks as $bank)
                            <option value="{{ $bank->id }}" @if ($bank->id == $bankaccount->idBank) Selected @endif >{{ $bank->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="agencynumber" class="form-label">Agência</label>
                    <input type="text" class="form-control" name="agencynumber" value="{{ $bankaccount->agencynumber }}">
                </div>
                <div class="col-md-3">
                    <label for="accountnumber" class="form-label">Número da Conta</label>
                    <input type="text" class="form-control" name="accountnumber" value="{{ $bankaccount->agencynumber }}">
                </div>
                <div class="col-md-3">
                    <label for="startdate" class="form-label">Data de início</label>
                    <input type="date" class="form-control" name="startdate" value="{{ $bankaccount->startdate }}">
                </div>
                <div class="col-md-3">
                    <label for="startvalue" class="form-label">Saldo inicial</label>
                    <input type="text"
                    data-inputmask="'alias': 'decimal', 'numericInput': 'true', 'radixPoint': ',', 'groupSeparator': '.', 'removeMaskOnSubmit': 'true' "
                    class="form-control" name="startvalue" value="{{ $bankaccount->startvalue }}">
                </div>
                <div class="col-md-6">
                    <label for="pixkey" class="form-label">Chave PIX</label>
                    <input type="string" class="form-control" name="pixkey" value="{{ $bankaccount->pixkey }}">
                </div>

            </div>


            <div class="col-12 mb-5">
                <button class="btn btn-primary" type="submit">Gravar conta</button>
                <a class="btn btn-secondary" href="/finance/bankaccounts">Cancelar</a>
            </div>
        </form>

    </div>


@endsection
