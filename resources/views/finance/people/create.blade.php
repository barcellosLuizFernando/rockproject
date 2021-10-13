@extends('layouts.main')

@section('content')

    <div class="container">

        <h1 class="display-6 mb-5"> Cadastro de Pessoas</h1>

        <form class="" method="POST" autocomplete="off">
            @csrf
            @if (isset($people->id))
                @method('PUT')
            @endif
            <div class="row g-3 mb-4 border p-3 shadow-hover">
                <div class="col-md-6">
                    <label for="name" class="form-label ">Nome</label>
                    <input type="text" class="form-control" name="name" value="{{ $people->name }}" required>
                </div>
                <div class="col-md-3">
                    <label for="taxnumber" class="form-label ">CPF / CNPJ</label>
                    <input type="text" class="form-control" name="taxnumber" value="{{ $people->taxnumber }}" required>
                </div>
                <div class="col-md-3">
                    <div>

                        <label for="taxtype" class="form-label ">Física / Jurídica</label>
                    </div>
                    <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                        <input type="radio" class="btn-check" name="btnfisicajuridica" id="pessoafisica" autocomplete="off" value="F" @if ($people->taxtype != "J") checked @endif>
                        <label class="btn btn-outline-primary" for="pessoafisica">Pessoa Física</label>

                        <input type="radio" class="btn-check" name="btnfisicajuridica" id="pessoajuridica" autocomplete="off" value="J" @if ($people->taxtype == "J") checked @endif>
                        <label class="btn btn-outline-primary" for="pessoajuridica">Pessoa Jurídica</label>

                    </div>

                </div>
                <div class="col-md-4">
                    <div>
                        <label class="form-label ">Tipo</label>
                    </div>
                    <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
                        <input type="checkbox" class="btn-check" id="btncheck1" name="client" value="C" autocomplete="off" @if ($people->client) checked @endif>
                        <label class="btn btn-outline-primary" for="btncheck1">Cliente</label>

                        <input type="checkbox" class="btn-check" id="btncheck2" name="supplier" value="S" autocomplete="off" @if ($people->supplier) checked @endif>
                        <label class="btn btn-outline-primary" for="btncheck2">Fornecedor</label>

                        <input type="checkbox" class="btn-check" id="btncheck3" name="employee" value="E" autocomplete="off" @if ($people->employee) checked @endif>
                        <label class="btn btn-outline-primary" for="btncheck3">Colaborador</label>
                    </div>
                </div>

                <div class="col-md-2">
                    <label for="zipcode" class="form-label ">CEP</label>
                    <input type="text" class="form-control" name="zipcode" value="{{ $people->zipcode }}">
                </div>
                
                <div class="col-md-4">
                    <label for="city" class="form-label ">Cidade / UF</label>
                    <select name="city" id="city" class="form-select" aria-label="Default select example">
                        @foreach ($cities as $city)
                        <option value="{{$city->id}}" @if ($people->idCity == $city->id) Selected @endif>{{$city->name . ' / ' . $city->state->alias}}</option>
                        @endforeach
                        
                    </select>
                    
                </div>
                <div class="col-md-2">
                    <label for="district" class="form-label ">Bairro</label>
                    <input type="text" class="form-control" name="district" value="{{ $people->district }}">
                </div>
                <div class="col-md-6">
                    <label for="address" class="form-label ">Endereço</label>
                    <input type="text" class="form-control" name="address" value="{{ $people->address }}">
                </div>
                <div class="col-md-6">
                    <label for="email" class="form-label ">e-mail</label>
                    <input type="text" class="form-control" name="email" value="{{ $people->email }}">
                </div>
                <div class="col-md-2">
                    <label for="phonenumber" class="form-label ">Telefone Fixo</label>
                    <input type="text" class="form-control" name="phonenumber" value="{{ $people->phonenumber }}">
                </div>
                <div class="col-md-2">
                    <label for="cellphonenumber" class="form-label ">Celular</label>
                    <input type="text" class="form-control" name="cellphonenumber" value="{{ $people->cellphonenumber }}">
                </div>


            </div>
            <div class="col-12 mb-5">
                <button class="btn btn-primary" type="submit">Gravar pessoa</button>
                <a class="btn btn-secondary" href="/finance/people">Cancelar</a>
            </div>
        </form>
    </div>
    @endsection
