@extends('layouts.main')

@section('content')

    <div class="container">

        <div>

            <h3 class="display-5">Relatórios do ponto eletrônico</h3>
            @foreach ($years as $year)
                <div class="mb-3 border-left-primary">



                    <h4>{{ $year->year }}</h4>
                    <div class="row mb-3">
                        <div class="col-2 d-grid gap-2">
                            <a class="btn btn-primary" href="/periodsheet/report/{{$year->year}}/1">Janeiro <span class="badge bg-secondary">{{ isset($year->january) ? $year->january : 0 }}</span></a>
                        </div>
                        <div class="col-2 d-grid gap-2">
                            <a class="btn btn-primary" href="/periodsheet/report/{{$year->year}}/2">Fevereiro <span class="badge bg-secondary">{{ isset($year->february) ? $year->february : 0 }}</span></a>
                        </div>
                        <div class="col-2 d-grid gap-2">
                            <a class="btn btn-primary" href="/periodsheet/report/{{$year->year}}/3">Março <span class="badge bg-secondary">{{ isset($year->march) ? $year->march : 0 }}</span></a>
                        </div>
                        <div class="col-2 d-grid gap-2">
                            <a class="btn btn-primary" href="/periodsheet/report/{{$year->year}}/4">Abril <span class="badge bg-secondary">{{ isset($year->april) ? $year->april : 0 }}</span></a>
                        </div>
                        <div class="col-2 d-grid gap-2">
                            <a class="btn btn-primary" href="/periodsheet/report/{{$year->year}}/5">Maio <span class="badge bg-secondary">{{ isset($year->may) ? $year->may : 0 }}</span></a>
                        </div>
                        <div class="col-2 d-grid gap-2">
                            <a class="btn btn-primary" href="//periodsheet/report{{$year->year}}/6">Junho <span class="badge bg-secondary">{{ isset($year->june) ?$year->june: 0 }}</span></a>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-2 d-grid gap-2">
                            <a class="btn btn-primary" href="/periodsheet/report/{{$year->year}}/7">Julho <span class="badge bg-secondary">{{ isset($year->july) ? $year->july : 0 }}</span></a>
                        </div>
                        <div class="col-2 d-grid gap-2">
                            <a class="btn btn-primary" href="/periodsheet/report/{{$year->year}}/8">Agosto <span class="badge bg-secondary">{{ isset($year->august) ?$year->august: 0 }}</span></a>
                        </div>
                        <div class="col-2 d-grid gap-2">
                            <a class="btn btn-primary" href="/periodsheet/report{{$year->year}}/9">Setembro <span class="badge bg-secondary">{{ isset($year->september) ?$year->september: 0 }}</span></a>
                        </div>
                        <div class="col-2 d-grid gap-2">
                            <a class="btn btn-primary" href="/periodsheet/report/{{$year->year}}/10">Outubro <span class="badge bg-secondary">{{ isset($year->october) ?$year->october: 0 }}</span></a>
                        </div>
                        <div class="col-2 d-grid gap-2">
                            <a class="btn btn-primary" href="/periodsheet/report{{$year->year}}/11">Novembro <span class="badge bg-secondary">{{ isset($year->november) ?$year->november: 0 }}</span></a>
                        </div>
                        <div class="col-2 d-grid gap-2">
                            <a class="btn btn-primary w-30" href="/periodsheet/report/{{$year->year}}/12">Dezembro <span class="badge bg-secondary">{{ isset($year->december) ?$year->december: 0 }}</span></a>
                        </div>

                    </div>



                </div>
            @endforeach

        </div>




    </div>



@endsection
