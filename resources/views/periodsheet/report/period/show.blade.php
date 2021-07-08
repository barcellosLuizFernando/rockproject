@extends('layouts.main')

@section('content')

    <div class="container">

        <h1 class="display-6 mb-3"> Folha de ponto</h1>
        <p>Período: </p>
        <p>Colaborador: {{ strtoupper($timesheet[0]->user->name) }} </p>



        <table>
            <thead>

                <tr>
                    <th scope="col">Dia</th>
                    <th scope="col">Entrada</th>
                    <th scope="col">Início intervalo</th>
                    <th scope="col">Fim intervalo</th>
                    <th scope="col">Saída</th>
                </tr>

            </thead>

            <tbody 
            @for ($i = 0; $i < $days; $i++) 
            
                <tr> 

                    <th scope="row">{{ $i + 1 }}</th>

                </tr>
            
             
            @endfor


                </tbody>
        </table>
        {{ $timesheet }}
    </div>



@endsection
