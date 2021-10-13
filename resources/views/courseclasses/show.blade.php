@extends('layouts.main')

@section('content')


    <div class="container p-3">

        <h1 class="display-6 mb-3"> Cadastro de Turmas</h1>

        <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-3">
            <a href="/registers" class="btn btn-secondary me-md-2" role="button"><i class="far fa-arrow-alt-circle-left"></i>
                Voltar</a>
            <a href="/registers/classcourses/create" class="btn btn-primary me-md-2" role="button"><i
                    class="far fa-plus-square"></i> Cadastrar Turma</a>
        </div>

        <table class="table table-hover">
            <thead>

                <tr>
                    <th colspan=1 scope="col">#</th>
                    <th scope="col">Empresa</th>
                    <th scope="col">Local</th>
                    <th scope="col">Curso</th>
                    <th scope="col">Turma</th>
                    <th scope="col">Id Rock</th>
                    <th scope="col">Ação</th>
                </tr>

            </thead>
            <tbody>
                @foreach ($courseclasses as $item)
                    <tr>
                        <th scope="row">{{$item->id}}</th>
                        <td>{{$item->company->name}}</td>
                        <td>{{$item->classlocal->description}}</td>
                        <td>{{$item->course->name}}</td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->rock_id}}</td>
                        <td><a href="/registers/classcourses/{{ $item->id }}" class="btn btn-secondary btn-sm" role="button"><i class="far fa-edit"></i>
                            Editar</a>
                        <form action="/registers/classcourses/{{ $item->id }}" class="d-inline" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" type="submit"><i class="far fa-trash-alt"></i>
                                Excluir</button>
                        </form></td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    @endsection
