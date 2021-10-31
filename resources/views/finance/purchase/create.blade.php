@extends('layouts.main')

@section('content')

    <div class="container">

        <h1 class="display-6 mb-5"> Cadastro de Compras</h1>

        <form class="___class_+?2___" method="POST" autocomplete="off" enctype="multipart/form-data">
            @csrf
            @if (isset($purchase->id))
                @method('PUT')
            @endif

            <div class="row g-3 mb-4 border p-3 shadow-hover">
                <h5 class="card-title">Dados gerais</h5>
                <div class="col-md-2">
                    <label for="date" class="form-label">Data da compra</label>
                    <input type="date" class="form-control" name="date" value="{{ $purchase->date }}" required>
                </div>
                <div class="col-md-6">
                    <label for="supplier" class="form-label">Fornecedor</label>
                    <select name="supplier" id="supplier" class="form-select" aria-label="Default select example"
                        required>
                        @foreach ($suppliers as $supplier)
                            <option value="{{ $supplier->id }}" @if ($supplier->id == $purchase->idSupplier) selected @endif>{{ $supplier->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="invoicenumber" class="form-label">Documento</label>
                    <input type="text" class="form-control" name="invoicenumber" id="invoicenumber"
                        value="{{ $purchase->invoicenumber }}">
                </div>
                <div class="col-md-2">
                    <label for="value" class="form-label">Valor</label>
                    <input type="text"
                        data-inputmask="'alias': 'decimal', 'numericInput': 'true', 'radixPoint': ',', 'groupSeparator': '.', 'removeMaskOnSubmit': 'true' "
                        class="form-control" name="value" id="value" value="{{ $purchase->value }}" required>
                </div>
                <div class="col-md-4">
                    <label for="financeplan" class="form-label">Plano financeiro</label>
                    <select name="financeplan" id="financeplan" class="form-select" aria-label="Default select example"
                        required>
                        @foreach ($financeplans as $financeplan)
                            <option value="{{ $financeplan->id }}" @if ($financeplan->id == $purchase->idFinancePlan) selected @endif>
                                {{ $financeplan->classification . ' - ' . $financeplan->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="transaction" class="form-label">Transação</label>
                    <select name="transaction" id="transaction" class="form-select" aria-label="Default select example"
                        required>
                        @foreach ($transactions as $transaction)
                            <option value="{{ $transaction->id }}" @if ($transaction->id == $purchase->idTransaction) selected @endif>
                                {{ $transaction->description }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="order" class="form-label">Pedido</label>
                    <input type="string" class="form-control" name="order" value="{{ $purchase->order }}">
                </div>
                <div class="col-md-8">
                    <label for="description" class="form-label">Descrição</label>
                    <input type="string" class="form-control" name="description" value="{{ $purchase->description }}"
                        required>
                </div>
                <div class="col-md-4">
                    <label for="formFile" class="form-label">Arquivo</label>
                    <input class="form-control" type="file" id="formFile" name="formFile">
                </div>

            </div>
            <div class="row g-3 mb-4 border p-3 shadow-hover">
                <div class="row justify-content-between">
                    <div class="col">

                        <h5 class="card-title">Financeiro</h5>
                    </div>
                    <div class="col-md-4 offset-md-4">

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="button" onclick="addPayment()" class="btn btn-secondary btn-sm"><i
                                    class="far fa-calendar-plus"></i> Adicionar parcela</button>

                        </div>
                    </div>

                </div>

                <table class="table table-hover" id="paymentsTable">
                    <thead>

                        <tr>
                            <th colspan=1 scope="col">#</th>
                            <th scope="col">Vencimento</th>
                            <th scope="col">Valor</th>
                            <th scope="col">Pagador</th>
                            <th scope="col">Ação</th>
                        </tr>

                    </thead>

                    <tbody>
                        @foreach ($purchase->payments as $payment)
                            <tr>
                                <th scope="row">{{ $payment->id }}</th>
                                <td>{{ date('d/m/Y', strtotime($payment->duedate)) }}</td>
                                <td>{{ number_format($payment->value, 2, ',', '.') }}</td>
                                <td>{{ $payment->supplier->name }}</td>
                                <td></td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>


                <div class="row g-3">
                    <div class="col">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Quantidade parcelas</span>
                            <input type="text" class="form-control" placeholder="0" aria-label="qtd"
                                aria-describedby="basic-addon1" disabled>
                        </div>
                    </div>
                    <div class="col">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Soma parcelas</span>
                            <input type="text" class="form-control text-right" placeholder="0,00" aria-label="sum"
                                aria-describedby="basic-addon1" disabled>
                        </div>
                    </div>
                    <div class="col">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Valor da compra</span>
                            <input type="text" class="form-control text-right" placeholder="0,00" aria-label="value"
                                aria-describedby="basic-addon1" disabled>
                        </div>
                    </div>
                    <div class="col">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Diferença</span>
                            <input type="text" class="form-control text-right" placeholder="0,00" aria-label="diff"
                                aria-describedby="basic-addon1" disabled>
                        </div>
                    </div>
                </div>


            </div>
            <div class="col-12 mb-5">
                <button class="btn btn-primary" type="submit">Gravar compra</button>
                <a class="btn btn-secondary" href="/finance/purchases">Cancelar</a>
            </div>
        </form>
    </div>

@endsection

@section('bodyscript')
    <script>
        function addPayment() {
            // Get a reference to the table
            let tableRef = document.getElementById('paymentsTable');

            // Insert a row at the end of the table
            let newRow = tableRef.insertRow(-1);

            // Insert a cell in the row at index 0
            let newCell = newRow.insertCell(0);
            // Append a input node to the cell
            let newText = document.createTextNode('Novo');
            newCell.appendChild(newText);

            // Insert a cell in the row at index 1
            let duedate = newRow.insertCell(1);
            // Append a input node to the cell
            let inputduedate = document.createElement('input');
            inputduedate.setAttribute('type', 'date');
            inputduedate.setAttribute('class', 'form-control');
            inputduedate.setAttribute('name', 'duedate[]');
            inputduedate.required = true;
            duedate.appendChild(inputduedate);

            // Insert a cell in the row at index 2
            let duevalue = newRow.insertCell(2);
            // Append a input node to the cell
            //let inputduevalue = document.createElement('input');
            let inputduevalue = document.getElementById('value').cloneNode(true);
            inputduevalue.setAttribute('type', 'text');
            
            inputduevalue.setAttribute('class', 'form-control');
            inputduevalue.setAttribute('inputmode', 'decimal');
            inputduevalue.setAttribute('style', 'text-align: right;');
            inputduevalue.required = true;
            inputduevalue.setAttribute('name', 'duevalue[]');
            inputduevalue.setAttribute('id', '');
            Inputmask({
                'alias': 'decimal',
                'numericInput': 'true',
                'radixPoint': ',',
                'groupSeparator': '.',
                'removeMaskOnSubmit': 'true'
            }).mask(inputduevalue);
            duevalue.appendChild(inputduevalue);


            // Insert a cell in the row at index 3
            let cellliableperson = newRow.insertCell(3);
            // Append a input node to the cell
            let inputliableperson = document.getElementById('supplier').cloneNode(true);
            inputliableperson.setAttribute('name', 'liableperson[]');
            inputliableperson.setAttribute('id', '');
            cellliableperson.appendChild(inputliableperson);




            // Insert a cell in the row at index 4
            let celldelete = newRow.insertCell(4);
            // Append a input node to the cell
            let buttondelete = document.createElement('i');
            buttondelete.setAttribute('class', 'far fa-minus-square');
            buttondelete.setAttribute('onclick', 'deleteRow(this)');
            buttondelete.setAttribute('style', 'cursor: pointer');

            celldelete.appendChild(buttondelete);

        };


        function deleteRow(r) {
            var i = r.parentNode.parentNode.rowIndex;
            document.getElementById("paymentsTable").deleteRow(i);
        }
    </script>
@endsection
