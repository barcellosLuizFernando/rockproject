@extends('layouts.main')

@section('content')

<div class="container p-3">

    <h1 class="display-6 mb-5"> Cadastro de Cursos</h1>

    <form class="" method="POST" autocomplete="off">
        @csrf
        @if (isset($course->id))
            @method('PUT')
        @endif
        <div class="row g-3 mb-4 border p-3 shadow-hover">
            <div class="col-md-12">
                <label for="coursename" class="form-label">Nome</label>
                <input type="text" class="form-control" name="coursename" value="{{ $course->name }}"
                    required>
            </div>
        </div>
        <div class="col-12 mb-5">
            <a class="btn btn-secondary" href="/registers"><i class="far fa-window-close"></i> Cancelar</a>
            <button class="btn btn-primary" type="submit"><i class="far fa-save"></i> Gravar curso</button>
        </div>
    </form>
</div>
    
@endsection