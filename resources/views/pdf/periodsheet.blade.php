@extends('layouts.reports')

@section('content')


    <div class="container">

        <section>
            <h1 class="display-6 mb-3"> Folha de ponto</h1>

            <p>Colaborador: {{ strtoupper($timesheet[0]->user->name) }} </p>



            <table class="table table-hover mb-5">
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
                                        {{ $day->day }}


                                    </th>
                                    <td rowspan="{{ count($day->sheets) == 0 ? 1 : count($day->sheets) }}">
                                        {{ $day->dayName }} </td>

                                @endif



                                <td class="{{ isset($day->sheets[$i][0]['hasTrouble']) ? 'table-danger' : '' }}">
                                    {{ isset($day->sheets[$i]) ? date('H:i:s', strtotime($day->sheets[$i][0]['data'])) : '' }}



                                </td>
                                <td>{{ isset($day->sheets[$i]) ? $day->sheets[$i][0]['adjusted'] : '' }}</td>
                                <td class="{{ isset($day->sheets[$i][1]['hasTrouble']) ? 'table-danger' : '' }}">
                                    {{ isset($day->sheets[$i]) ? date('H:i:s', strtotime($day->sheets[$i][1]['data'])) : '' }}

                                </td>
                                <td>{{ isset($day->sheets[$i]) ? $day->sheets[$i][1]['adjusted'] : '' }}</td>
                                <td>{{ isset($day->sheets[$i][2]) ? $day->sheets[$i][2]['sumformatted'] : '' }}</td>



                            </tr>

                        @endfor

                    @endforeach


                </tbody>
            </table>
        </section>
        <section>
            <h1 class="display-6 mb-3"> Resumo do ponto</h1>

            <table class="table table-hover">
                <thead>

                    <tr>
                        <th scope="col">Semana</th>
                        <th scope="col">Tempo trabalhado</th>
                        <th scope="col">Quantidade dias</th>
                    </tr>
                </thead>
                @foreach ($balance as $week)

                    <tr>
                        <th scope="row">Semana {{ $week['week'] }}</th>

                        <td>{{ isset($week['worktimeformatted']) ? $week['worktimeformatted'] : '' }}</td>

                        <td>{{ $week['qtddays'] }}</td>
                    </tr>

                @endforeach
            </table>
        </section>

    </div>

@endsection
