@extends('layouts.main')

@section('content')

    <div class="container p-3">

        <h1 class="display-6 mb-5"> Cadastro de Turmas</h1>

        <form class="" method="POST" autocomplete="off">
            @csrf
            @if (isset($courseclass->id))
                @method('PUT')
            @endif
            <div class="row g-3 mb-4 border p-3 shadow-hover">
                <div class="col-md-8">
                    <label for="coursename" class="form-label">Descrição</label>
                    <input type="text" class="form-control" name="coursename" value="{{ $courseclass->name }}" required>
                </div>
                <div class="col-md-4">
                    <label for="rockId" class="form-label">Id Rockfeller</label>
                    <input type="text" class="form-control" name="rockId" value="{{ $courseclass->rockId }}">
                </div>
                <div class="col-md-4">
                    <label for="company" class="form-label">Escola</label>
                    <select name="company" id="company" class="form-control" required>
                        <option value="" disabled @if (!isset($courseclass->id)) selected @endif></option>
                        @foreach ($companies as $item)
                            <option value="{{ $item->id }}" @if ($item->id == $courseclass->idCompany) selected @endif>{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="classlocal" class="form-label">Local</label>
                    <select name="classlocal" id="classlocal" class="form-control" required>
                        <option value="" disabled @if (!isset($courseclass->id)) selected @endif></option>
                        @foreach ($classlocals as $item)
                            <option value="{{ $item->id }}" @if ($item->id == $courseclass->idClassLocal) selected @endif>{{ $item->description }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="course" class="form-label">Curso</label>
                    <select name="course" id="course" class="form-control" required>
                        <option value="" disabled @if (!isset($courseclass->id)) selected @endif></option>
                        @foreach ($courses as $item)
                            <option value="{{ $item->id }}" @if ($item->id == $courseclass->idCourse) selected @endif>{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>

            </div>
            <div class="col-12 mb-5">
                <a class="btn btn-secondary" href="/registers/classcourses"><i class="far fa-window-close"></i> Cancelar</a>
                <button class="btn btn-primary" type="submit"><i class="far fa-save"></i> Gravar turma</button>
            </div>
        </form>
    </div>

@endsection
