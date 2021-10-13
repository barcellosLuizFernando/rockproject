@extends('layouts.main')

@section('content')

    <div class="container p-3">

        <h1 class="display-6 mb-5"> Cadastro de Locais</h1>
        @if ($classlocal->filename)
            <div class="" style="height: 180px; overflow: hidden;">
                <img class="" style="transform: translateY(-25%);"
                    src="{{ '/storage/classlocals/' . $classlocal->filename }}" alt="ImageLocal">
            </div>
        @endif

        <form class="" method="POST" autocomplete="off" enctype="multipart/form-data">
            @csrf
            @if (isset($classlocal->id))
                @method('PUT')
            @endif
            <div class="row g-3 mb-4 border p-3 shadow-hover">
                <div class="col-md-6">
                    <label for="localdescription" class="form-label">Descrição</label>
                    <input type="text" class="form-control" name="localdescription"
                        value="{{ $classlocal->description }}" required>
                </div>
                <div class="col-md-6">
                    <label for="localaddress" class="form-label">Endereço</label>
                    <input type="text" class="form-control" name="localaddress" value="{{ $classlocal->address }}"
                        required>
                </div>
                <div class="col-md-2">
                    <label for="localzipcode" class="form-label">CEP</label>
                    <input type="text" class="form-control" name="localzipcode" value="{{ $classlocal->zipcode }}"
                        required>
                </div>
                <div class="col-md-4">
                    <label for="localdistrict" class="form-label">Bairro</label>
                    <input type="text" class="form-control" name="localdistrict" value="{{ $classlocal->district }}"
                        required>
                </div>
                <div class="col-md-6">
                    <label for="localcity" class="form-label">Cidade</label>
                    <select name="localcity" id="localcity" class="form-control">
                        <option value="" disabled @if (!isset($classlocal->idCity)) selected @endif></option>
                        @foreach ($cities as $city)
                            <option value="{{ $city->id }}" @if ($city->id == $classlocal->idCity) selected @endif>
                                {{ $city->name . ' / ' . $city->state->alias }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-12">
                    <label for="formFile" class="form-label">Imagem</label>
                    <input class="form-control" type="file" id="formFile" name="formFile">
                </div>
            </div>
            <div class="col-12 mb-5">
                <a class="btn btn-secondary" href="/registers/classlocals"><i class="far fa-window-close"></i>
                    Cancelar</a>
                <button class="btn btn-primary" type="submit"><i class="far fa-save"></i> Gravar local</button>
            </div>
        </form>

    </div>

@endsection
