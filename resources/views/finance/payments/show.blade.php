@extends('layouts.main')

@section('content')

    <div class="container">

        <h1 class="display-6 mb-5"> Cadastro de Contas a Pagar</h1>

        <form method="POST">
            @csrf
            @method('GET')
            <div class="row g-3 mb-4 border p-3 shadow-hover">
                <h5 class="card-title">Filtros para pesquisa</h5>
                <div class="col-md-2">
                    <label for="startdate" class="form-label">Data Inicial</label>
                    <input type="date" class="form-control" name="startdate">
                </div>
                <div class="col-md-2">
                    <label for="enddate" class="form-label">Data Final</label>
                    <input type="date" class="form-control" name="enddate">
                </div>
                <div class="col-md-4">
                    <label for="supplier" class="form-label">Fornecedor</label>
                    <select name="supplier" id="supplier" class="form-select" aria-label="Default select example">
                        <option></option>
                        @foreach ($suppliers as $supplier)
                            <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="startduedate" class="form-label">Vencimento Inicial</label>
                    <input type="date" class="form-control" name="startduedate">
                </div>
                <div class="col-md-2">
                    <label for="endduedate" class="form-label">Vencimento Final</label>
                    <input type="date" class="form-control" name="endduedate">
                </div>
                <div class="col-md-2">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-select" aria-label="Default select example">
                        <option></option>
                        <option value="AB">Aberto</option>
                        <option value="PG">Pago</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary me-md-2" role="button">Buscar</button>
            </div>
        </form>


        <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-3">
            <button type="button" data-bs-toggle="modal" data-bs-target="#paymentModal" class="btn btn-success me-md-2"
                onclick="getBills();">
                <i class="fas fa-money-check-alt"></i> Pagar
                Título</button>
            <a href="/finance/payments/create" class="btn btn-primary me-md-2" role="button"><i
                    class="far fa-plus-square"></i> Novo Título</a>
        </div>

        <table class="table table-hover" id="billstable">
            <thead>

                <tr>
                    <th colspan=1 scope="col">#</th>
                    <th scope="col">Check</th>
                    <th scope="col">Data</th>
                    <th scope="col">Fornecedor</th>
                    <th scope="col">Arquivo</th>
                    <th scope="col">Status</th>
                    <th scope="col">Valor</th>
                    <th scope="col">Saldo</th>
                    <th scope="col">Origem</th>
                    <th scope="col">Ação</th>
                </tr>

            </thead>

            <tbody>
                @foreach ($payments as $payment)
                    <tr>
                        <th scope="row">{{ $payment->id }}</th>
                        <td><input type="checkbox" class="form-check-input" value="{{ $payment->id }}" name="checkbills[]"
                                id="checkbills"></td>
                        <td>{{ date('d/m/Y', strtotime($payment->duedate)) }}</td>
                        <td>{{ $payment->supplier->name }}</td>
                        <td>
                            @if ($payment->filename <> '')
                                <a role="button" href=" {{ '/storage/payments/' . $payment->filename }}" class="btn btn-secondary btn-sm"><i
                                        class="fas fa-external-link-alt"></i> Documento</a>
                            @else
                                
                            @endif
                        </td>
                        <td>{{ $payment->status }}</td>
                        <td class="text-right">{{ number_format($payment->value, 2, ',', '.') }}</td>
                        <td class="text-right">{{ number_format($payment->balance, 2, ',', '.') }}</td>
                        <td>
                            @if (isset($payment->originurl))
                                <a role="button" href=" {{ $payment->originurl }}" class="btn btn-secondary btn-sm"><i
                                        class="fas fa-external-link-alt"></i> {{ $payment->origin }}</a>
                            @else
                                {{ $payment->origin }}
                            @endif
                        </td>
                        <td><a href="/finance/payments/{{ $payment->id }}" class="btn btn-secondary btn-sm"
                                role="button"><i class="far fa-edit"></i>
                                Editar</a>
                            @if (!isset($payment->originurl))
                                <form action="/finance/payments/{{ $payment->id }}" class="d-inline" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm" type="submit"><i class="far fa-trash-alt"></i>
                                        Excluir</button>
                                </form>
                            @endif
                        </td>

                    </tr>

                @endforeach
            </tbody>
        </table>

    </div>

    <!-- Modal -->
    <div class="modal fade" id="paymentModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="paymentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="paymentModalLabel">Baixa de títulos</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/finance/payments/paybills" method="POST">
                    @csrf
                    <div class="modal-body">
                        <table class="table table-hover" id="paymenttable">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Fornecedor</th>
                                    <th scope="col">Valor original</th>
                                    <th scope="col">Saldo</th>
                                    <th scope="col">Principal</th>
                                    <th scope="col">(+) Juros</th>
                                    <th scope="col">(+) Multa</th>
                                    <th scope="col">(-) Descontos</th>
                                    <th scope="col">(=) Valor a pagar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>...</td>
                                </tr>
                                <tr>
                                    <td>...</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label for="date" class="form-label">Data</label>
                                <input type="date" class="form-control" name="date"
                                    value="{{ date('Y-m-d', time()) }}">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="bankaccount" class="form-label">Conta</label>
                                <select name="bankaccount" id="bankaccount" class="form-select"
                                    aria-label="Default select example">
                                    @foreach ($bankaccounts as $bankaccount)
                                        <option value="{{ $bankaccount->id }}">{{ $bankaccount->description }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Baixar títulos</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('bodyscript')
    <script>
        /** return void */

        function getBills() {

            // Get a reference to the table
            let tableOrigin = document.getElementById("billstable");
            let tableDestiny = document.getElementById("paymenttable");

            // Cleans the destiny table
            var rowCount = tableDestiny.rows.length;
            for (var i = 1; i < rowCount; i++) {
                tableDestiny.deleteRow(1);
            };

            let originalAmount = 0.00;
            let balanceAmount = 0.00;

            rowCount = tableOrigin.rows.length;

            for (i = 1; i < rowCount; i++) {

                var check = tableOrigin.rows[i].cells[1].getElementsByTagName('input')[0].checked;

                if (check) {
                    // Insert a row at the end of the table
                    var newRow = tableDestiny.insertRow(-1);


                    // Insert a cell in the row at index 0
                    var newTh = document.createElement('th');
                    //var newCell = newRow.insertCell(0);

                    // Append a input node to the cell
                    var newNode = document.createElement('input');
                    newNode.setAttribute('name', 'idpayment[]');
                    newNode.setAttribute('class', 'form-control');
                    newNode.setAttribute('type', 'text');
                    newNode.setAttribute('value', tableOrigin.rows[i].cells[0].innerHTML);
                    newNode.readOnly = true;
                    newTh.appendChild(newNode);
                    newRow.appendChild(newTh);


                    // Insert a cell in the row at index 1
                    var newCell = newRow.insertCell(1);

                    // Append a input node to the cell
                    var newNode = document.createTextNode(tableOrigin.rows[i].cells[3].innerHTML);
                    newCell.appendChild(newNode);



                    // Insert a cell in the row at index 2
                    var newCell = newRow.insertCell(2);
                    newCell.setAttribute('class', 'text-right');

                    // Append a input node to the cell
                    var value = tableOrigin.rows[i].cells[6].innerHTML;
                    var newNode = document.createTextNode(value);
                    newCell.appendChild(newNode);

                    value = value.replaceAll('.', '');

                    value = value.replaceAll(',', '.');

                    originalAmount += parseFloat(value);



                    // Insert a cell in the row at index 3
                    var newCell = newRow.insertCell(3);
                    newCell.setAttribute('class', 'text-right');

                    // Append a input node to the cell
                    var value = tableOrigin.rows[i].cells[7].innerHTML;
                    var newNode = document.createTextNode(tableOrigin.rows[i].cells[7].innerHTML);
                    newCell.appendChild(newNode);


                    // Insert a cell in the row at index 4
                    var newCellValue = newRow.insertCell(4);

                    // Append a input node to the cell
                    var newNodeValue = document.createElement('input');
                    newNodeValue.setAttribute('value', value);
                    //newNode.setAttribute('id', '');
                    newNodeValue.setAttribute('type', 'text');
                    newNodeValue.setAttribute('data-inputmask',
                        " 'alias': 'decimal', 'numericInput': 'true', 'radixPoint': ',', 'groupSeparator': '.', 'removeMaskOnSubmit': 'true'"
                    );
                    Inputmask({
                        'alias': 'decimal',
                        'numericInput': 'true',
                        'radixPoint': ',',
                        'groupSeparator': '.',
                        'removeMaskOnSubmit': 'true'
                    }).mask(newNodeValue);
                    newNodeValue.setAttribute('class', 'form-control');
                    newNodeValue.setAttribute('inputmode', 'decimal');
                    newNodeValue.setAttribute('style', 'text-align: right;');
                    newNodeValue.setAttribute('onchange', 'billsAmmount();');
                    newNodeValue.required = true;
                    newNodeValue.setAttribute('name', 'originalvalue[]');
                    newCellValue.appendChild(newNodeValue);

                    value = value.replaceAll('.', '');

                    value = value.replaceAll(',', '.');

                    balanceAmount += parseFloat(value);

                    // Insert a cell in the row at index 5
                    var newCellValue = newRow.insertCell(5);

                    // Append a input node to the cell
                    var newNodeValue = document.createElement('input');
                    newNodeValue.setAttribute('data-inputmask',
                        " 'alias': 'decimal', 'numericInput': 'true', 'radixPoint': ',', 'groupSeparator': '.', 'removeMaskOnSubmit': 'true'"
                    );
                    //newNode.setAttribute('id', '');
                    newNodeValue.setAttribute('type', 'text');
                    Inputmask({
                        'alias': 'decimal',
                        'numericInput': 'true',
                        'radixPoint': ',',
                        'groupSeparator': '.',
                        'removeMaskOnSubmit': 'true'
                    }).mask(newNodeValue);
                    newNodeValue.setAttribute('class', 'form-control');
                    newNodeValue.setAttribute('inputmode', 'decimal');
                    newNodeValue.setAttribute('style', 'text-align: right;');
                    //newNodeValue.required = true;
                    newNodeValue.setAttribute('name', 'interestvalue[]');
                    newNodeValue.setAttribute('onchange', 'billsAmmount();');
                    newCellValue.appendChild(newNodeValue);


                    // Insert a cell in the row at index 6
                    var newCellValue = newRow.insertCell(6);

                    // Append a input node to the cell
                    var newNodeValue = document.createElement('input');
                    newNodeValue.setAttribute('data-inputmask',
                        " 'alias': 'decimal', 'numericInput': 'true', 'radixPoint': ',', 'groupSeparator': '.', 'removeMaskOnSubmit': 'true'"
                    );
                    //newNode.setAttribute('id', '');
                    newNodeValue.setAttribute('type', 'text');
                    Inputmask({
                        'alias': 'decimal',
                        'numericInput': 'true',
                        'radixPoint': ',',
                        'groupSeparator': '.',
                        'removeMaskOnSubmit': 'true'
                    }).mask(newNodeValue);
                    newNodeValue.setAttribute('class', 'form-control');
                    newNodeValue.setAttribute('inputmode', 'decimal');
                    newNodeValue.setAttribute('style', 'text-align: right;');
                    //newNodeValue.required = true;
                    newNodeValue.setAttribute('name', 'finevalue[]');
                    newNodeValue.setAttribute('onchange', 'billsAmmount();');
                    newCellValue.appendChild(newNodeValue);


                    // Insert a cell in the row at index 7
                    var newCellValue = newRow.insertCell(7);

                    // Append a input node to the cell
                    var newNodeValue = document.createElement('input');
                    newNodeValue.setAttribute('data-inputmask',
                        " 'alias': 'decimal', 'numericInput': 'true', 'radixPoint': ',', 'groupSeparator': '.', 'removeMaskOnSubmit': 'true'"
                    );
                    //newNode.setAttribute('id', '');
                    newNodeValue.setAttribute('type', 'text');
                    Inputmask({
                        'alias': 'decimal',
                        'numericInput': 'true',
                        'radixPoint': ',',
                        'groupSeparator': '.',
                        'removeMaskOnSubmit': 'true'
                    }).mask(newNodeValue);
                    newNodeValue.setAttribute('class', 'form-control');
                    newNodeValue.setAttribute('inputmode', 'decimal');
                    newNodeValue.setAttribute('style', 'text-align: right;');
                    //newNodeValue.required = true;
                    newNodeValue.setAttribute('name', 'discountvalue[]');
                    newNodeValue.setAttribute('onchange', 'billsAmmount();');
                    newCellValue.appendChild(newNodeValue);


                    // Insert a cell in the row at index 8
                    var newCellValue = newRow.insertCell(8);

                    // Append a input node to the cell
                    var newNodeValue = document.createElement('input');
                    newNodeValue.setAttribute('data-inputmask',
                        " 'alias': 'decimal', 'numericInput': 'true', 'radixPoint': ',', 'groupSeparator': '.', 'removeMaskOnSubmit': 'true'"
                    );
                    //newNode.setAttribute('id', '');
                    newNodeValue.setAttribute('type', 'text');
                    Inputmask({
                        'alias': 'decimal',
                        'numericInput': 'true',
                        'radixPoint': ',',
                        'groupSeparator': '.',
                        'removeMaskOnSubmit': 'true'
                    }).mask(newNodeValue);
                    newNodeValue.setAttribute('class', 'form-control');
                    newNodeValue.setAttribute('inputmode', 'decimal');
                    newNodeValue.setAttribute('style', 'text-align: right;');
                    //newNodeValue.required = true;
                    newNodeValue.disabled = true;
                    newNodeValue.setAttribute('value', '0,00');
                    newNodeValue.setAttribute('name', 'totalvalue[]');
                    newCellValue.appendChild(newNodeValue);



                }




            };

            var footer = tableDestiny.createTFoot();
            var row = footer.insertRow(0);
            var cell = row.insertCell(0);
            cell.innerHTML = "<b>TOTAL</b>";

            row.insertCell(1);

            // Append a input node to the cell
            cell = row.insertCell(2);
            var newNodeValue = document.createElement('input');
            newNodeValue.setAttribute('value', (originalAmount + '').replaceAll('.', ','));
            newNodeValue.setAttribute('data-inputmask',
                " 'alias': 'decimal', 'numericInput': 'true', 'radixPoint': ',', 'groupSeparator': '.', 'removeMaskOnSubmit': 'true'"
            );
            //newNode.setAttribute('id', '');
            newNodeValue.setAttribute('type', 'text');
            Inputmask({
                'alias': 'decimal',
                'numericInput': 'true',
                'radixPoint': ',',
                'groupSeparator': '.',
                'removeMaskOnSubmit': 'true'
            }).mask(newNodeValue);
            newNodeValue.setAttribute('class', 'form-control');
            newNodeValue.setAttribute('inputmode', 'decimal');
            newNodeValue.setAttribute('style', 'text-align: right;');
            newNodeValue.required = true;
            newNodeValue.disabled = true;
            newNodeValue.setAttribute('id', 'originalAmount');
            cell.appendChild(newNodeValue);

            // Append a input node to the cell
            cell = row.insertCell(3);
            var newNodeValue = document.createElement('input');
            newNodeValue.setAttribute('value', (balanceAmount + '').replaceAll('.', ','));
            newNodeValue.setAttribute('data-inputmask',
                " 'alias': 'decimal', 'numericInput': 'true', 'radixPoint': ',', 'groupSeparator': '.', 'removeMaskOnSubmit': 'true'"
            );
            //newNode.setAttribute('id', '');
            newNodeValue.setAttribute('type', 'text');
            Inputmask({
                'alias': 'decimal',
                'numericInput': 'true',
                'radixPoint': ',',
                'groupSeparator': '.',
                'removeMaskOnSubmit': 'true'
            }).mask(newNodeValue);
            newNodeValue.setAttribute('class', 'form-control');
            newNodeValue.setAttribute('inputmode', 'decimal');
            newNodeValue.setAttribute('style', 'text-align: right;');
            newNodeValue.required = true;
            newNodeValue.disabled = true;
            newNodeValue.setAttribute('id', 'balanceAmount');
            cell.appendChild(newNodeValue);


            // Append a input node to the cell
            cell = row.insertCell(4);
            var newNodeValue = document.createElement('input');
            newNodeValue.setAttribute('value', '0,00');
            newNodeValue.setAttribute('data-inputmask',
                " 'alias': 'decimal', 'numericInput': 'true', 'radixPoint': ',', 'groupSeparator': '.', 'removeMaskOnSubmit': 'true'"
            );
            //newNode.setAttribute('id', '');
            newNodeValue.setAttribute('type', 'text');
            Inputmask({
                'alias': 'decimal',
                'numericInput': 'true',
                'radixPoint': ',',
                'groupSeparator': '.',
                'removeMaskOnSubmit': 'true'
            }).mask(newNodeValue);
            newNodeValue.setAttribute('class', 'form-control');
            newNodeValue.setAttribute('inputmode', 'decimal');
            newNodeValue.setAttribute('style', 'text-align: right;');
            newNodeValue.required = true;
            newNodeValue.disabled = true;
            newNodeValue.setAttribute('id', 'amortisationAmount');
            cell.appendChild(newNodeValue);

            // Append a input node to the cell
            cell = row.insertCell(5);
            var newNodeValue = document.createElement('input');
            newNodeValue.setAttribute('value', '0,00');
            newNodeValue.setAttribute('data-inputmask',
                " 'alias': 'decimal', 'numericInput': 'true', 'radixPoint': ',', 'groupSeparator': '.', 'removeMaskOnSubmit': 'true'"
            );
            //newNode.setAttribute('id', '');
            newNodeValue.setAttribute('type', 'text');
            Inputmask({
                'alias': 'decimal',
                'numericInput': 'true',
                'radixPoint': ',',
                'groupSeparator': '.',
                'removeMaskOnSubmit': 'true'
            }).mask(newNodeValue);
            newNodeValue.setAttribute('class', 'form-control');
            newNodeValue.setAttribute('inputmode', 'decimal');
            newNodeValue.setAttribute('style', 'text-align: right;');
            newNodeValue.required = true;
            newNodeValue.disabled = true;
            newNodeValue.setAttribute('id', 'interestAmount');
            cell.appendChild(newNodeValue);

            // Append a input node to the cell
            cell = row.insertCell(6);
            var newNodeValue = document.createElement('input');
            newNodeValue.setAttribute('value', '0,00');
            newNodeValue.setAttribute('data-inputmask',
                " 'alias': 'decimal', 'numericInput': 'true', 'radixPoint': ',', 'groupSeparator': '.', 'removeMaskOnSubmit': 'true'"
            );
            //newNode.setAttribute('id', '');
            newNodeValue.setAttribute('type', 'text');
            Inputmask({
                'alias': 'decimal',
                'numericInput': 'true',
                'radixPoint': ',',
                'groupSeparator': '.',
                'removeMaskOnSubmit': 'true'
            }).mask(newNodeValue);
            newNodeValue.setAttribute('class', 'form-control');
            newNodeValue.setAttribute('inputmode', 'decimal');
            newNodeValue.setAttribute('style', 'text-align: right;');
            newNodeValue.required = true;
            newNodeValue.disabled = true;
            newNodeValue.setAttribute('id', 'fineAmount');
            cell.appendChild(newNodeValue);


            // Append a input node to the cell
            cell = row.insertCell(7);
            var newNodeValue = document.createElement('input');
            newNodeValue.setAttribute('value', '0,00');
            newNodeValue.setAttribute('data-inputmask',
                " 'alias': 'decimal', 'numericInput': 'true', 'radixPoint': ',', 'groupSeparator': '.', 'removeMaskOnSubmit': 'true'"
            );
            //newNode.setAttribute('id', '');
            newNodeValue.setAttribute('type', 'text');
            Inputmask({
                'alias': 'decimal',
                'numericInput': 'true',
                'radixPoint': ',',
                'groupSeparator': '.',
                'removeMaskOnSubmit': 'true'
            }).mask(newNodeValue);
            newNodeValue.setAttribute('class', 'form-control');
            newNodeValue.setAttribute('inputmode', 'decimal');
            newNodeValue.setAttribute('style', 'text-align: right;');
            newNodeValue.required = true;
            newNodeValue.disabled = true;
            newNodeValue.setAttribute('id', 'discountAmount');
            cell.appendChild(newNodeValue);



            // Append a input node to the cell
            cell = row.insertCell(8);
            var newNodeValue = document.createElement('input');
            newNodeValue.setAttribute('value', '0');
            newNodeValue.setAttribute('data-inputmask',
                " 'alias': 'decimal', 'numericInput': 'true', 'radixPoint': ',', 'groupSeparator': '.', 'removeMaskOnSubmit': 'true'"
            );
            //newNode.setAttribute('id', '');
            newNodeValue.setAttribute('type', 'text');
            Inputmask({
                'alias': 'decimal',
                'numericInput': 'true',
                'radixPoint': ',',
                'groupSeparator': '.',
                'removeMaskOnSubmit': 'true'
            }).mask(newNodeValue);
            newNodeValue.setAttribute('class', 'form-control');
            newNodeValue.setAttribute('inputmode', 'decimal');
            newNodeValue.setAttribute('style', 'text-align: right;');
            newNodeValue.required = true;
            newNodeValue.disabled = true;
            newNodeValue.setAttribute('id', 'totalAmount');
            cell.appendChild(newNodeValue);
            // Insert a row at the end of the table
            //let newRow = tableDestiny.insertRow(-1);
            //console.log(originalAmount);

            /** Soma toda a tabela depois de montar*/
            billsAmmount();
        }

        /** return void */
        function billsAmmount() {

            let tableDestiny = document.getElementById("paymenttable");
            let rowCount = (tableDestiny.rows.length) - 1;

            let amortisationAmount = 0.00;
            let interestsAmount = 0.00;
            let fineAmount = 0.00;
            let discountsAmount = 0.00;

            for (let i = 1; i < rowCount; i++) {

                var lineTotal = 0.00;

                //Amortisation
                var value = tableDestiny.rows[i].cells[4].getElementsByTagName('input')[0].value;
                value = value.replaceAll('.', '').replaceAll(',', '.');
                isNaN(parseFloat(value)) ? value = 0.00 : value = parseFloat(value);
                amortisationAmount += value;
                lineTotal += value;

                //Interests
                value = tableDestiny.rows[i].cells[5].getElementsByTagName('input')[0].value;
                value = value.replaceAll('.', '').replaceAll(',', '.');
                isNaN(parseFloat(value)) ? value = 0.00 : value = parseFloat(value);
                interestsAmount += value;
                lineTotal += value;

                //Fine
                value = tableDestiny.rows[i].cells[6].getElementsByTagName('input')[0].value;
                value = value.replaceAll('.', '').replaceAll(',', '.');
                isNaN(parseFloat(value)) ? value = 0.00 : value = parseFloat(value);
                fineAmount += value;
                lineTotal += value;

                //Discount
                value = tableDestiny.rows[i].cells[7].getElementsByTagName('input')[0].value;
                //console.log(value);
                value = value.replaceAll('.', '').replaceAll(',', '.');
                isNaN(parseFloat(value)) ? value = 0.00 : value = parseFloat(value);
                discountsAmount += value;
                lineTotal += value;


                tableDestiny.rows[i].cells[8].getElementsByTagName('input')[0].value = (lineTotal + '').replaceAll('.',
                    ',');

            }



            let inputAmortizationAmount = document.getElementById('amortisationAmount');
            inputAmortizationAmount.value = (amortisationAmount + '').replaceAll('.', ',');

            let inputInterestAmount = document.getElementById('interestAmount');
            inputInterestAmount.value = (interestsAmount + '').replaceAll('.', ',');

            let inputFineAmount = document.getElementById('fineAmount');
            inputFineAmount.value = (fineAmount + '').replaceAll('.', ',');

            let inputDisctounAmount = document.getElementById('discountAmount');
            inputDisctounAmount.value = (discountsAmount + '').replaceAll('.', ',');

            let inputTotalAmount = document.getElementById('totalAmount');
            inputTotalAmount.value = ((discountsAmount + amortisationAmount + interestsAmount + fineAmount) + '')
                .replaceAll('.', ',');



        }
    </script>

@endsection
