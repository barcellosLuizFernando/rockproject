@extends('layouts.main')

@section('content')

    <div class="container">

        <h1 class="display-6 mb-3"> Cadastro de Plano Financeiro</h1>

        <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-3">
            <a href="/finance/financeplan/create" class="btn btn-primary me-md-2" role="button">Cadastrar Plano
                Financeiro</a>
        </div>

        <table class="table table-hover">
            <thead>

                <tr>
                    <th colspan=1 scope="col">#</th>
                    <th scope="col">Classificação</th>
                    <th scope="col">Ana/Sin</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Tipo</th>
                    <th scope="col">Ação</th>
                </tr>

            </thead>

            <tbody>
                @foreach ($financeplans as $financeplan)
                    <tr>
                        <th scope="row">{{ $financeplan->id }}</th>
                        <td>{{$financeplan->classification}}</td>
                        <td>{{$financeplan->anasin}}</td>
                        <td>{{$financeplan->name}}</td>
                        <td>{{$financeplan->type}}</td>
                        <td><a href="/finance/financeplan/{{ $financeplan->id }}" class="btn btn-secondary btn-sm" role="button"><i class="far fa-edit"></i>
                            Editar</a>
                        <form action="/finance/financeplan/{{ $financeplan->id }}" class="d-inline" method="POST">
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
