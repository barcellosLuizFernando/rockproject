@extends('layouts.main')

@section('content')

<div class="container p-3">

    <h1 class="display-6 mb-3"> Cadastro de Cursos</h1>

    <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-3">
        <a href="/registers" class="btn btn-secondary me-md-2" role="button"><i class="far fa-arrow-alt-circle-left"></i> Voltar</a>
        <a href="/registers/courses/create" class="btn btn-primary me-md-2" role="button"><i class="far fa-plus-square"></i> Cadastrar Curso</a>
    </div>

    <table class="table table-hover">
        <thead>

            <tr>
                <th colspan=1 scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">Data criação</th>
                <th scope="col">Data alteração</th>
                <th scope="col">Ação</th>
            </tr>

        </thead>
        <tbody>
            @foreach ($courses as $item)

                <tr>
                    <th scope="row">{{ $item->id }}</th>
                    <td>{{$item->name}}</td>
                    <td>{{ date('d/m/Y H:i', strtotime($item->created_at)) }}</td>
                    <td>{{ date('d/m/Y H:i', strtotime($item->updated_at)) }}</td>
                    <td><a href="/registers/courses/{{ $item->id }}" class="btn btn-secondary btn-sm" role="button"><i class="far fa-edit"></i>
                        Editar</a>
                    <form action="/registers/courses/{{ $item->id }}" class="d-inline" method="POST">
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