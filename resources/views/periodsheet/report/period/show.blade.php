@extends('layouts.main')

@section('content')

    <div class="container">

        <h1 class="display-6 mb-3"> Folha de ponto</h1>

        <p>Colaborador: {{ strtoupper($timesheet[0]->user->name) }} </p>



        <table class="table table-hover">
            <thead>

                <tr>
                    <th colspan=2 scope="col">Dia</th>
                    <th scope="col">Entrada</th>
                    <th scope="col">Tipo</th>
                    <th scope="col">Saída</th>
                    <th scope="col">Tipo</th>
                    <th scope="col">Total</th>
                </tr>

            </thead>

            <tbody>
                @foreach ($tt as $day)

                    @for ($i = 0; $i < (count($day->sheets) == 0 ? 1 : count($day->sheets)); $i++)


                        <tr>
                            @if ($i == 0)
                                <th scope="row" rowspan="{{ count($day->sheets) == 0 ? 1 : count($day->sheets) }}">
                                    {{ $day->day }}</th>
                                    <td rowspan="{{ count($day->sheets) == 0 ? 1 : count($day->sheets) }}" >{{ $day->dayName }} </td>
                            
                            @endif



                            <td class="{{ isset($day->sheets[$i][0]['hasTrouble']) ? "table-danger" : "" }}"> {{ isset($day->sheets[$i]) ? date('H:i:s', strtotime($day->sheets[$i][0]['data'])) : '' }}
                            </td>
                            <td>{{ isset($day->sheets[$i]) ? $day->sheets[$i][0]['adjusted'] : "" }}</td>
                            <td class="{{ isset($day->sheets[$i][1]['hasTrouble']) ? "table-danger" : "" }}"> {{isset($day->sheets[$i]) ? date('H:i:s', strtotime($day->sheets[$i][1]['data'])) : '' }}
                            </td>
                            <td>{{isset($day->sheets[$i]) ? $day->sheets[$i][1]['adjusted'] : ""}}</td>
                            <td></td>



                        </tr>

                    @endfor

                @endforeach


            </tbody>
        </table>

       
    </div>




@endsection
