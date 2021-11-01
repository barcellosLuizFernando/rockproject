@extends('layouts.main')

@section('content')

    <div class="container">
        <h1 class="display-6 mb-5"> Extrato bancário - {{ $bank->name }}</h1>

        <form method="POST">
            @csrf
            @method('GET')
            <div class="row g-3 mb-4 border p-3 shadow-hover">
                <div class="row col-md-8">
                    <h5 class="card-title">Filtros para pesquisa</h5>


                    <div class="col-md-6">
                        <label for="startdate" class="form-label">Data Inicial</label>
                        <input type="date" class="form-control" name="startdate">
                    </div>
                    <div class="col-md-6">
                        <label for="enddate" class="form-label">Data Final</label>
                        <input type="date" class="form-control" name="enddate">
                    </div>
                </div>
                <div class="row col-md-4">
                    <button type="submit" class="btn btn-primary me-md-2 mb-2" role="button"><i class="fas fa-search"></i>
                        Buscar</button>
                    <a href="/finance/treasury" role="button" class="btn btn-secondary me-md-2"><i
                            class="far fa-arrow-alt-circle-left"></i> Voltar</a>

                </div>





            </div>
        </form>
        <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-3">
            <a href="/finance/treasury/create/{{ $moves['idBankAccount'] }}" class="btn btn-primary me-md-2"
                role="button"><i class="far fa-plus-square"></i>
                Novo movimento</a>
        </div>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">Data</th>
                    <th scope="col">Histórico</th>
                    <th scope="col">Crédito</th>
                    <th scope="col">Débito</th>
                    <th scope="col">Saldo</th>
                    <th scope="col">Ação</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Saldo inicial</td>
                    <td></td>
                    <td class="text-right">0,00</td>
                    <td class="text-right">0,00</td>
                    <td class="text-right">{{ number_format($moves['startvalue'], 2, ',', '.') }}</td>
                    <td></td>
                </tr>

                @php
                    $balance = $moves['startvalue'];
                @endphp

                @foreach ($moves['detail'] as $item)

                    @isset($item['moves']['credits'])


                        @foreach ($item['moves']['credits'] as $move)

                            @php
                                $balance += $move['value'];
                            @endphp

                            <tr>
                                <td>{{ date('d/m/Y', strtotime($item['date'])) }}</td>
                                <td>{{ $move['description'] }}</td>
                                <td class="text-right">{{ number_format($move['value'], 2, ',', '.') }}</td>
                                <td class="text-right">0,00</td>
                                <td class="text-right">{{ number_format($balance, 2, ',', '.') }}</td>
                                <td>
                                    @if ($move['idPaymentMove'] == null && $move['idReceivableMove'] == null)

                                        <form action="/finance/treasury/{{ $move['id'] }}" class="d-inline"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm" type="submit"><i class="far fa-trash-alt"></i>
                                                Excluir</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>



                        @endforeach

                    @endisset
                    @isset($item['moves']['debits'])


                        @foreach ($item['moves']['debits'] as $move)

                            @php
                                $balance -= $move['value'];
                            @endphp

                            <tr>
                                <td>{{ date('d/m/Y', strtotime($item['date'])) }}</td>
                                <td>{{ $move['description'] }}</td>
                                <td class="text-right">0,00</td>
                                <td class="text-right">{{ number_format($move['value'], 2, ',', '.') }}</td>
                                <td class="text-right">{{ number_format($balance, 2, ',', '.') }}</td>
                                <td></td>
                            </tr>



                        @endforeach

                    @endisset

                @endforeach
            </tbody>
        </table>

    </div>

@endsection
