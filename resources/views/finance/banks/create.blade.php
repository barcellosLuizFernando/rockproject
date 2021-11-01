@extends('layouts.main')

@section('content')

    <div class="container">

        <h1 class="display-6 mb-5"> Cadastro de Instituções Bancárias</h1>

        <form class="" method="POST" autocomplete="off" enctype="multipart/form-data">
            @csrf
            @if (isset($bank->id))
                @method('PUT')
            @endif

            <div class="row g-3 mb-4 border p-3 shadow-hover">
                <div class="col-md-6">
                    <label for="bankName" class="form-label">Razão Social</label>
                    <input type="text" class="form-control" name="bankName" value="{{ $bank->name }}" required>
                </div>
                <div class="col-md-6">
                    <label for="bankAlias" class="form-label">Nome Fantasia</label>
                    <input type="text" class="form-control" name="bankAlias" value="{{ $bank->alias }}" required>
                </div>
                <div class="col-md-3">
                    <label for="codcomp" class="form-label">Código compensação</label>
                    <input type="text" class="form-control" name="codcomp" value="{{ $bank->codcomp }}">
                </div>
                <div class="col-md-9">
                    <label for="site" class="form-label">Site</label>
                    <input type="text" class="form-control" name="site" value="{{ $bank->site }}">
                </div>
                <div class="col-md-12">
                    <label for="formFile" class="form-label">Logo</label>
                    <input class="form-control" type="file" id="formFile" name="formFile">
                </div>
            </div>

            <div class="col-12 mb-5">
                <button class="btn btn-primary" type="submit">Gravar banco</button>
                <a class="btn btn-secondary" href="/finance/banks">Cancelar</a>
            </div>
        </form>
    </div>

@endsection
