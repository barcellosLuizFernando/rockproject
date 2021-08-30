@extends('layouts.main')

@section('content')

    <div class="container">

        <h1 class="display-6 mb-3"> Cadastro de Pessoas</h1>

        <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-3">
            <a href="/finance/people/create" class="btn btn-primary me-md-2" role="button">Cadastrar Pessoa</a>
        </div>

        <table class="table table-hover">
            <thead>

                <tr>
                    <th colspan=1 scope="col">#</th>
                    <th scope="col">Nome</th>
                    <th scope="col">CPF/CNPJ</th>
                    <th scope="col">Cidade</th>
                    <th scope="col">UF</th>
                    <th scope="col">Cli</th>
                    <th scope="col">For</th>
                    <th scope="col">Col</th>
                    <th scope="col">Ação</th>
                </tr>

            </thead>

            <tbody>
                @foreach ($people as $item)

                <tr>
                    <th scope="row">{{$item->id}}</th>
                    <td>{{$item->name}}</td>
                    <td>{{$item->taxnumber}}</td>
                    <td>{{$item->city->name}}</td>
                    <td>{{$item->city->state->alias}}</td>
                    <td>@if($item->client) <i class="far fa-check-square text-success"></i> @else <i class="far fa-window-close text-secondary"></i> @endif</td>
                    <td>@if($item->supplier) <i class="far fa-check-square text-success"></i> @else <i class="far fa-window-close text-secondary"></i> @endif</td>
                    <td>@if($item->employee) <i class="far fa-check-square text-success"></i> @else <i class="far fa-window-close text-secondary"></i> @endif</td>
                    <td><a href="/finance/people/{{ $item->id }}" class="btn btn-secondary btn-sm" role="button"><i class="far fa-edit"></i>
                        Editar</a>
                    <form action="/finance/people/{{ $item->id }}" class="d-inline" method="POST">
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
