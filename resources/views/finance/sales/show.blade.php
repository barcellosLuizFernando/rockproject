@extends('layouts.main')

@section('content')

    <div class="container">

        <h1 class="display-6 mb-5"> Cadastro de Vendas</h1>

        <form action="/finance/sales/importxml" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row g-3 mb-4 border p-3 shadow-hover">
                <h5 class="card-title">Importar XML</h5>

                <div class="input-group">
                    <input type="file" class="form-control" id="inputGroupFile04" name="file[]"
                        aria-describedby="inputGroupFileAddon04" aria-label="Upload" accept="text/xml" multiple>
                    <button class="btn btn-outline-secondary" type="submit" id="inputGroupFileAddon04">Enviar</button>
                </div>
            </div>

            <table class="table table-hover">
                <thead>

                    <tr>
                        <th colspan=1 scope="col">#</th>
                        <th scope="col">Data</th>
                        <th scope="col">Documento</th>
                        <th scope="col">Cliente</th>
                        <th scope="col">Valor</th>
                        <th scope="col">XML</th>
                    </tr>

                </thead>

                <tbody>
                    @foreach ($sales as $item)

                        <tr>
                            <th scope="row">{{ $item->id }}</th>
                            <td>{{ date('d/m/Y', strtotime($item->date)) }}</td>
                            <td>{{ $item->docnumber }}</td>
                            <td>{{ $item->client->name }}</td>
                            <td>{{ number_format($item->value, 2, ',', '.') }}</td>
                            <td>
                                @if ($item->file != null)
                                    <a role="button" href=" {{ $item->file }}" class="btn btn-secondary btn-sm"
                                        target="_blank"><i class="fas fa-cloud-download-alt"></i> Download</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach


        </form>


    </div>

@endsection
