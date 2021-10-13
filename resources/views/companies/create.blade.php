@extends('layouts.main')

@section('content')
    <div class="container p-3">

        <h1 class="display-6 mb-5"> Cadastro de Escolas</h1>

        <form class="" method="POST" autocomplete="off">
            @csrf
            @if (isset($company->id))
                @method('PUT')
            @endif
            <div class="row g-3 mb-4 border p-3 shadow-hover">
                <div class="col-md-6">
                    <label for="name" class="form-label ">Nome</label>
                    <input type="text" class="form-control" name="name" value="{{ $company->name }}" required>
                </div>
                <div class="col-md-3">
                    <label for="taxnumber" class="form-label ">CNPJ</label>
                    <input type="text" class="form-control" name="taxnumber" value="{{ $company->taxnumber }}" required>
                </div>
                <div class="col-md-3">
                    <label for="statetaxnumber" class="form-label ">Inscrição Estadual</label>
                    <input type="text" class="form-control" name="statetaxnumber" value="{{ $company->statetaxnumber }}"
                        required>
                </div>
                <div class="col-md-2">
                    <label for="citytaxnumber" class="form-label ">Inscrição Municipal</label>
                    <input type="text" class="form-control" name="citytaxnumber" value="{{ $company->citytaxnumber }}"
                        required>
                </div>

                <div class="col-md-2">
                    <label for="zipcode" class="form-label ">CEP</label>
                    <input type="text" class="form-control" name="zipcode" value="{{ $company->zipcode }}" required>
                </div>

                <div class="col-md-4">
                    <label for="city" class="form-label ">Cidade / UF</label>
                    <select name="city" id="city" class="form-select" aria-label="Cities from brazil" required>
                        @foreach ($cities as $city)
                            <option value="{{ $city->id }}" @if ($company->idCity == $city->id) Selected @endif>
                                {{ $city->name . ' / ' . $city->state->alias }}</option>
                        @endforeach

                    </select>

                </div>
                <div class="col-md-4">
                    <label for="district" class="form-label ">Bairro</label>
                    <input type="text" class="form-control" name="district" value="{{ $company->district }}" required>
                </div>
                <div class="col-md-12">
                    <label for="address" class="form-label ">Endereço</label>
                    <input type="text" class="form-control" name="address" value="{{ $company->address }}" required>
                </div>


            </div>
            <div class="col-12 mb-5">
                <a class="btn btn-secondary" href="/registers/companies">Cancelar</a>
                <button class="btn btn-primary" type="submit">Gravar empresa</button>
            </div>
        </form>
    </div>
@endsection
