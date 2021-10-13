@extends('layouts.main')

@section('content')

    <div class="container p-3">

        <h1 class="display-6 mb-3"> Cadastro de Locais</h1>

        <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-3">
            <a href="/registers" class="btn btn-secondary me-md-2" role="button"><i class="far fa-arrow-alt-circle-left"></i>
                Voltar</a>
            <a href="/registers/classlocals/create" class="btn btn-primary me-md-2" role="button"><i
                    class="far fa-plus-square"></i> Cadastrar Local</a>
        </div>

        <table class="table table-hover">
            <thead>

                <tr>
                    <th colspan=1 scope="col">#</th>
                    <th scope="col">Descrição</th>
                    <th scope="col">Endereço</th>
                    <th scope="col">Bairro</th>
                    <th scope="col">Cidade</th>
                    <th scope="col">Ação</th>
                </tr>

            </thead>
            <tbody>

                @foreach ($classlocals as $item)

                    <tr>
                        <th scope="row">{{ $item->id }}</th>
                        <td>{{ $item->description }}</td>
                        <td>{{ $item->address }}</td>
                        <td>{{ $item->district }}</td>
                        <td>{{ $item->city->name . ' / ' . $item->city->state->alias }}</td>
                        <td><a href="/registers/classlocals/{{ $item->id }}" class="btn btn-secondary btn-sm"
                                role="button"><i class="far fa-edit"></i>
                                Editar</a>
                            <form action="/registers/classlocals/{{ $item->id }}" class="d-inline" method="POST">
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
