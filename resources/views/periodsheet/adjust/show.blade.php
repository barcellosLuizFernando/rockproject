@extends('layouts.main')

@section('content')

    <div class="container">

        <h1 class="display-6 mb-5"> Ajuste de folha ponto</h1>

        <form class="" action="/periodsheet/adjust/{{$periodsheet->id}}" method="POST" autocomplete="off">
            @csrf
            @if ($periodsheet->id <> "Novo")
                @method("PUT")
            @endif
            <div class="row g-3 mb-4 border p-3 shadow-hover">

                <div class="col-md-12">
                    <label for="idUser" class="form-label">Colaborador</label>
                    <select class="form-control" name="idUser" id="idUser" aria-label="idUser" required>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3">
                    <label for="datetime" class="form-label">Data</label>
                    <input type="date" class="form-control" name="datetime"
                        value="{{ date('Y-m-d', strtotime($periodsheet->datetime)) }}" required>
                </div>
                <div class="col-md-2">
                    <label for="time" class="form-label">Horário</label>
                    <input type="time" class="form-control" name="time"
                        value="{{ date('H:i:s', strtotime($periodsheet->datetime)) }}" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Entrada / Saída</label>
                    <div class="form-control">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="flow" id="flow1" value="0" @if ($periodsheet->flow == '0' || $periodsheet->flow == null) checked @endif>
                            <label class="form-check-label" for="flow1">Entrando</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="flow" id="flow2" value="1" @if ($periodsheet->flow == '1') checked @endif>
                            <label class="form-check-label" for="flow2">Saindo</label>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <label for="time" class="form-label">Observação</label>
                    <textarea class="form-control" name="observation" id="observation" cols="30" rows="3"
                        required>{{ $periodsheet->description }}</textarea>
                </div>

            </div>

            <div class="col-12 mb-5">
                <button class="btn btn-primary" type="submit">Gravar ajuste</button>
                <a class="btn btn-secondary" href="/">Cancelar</a>
            </div>

        </form>

        

    </div>

@endsection
