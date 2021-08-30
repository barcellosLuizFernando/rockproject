@extends('layouts.main')

@section('content')

<div class="container">

    <h1 class="display-6 mb-3"> Cadastros</h1>

    <div class="row">

        <div class="col-sm-3">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Funcionários</h5>
              <p class="card-text"></p>
              <a href="/registers/employee" class="btn btn-primary">Acessar</a>
            </div>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Transações</h5>
              <p class="card-text"></p>
              <a href="/registers/transactions" class="btn btn-primary">Acessar</a>
            </div>
          </div>
        </div>

    </div>


</div>
@endsection