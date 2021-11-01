@extends('layouts.main')

@section('content')


<div class="container">
    <h1 class="display-6 mb-3"> Extratos bancários </h1>

    <form action="/finance/treasury/bankstatement" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row g-3 mb-4 border p-3 shadow-hover">
            <h5 class="card-title">Importar OFX</h5>

            <div class="input-group">
                <input type="file" class="form-control" id="inputGroupFile04" name="file[]"
                    aria-describedby="inputGroupFileAddon04" aria-label="Upload" accept="text/ofx" multiple>
                <button class="btn btn-outline-secondary" type="submit" id="inputGroupFileAddon04">Enviar</button>
            </div>
        </div>
    </form>

</div>
    
@endsection