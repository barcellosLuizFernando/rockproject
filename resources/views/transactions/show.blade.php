@extends('layouts.main')

@section('content')
    <div class="container">

        <h1 class="display-6 mb-3"> Cadastro de transações</h1>

        <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-3">
            <a href="/registers/transactions/create" class="btn btn-primary me-md-2" role="button"><i class="far fa-plus-square"></i> Cadastrar transação</a>
        </div>

        <table class="table table-hover">
            <thead>

                <tr>
                    <th colspan=1 scope="col">#</th>
                    <th scope="col">Descrição</th>
                    <th scope="col">Módulo</th>
                    <th scope="col">Tipo</th>
                    <th scope="col">Ação</th>
                </tr>

            </thead>

            <tbody>
                @foreach ($transactions as $item)
                    <tr>
                        <th scope="row">{{$item->id}}</th>
                        <td>{{ $item->description }}</td>
                        <td>{{ $item->module }}</td>
                        <td>{{ $item->type }}</td>
                        <td><a href="/registers/transactions/{{ $item->id }}" class="btn btn-secondary btn-sm" role="button"><i class="far fa-edit"></i>
                            Editar</a>
                        <form action="/registers/transactions/{{ $item->id }}" class="d-inline" method="POST">
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
