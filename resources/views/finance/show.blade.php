@extends('layouts.main')

@section('content')

<div class="container">
    <h1 class="display-6 mb-3"> Financeiro</h1>

    <div class="row">

        <div class="col-sm-3 mb-3">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Contas bancárias</h5>
              <p class="card-text"></p>
              <a href="/finance/banks" class="btn btn-primary">Banco</a>
              <a href="/finance/bankaccounts" class="btn btn-primary">Conta</a>
            </div>
          </div>
        </div>
        <div class="col-sm-3 mb-3">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Plano financeiro</h5>
              <p class="card-text"></p>
              <a href="/finance/financeplan" class="btn btn-primary"><i class="fas fa-external-link-alt"></i> Acessar</a>
              
            </div>
          </div>
        </div>
        <div class="col-sm-3 mb-3">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Pessoas</h5>
              <p class="card-text"></p>
              <a href="/finance/people" class="btn btn-primary"><i class="fas fa-external-link-alt"></i> Acessar</a>
            </div>
          </div>
        </div>
        <div class="col-sm-3 mb-3">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Compras</h5>
              <p class="card-text"></p>
              <a href="/finance/purchases" class="btn btn-primary"><i class="fas fa-external-link-alt"></i> Acessar</a>
            </div>
          </div>
        </div>
        <div class="col-sm-4 mb-3">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Vendas</h5>
              <p class="card-text"></p>
              <a href="/finance/sales" class="btn btn-primary"><i class="fas fa-external-link-alt"></i> Acessar</a>
              <a href="/finance/sales/report" class="btn btn-primary"><i class="far fa-file-alt"></i> Faturamento</a>
            </div>
          </div>
        </div>
        <div class="col-sm-3 mb-3">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Tesouraria</h5>
              <p class="card-text"></p>
              <a href="/finance/treasury" class="btn btn-primary"><i class="fas fa-external-link-alt"></i> Acessar</a>
            </div>
          </div>
        </div>
        <div class="col-sm-3 mb-3">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Contas a pagar</h5>
              <p class="card-text"></p>
              <a href="/finance/payments" class="btn btn-primary"><i class="fas fa-external-link-alt"></i> Acessar</a>
            </div>
          </div>
        </div>
        <div class="col-sm-3 mb-3">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Contas a receber</h5>
              <p class="card-text"></p>
              <a href="/finance/receivables" class="btn btn-primary"><i class="fas fa-external-link-alt"></i> Acessar</a>
            </div>
          </div>
        </div>
        <div class="col-sm-3 mb-3">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Empréstimos</h5>
              <p class="card-text"></p>
              <a href="/finance/loans" class="btn btn-primary"><i class="fas fa-external-link-alt"></i> Acessar</a>
            </div>
          </div>
        </div>
        
        
    </div>
</div>

@endsection