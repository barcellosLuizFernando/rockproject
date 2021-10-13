@extends('layouts.main')

@section('content')

<div class="container">

    <h1 class="display-6 mb-3"> Cadastros</h1>

    <div class="row">

        <div class="col-sm-5 mb-4">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Pessoas</h5>
              <p class="card-text"></p>
              <a href="/registers/companies" class="btn btn-primary mb-1">Empresas</a>
              <a href="/registers/employee" class="btn btn-primary mb-1">Funcionários</a>
              <a href="/registers/users" class="btn btn-primary mb-1">Usuários</a>
              <a href="#" class="btn btn-secondary disabled mb-1">Times</a>
            </div>
          </div>
        </div>
        
        <div class="col-sm-6 mb-4">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Ensino</h5>
              <p class="card-text"></p>
              <a href="/registers/courses" class="btn btn-primary mb-1">Cursos</a>
              <a href="/registers/classcourses" class="btn btn-primary mb-1">Turmas</a>
              <a href="/registers/classlocals" class="btn btn-primary mb-1">Locais</a>
              <a href="/registers/classrooms" class="btn btn-primary mb-1">Salas de aula</a>
            </div>
          </div>
        </div>
        <div class="col-sm-4 mb-4">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Diversos</h5>
              <p class="card-text"></p>
              <a href="/registers/transactions" class="btn btn-primary mb-1">Transações</a>
              <a href="/registers/products" class="btn btn-primary mb-1">Produtos</a>
              <a href="/registers/calendars" class="btn btn-primary mb-1">Agendas</a>
            </div>
          </div>
        </div>
      </div>


</div>
@endsection