@extends('layouts.main')

@section('content')

    <div class="container">

        <div>

            <h3 class="display-5 mb-5">Relatórios do ponto eletrônico</h3>



            @foreach ($users as $user)

                <h5 class="mt-5">{{ $user->name }}</h5>

                @foreach ($user->years as $year)



                    <div class="mb-3 border-left-primary">



                        <h4>{{ $year->year }}</h4>
                        <div class="row mb-3">
                            <div class="col-2 d-grid gap-2">
                                <a class="btn @if (!isset($year->january)) disabled btn-secondary @else btn-primary @endif"
                                    href="/periodsheet/report/{{ $year->year }}/1/{{ $user->id }}">Janeiro <span
                                        class="badge bg-secondary">{{ isset($year->january) ? $year->january : 0 }}</span></a>
                            </div>
                            <div class="col-2 d-grid gap-2">
                                <a class="btn @if (!isset($year->february)) disabled btn-secondary @else btn-primary @endif"
                                    href="/periodsheet/report/{{ $year->year }}/2/{{ $user->id }}">Fevereiro <span
                                        class="badge bg-secondary">{{ isset($year->february) ? $year->february : 0 }}</span></a>
                            </div>
                            <div class="col-2 d-grid gap-2">
                                <a class="btn @if (!isset($year->march)) disabled btn-secondary @else btn-primary @endif"
                                    href="/periodsheet/report/{{ $year->year }}/3/{{ $user->id }}">Março <span
                                        class="badge bg-secondary">{{ isset($year->march) ? $year->march : 0 }}</span></a>
                            </div>
                            <div class="col-2 d-grid gap-2">
                                <a class="btn @if (!isset($year->april)) disabled btn-secondary @else btn-primary @endif"
                                    href="/periodsheet/report/{{ $year->year }}/4/{{ $user->id }}">Abril <span
                                        class="badge bg-secondary">{{ isset($year->april) ? $year->april : 0 }}</span></a>
                            </div>
                            <div class="col-2 d-grid gap-2">
                                <a class="btn @if (!isset($year->may)) disabled btn-secondary @else btn-primary @endif"
                                    href="/periodsheet/report/{{ $year->year }}/5/{{ $user->id }}">Maio <span
                                        class="badge bg-secondary">{{ isset($year->may) ? $year->may : 0 }}</span></a>
                            </div>
                            <div class="col-2 d-grid gap-2">
                                <a class="btn @if (!isset($year->june)) disabled btn-secondary @else btn-primary @endif"
                                    href="//periodsheet/report/{{ $year->year }}/6/{{ $user->id }}">Junho <span
                                        class="badge bg-secondary">{{ isset($year->june) ? $year->june : 0 }}</span></a>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-2 d-grid gap-2">
                                <a class="btn @if (!isset($year->july)) disabled btn-secondary @else btn-primary @endif"
                                    href="/periodsheet/report/{{ $year->year }}/7/{{ $user->id }}">Julho <span
                                        class="badge bg-secondary">{{ isset($year->july) ? $year->july : 0 }}</span></a>
                            </div>
                            <div class="col-2 d-grid gap-2 ">
                                <a class="btn @if (!isset($year->august)) disabled btn-secondary @else btn-primary @endif"
                                    href="/periodsheet/report/{{ $year->year }}/8/{{ $user->id }}">Agosto <span
                                        class="badge bg-secondary">{{ isset($year->august) ? $year->august : 0 }}</span></a>
                            </div>
                            <div class="col-2 d-grid gap-2 ">
                                <a class="btn @if (!isset($year->september)) disabled btn-secondary @else btn-primary @endif"
                                    href="/periodsheet/report/{{ $year->year }}/9/{{ $user->id }}">Setembro <span
                                        class="badge bg-secondary">{{ isset($year->september) ? $year->september : 0 }}</span></a>
                            </div>
                            <div class="col-2 d-grid gap-2 ">
                                <a class="btn @if (!isset($year->october)) disabled btn-secondary @else btn-primary @endif"
                                    href="/periodsheet/report/{{ $year->year }}/10/{{ $user->id }}">Outubro <span
                                        class="badge bg-secondary">{{ isset($year->october) ? $year->october : 0 }}</span></a>
                            </div>
                            <div class="col-2 d-grid gap-2 ">
                                <a class="btn @if (!isset($year->november)) disabled btn-secondary @else btn-primary @endif"
                                    href="/periodsheet/report/{{ $year->year }}/11/{{ $user->id }}">Novembro <span
                                        class="badge bg-secondary">{{ isset($year->november) ? $year->november : 0 }}</span></a>
                            </div>
                            <div class="col-2 d-grid gap-2 ">
                                <a class="btn w-30 @if (!isset($year->december)) disabled btn-secondary @else btn-primary @endif"
                                    href="/periodsheet/report/{{ $year->year }}/12/{{ $user->id }}">Dezembro
                                    <span
                                        class="badge bg-secondary">{{ isset($year->december) ? $year->december : 0 }}</span></a>
                            </div>

                        </div>



                    </div>

                @endforeach
            @endforeach

        </div>




    </div>



@endsection
