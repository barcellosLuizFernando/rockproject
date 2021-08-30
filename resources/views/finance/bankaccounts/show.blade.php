@extends('layouts.main')

@section('content')

    <div class="container">

        <h1 class="display-6 mb-3"> Cadastro de Contas Bancárias</h1>

        <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-3">
            <a href="/finance/bankaccounts/create" class="btn btn-primary me-md-2" role="button">Cadastrar Conta</a>
        </div>

        <table class="table table-hover">
            <thead>

                <tr>
                    <th colspan=1 scope="col">#</th>
                    <th scope="col">Descrição</th>
                    <th scope="col">Banco</th>
                    <th scope="col">Agência</th>
                    <th scope="col">Conta</th>
                    <th scope="col">Saldo atual</th>
                    <th scope="col">Chave PIX</th>
                    <th scope="col">Ação</th>
                </tr>

            </thead>

            <tbody>
                @foreach ($bankaccounts as $bankaccount)
                    <tr>
                        <th scope="row">{{ $bankaccount->id }}</th>
                        <td>{{ $bankaccount->description }}</td>
                        <td> @if (isset($bankaccount->bank->name)) {{$bankaccount->bank->name }} @endif </td>
                        <td>{{ $bankaccount->agencynumber }}</td>
                        <td>{{ $bankaccount->accountnumber }}</td>
                        <td>{{ $bankaccount->balance }}</td>
                        <td>{{ $bankaccount->pixkey }}</td>
                        <td><a href="/finance/bankaccounts/{{ $bankaccount->id }}" class="btn btn-secondary btn-sm" role="button"><i class="far fa-edit"></i>
                            Editar</a>
                        <form action="/finance/bankaccounts/{{ $bankaccount->id }}" class="d-inline" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" type="submit"><i class="far fa-trash-alt"></i>
                                Excluir</button>
                        </form></td>
                    </tr>
                @endforeach
            </tbody>


    </div>

@endsection
