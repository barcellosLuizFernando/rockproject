@extends('layouts.main')

@section('content')

    <div class="container">

        <h1 class="display-6 mb-3"> Cadastro de Instituções Bancárias</h1>

        <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-3">
            <a href="/finance/banks/create" class="btn btn-primary me-md-2" role="button">Cadastrar Banco</a>
        </div>

        <table class="table table-hover">
            <thead>

                <tr>
                    <th colspan=1 scope="col">#</th>
                    <th scope="col">Razão Social</th>
                    <th scope="col">Nome Fantasia</th>
                    <th scope="col">Comp</th>
                    <th scope="col">Site</th>
                    <th scope="col">Ação</th>
                </tr>

            </thead>

            <tbody>
                @foreach ($banks as $bank)
                    <tr>
                        <th scope="row">{{ $bank->id }}</th>
                        <td>{{ $bank->name }}</td>
                        <td>{{ $bank->alias }}</td>
                        <td>{{ $bank->codcomp }}</td>
                        <td>{{ $bank->site }}</td>
                        <td><a href="/finance/banks/{{ $bank->id }}" class="btn btn-secondary btn-sm" role="button"><i class="far fa-edit"></i>
                            Editar</a>
                        <form action="/finance/banks/{{ $bank->id }}" class="d-inline" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" type="submit"><i class="far fa-trash-alt"></i>
                                Excluir</button>
                        </form></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection
