@extends('layouts.main')

@section('content')

    <div class="container">

        <h1 class="display-6 mb-5"> Cadastro de Plano Financeiro</h1>

        <form class="" method="POST" autocomplete="off">
            @csrf
            @if (isset($financeplan->id))
                @method('PUT')
            @endif
            <div class="row g-3 mb-4 border p-3 shadow-hover">

                <div class="col-md-3">
                    <label for="classification" class="form-label ">Classificação</label>
                    <input type="text" class="form-control" name="classification"
                        value="{{ $financeplan->classification }}" required>
                </div>
                <div class="col-md-6">
                    <label for="name" class="form-label ">Nome</label>
                    <input type="text" class="form-control" name="name" value="{{ $financeplan->name }}" required>
                </div>
                <div class="col-md-3">
                    <label for="anasin" class="form-label ">Analítica / Sintética</label>
                    <select name="anasin" id="anasin" class="form-select" aria-label="Default select example">
                        <option value="S" @if ($financeplan->anasin == 'S') Selected @endif>Sintética</option>
                        <option value="A" @if ($financeplan->anasin == 'A') Selected @endif>Analítica</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="type" class="form-label ">Tipo</label>
                    <select name="type" id="type" class="form-select" aria-label="Default select example">
                        <option value="C" @if ($financeplan->type == 'C') Selected @endif>CAPEX</option>
                        <option value="O" @if ($financeplan->type == 'O') Selected @endif>OPEX</option>
                        <option value="S" @if ($financeplan->type == 'S') Selected @endif>Sales</option>
                        <option value="F" @if ($financeplan->type == 'F') Selected @endif>Financeiras</option>
                        <option value="U" @if ($financeplan->type == 'U') Selected @endif>Outras</option>
                    </select>
                </div>
                <div class="col-md-9">
                    <label for="description" class="form-label ">Descrição</label>
                    <input type="text" class="form-control" name="description" value="{{ $financeplan->description }}">
                </div>
            </div>


            <div class="col-12 mb-5">
                <button class="btn btn-primary" type="submit">Gravar plano</button>
                <a class="btn btn-secondary" href="/finance/financeplan">Cancelar</a>
            </div>
        </form>

    </div>

@endsection
