@extends('layouts.main')

@section('content')

    <div class="container">

        <h1 class="display-6 mb-5"> Cadastro de Compras</h1>

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
            <a href="/finance/purchases/create" class="btn btn-primary me-md-2" role="button">Nova Compra</a>
        </div>

        <table class="table table-hover">
            <thead>

                <tr>
                    <th colspan=1 scope="col">#</th>
                    <th scope="col">Data</th>
                    <th scope="col">Fornecedor</th>
                    <th scope="col">Descrição</th>
                    <th scope="col">Arquivo</th>
                    <th scope="col">Status</th>
                    <th scope="col">Valor</th>
                    <th scope="col">Saldo</th>
                    <th scope="col">Ação</th>
                </tr>

            </thead>

            <tbody>
                @foreach ($purchases as $purchase)
                    <tr>
                        <th scope="row">{{ $purchase->id }}</th>
                        <td>{{ date('d/m/Y', strtotime($purchase->date)) }}</td>
                        <td>{{ $purchase->supplier->name }}</td>
                        <td>{{ $purchase->description }}</td>
                        <td>
                            @if ($purchase->filename != null)
                                <a role="button" href=" {{ $purchase->filename }}" class="btn btn-secondary btn-sm" target="_blank"><i
                                        class="fas fa-cloud-download-alt"></i> Download</a>
                            @endif
                        </td>
                        <td>{{ $purchase->status }}</td>
                        <td class="text-right">{{ number_format($purchase->value, 2, ',', '.') }}</td>
                        <td class="text-right">{{ number_format($purchase->balance, 2, ',', '.') }}</td>
                        <td><a href="/finance/purchases/{{ $purchase->id }}" class="btn btn-secondary btn-sm"
                                role="button"><i class="far fa-edit"></i>
                                Editar</a>
                            <form action="/finance/purchases/{{ $purchase->id }}" class="d-inline" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" type="submit"><i class="far fa-trash-alt"></i>
                                    Excluir</button>
                            </form>
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection
