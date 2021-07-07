@extends('layouts.emaillog')

@section('content')



    <div>
        <h2 style="text-align: center">Registro do ponto eletrônico</h2>
        <p><b>Nome:</b> {{ $timesheet->user->name }}</p>
        <p><b>Fluxo:</b> {{ $timesheet->flow == 0 ? 'Entrada' : "Saída" }}</p>
        <p><b>Data:</b> {{ date('d/m/Y', strtotime($timesheet->datetime)) }}</p>
        <p><b>Hora:</b> {{ date('H:i:s', strtotime($timesheet->datetime)) }}</p>
        <p><b>Tipo registro:</b> {{ $timesheet->adjusted == false ? 'Original' : 'Ajustado' }}</p>
        <p><b>IP de origem:</b> {{ $timesheet->ip }}</p>
        
        
    </div>



@endsection
