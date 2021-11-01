@extends('layouts.main')


@section('content')

    <div class="container">

        <h1 class="display-6 mb-5"> Tesouraria</h1>

        <div class="card-group">

            <div class="row row-cols-1 row-cols-md-2 g-4">

                @foreach ($bankaccounts as $item)

                    <div class="col">
                        <div class="card mb-3 mr-3">

                            <div class="card-header">
                                <div class="d-flex justify-content-between">
                                    <h5>{{ $item->bankname }}</h5>
                                    <div class="">
                                        <a href="/finance/treasury/{{$item->id}}" class="btn btn-primary"><i class="fas fa-external-link-alt"></i> Acessar</a>
                                        <a href="/finance/treasury/bankstatement" class="btn btn-secondary"><i class="fas fa-external-link-alt"></i> OFX</a>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-0">
                                <div class="col-md-4 my-auto p-3">
                                    <img src="{{ $item->filelogo }}" class="img-fluid rounded mx-auto d-block" alt="...">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title"></h5>
                                        <p class="card-text"><b>Data de abertura: </b> {{ date('d/m/Y', strtotime($item->startdate)) }}</p>
                                        <p class="card-text"><b>Agência: </b> {{ $item->agencynumber }}</p>
                                        <p class="card-text"><b>Conta: </b>{{ $item->accountnumber }}</p>
                                        <p class="card-text"><b>Saldo: </b>{{ number_format($item->data['balance'], 2, ',', '.') }}</p>
                                        <p class="card-text"><small class="text-muted">Última movimentação:
                                                {{ date('d/m/Y', strtotime($item->data['lastmove'])) }}</small></p>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>

                @endforeach
            </div>

        </div>



    </div>

@endsection
