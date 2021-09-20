@extends('layouts.main')

@section('content')

    <div class="container">
        <h1 class="display-6 mb-5"> Cadastro de produtos</h1>


        <form class="" method="POST" autocomplete="off">
            @csrf
            @if (isset($product->id))
                @method('PUT')
            @endif

            <div class="row g-3 mb-4 border p-3 shadow-hover">
                <h5 class="card-title">Dados gerais</h5>
                <div class="col-md-12">
                    <label for="prodName" class="form-label">Descrição</label>
                    <input type="text" class="form-control" name="prodName" value="{{ $product->description }}" required>
                </div>

            </div>
            <div class="col-12 mb-5">
                <button class="btn btn-primary" type="submit">Gravar produto</button>
                <a class="btn btn-secondary" href="/registers/products">Cancelar</a>
            </div>


        </form>
    </div>

@endsection
