@extends('layouts.main')

@section('content')

    <div class="container">

        <h1 class="display-6 mb-3"> Cadastro de pessoal</h1>

        <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-3">
            <a href="/employee/create" class="btn btn-primary me-md-2" role="button">Cadastrar pessoa</a>
        </div>



        <table class="table table-hover">
            <thead>

                <tr>
                    <th colspan=1 scope="col">#</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Função</th>
                    <th scope="col">Data admissão</th>
                    <th scope="col">Situação</th>
                    <th scope="col">Ação</th>
                </tr>

            </thead>

            <tbody>
                @foreach ($employee as $item)

                <tr>
                    <th scope="col">{{$item->id}}</th>
                    <td>{{$item->name}}</td>
                    <td>{{$item->role}}</td>
                    <td>{{$item->admissiondate}}</td>
                    <td>{{$item->active ? 'Ativo' : 'Inativo'}}</td>
                    <td><a href="/employee/{{ $item->id }}" class="btn btn-secondary btn-sm" role="button"><i class="far fa-edit"></i>
                        Editar</a>
                    <form action="/employee/{{ $item->id }}" class="d-inline" method="POST">
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
