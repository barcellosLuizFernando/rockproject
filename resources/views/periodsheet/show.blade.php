@extends('layouts.main')

@section('content')

    <div class="container">
        <div class="">
            <div class="row pt-5 mb-3">

                <h5 class="text-center">{{ auth()->user()->name }}</h5>

            </div>
            <div class="row mb-3">

                <h1 class="text-center" name="current_timestamp" id="current_timestamp">carregando</h1>

            </div>

            <div class="d-grid gap-2 col-6 mx-auto mb-3">
                <a href="/periodsheet/create" role="button" class="btn @if ($periodsheet->flow == 1 ||
                isset($periodsheet->alternativeflow)) btn-success @else btn-warning @endif
                btn-lg">@if ($periodsheet->flow == 1 || isset($periodsheet->alternativeflow)) Registrar entrada @else
                        Registrar saída @endif</a>
            </div>


            <div class="row">

                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Movimento</th>
                            <th scope="col">Data</th>
                            <th scope="col">Horário</th>
                            <th scope="col">IP</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (isset($periodsheet->datetime))
                            <tr>
                                <th scope="row">{{ $periodsheet->id }}</th>
                                <td scope="row">{{ $periodsheet->flow == 0 ? 'Entrada' : 'Saída' }}</td>
                                <td scope="row">{{ date('d/m/Y', strtotime($periodsheet->datetime)) }}</td>
                                <td scope="row">{{ date('H:i:s', strtotime($periodsheet->datetime)) }}</td>
                                <td scope="row">{{ $periodsheet->ip }}</td>

                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection


@section('bodyscript')

    <script type="text/javascript">
        setInterval(() => {

            var current_timestamp = document.getElementById("current_timestamp");
            var time = new Date();
            var curDate = ("00" + time.getDate()).slice(-2) + "/" + ("00" + (time.getMonth() + 1)).slice(-2) + "/" +
                time.getFullYear();
            curDate += " " + ("00" + time.getHours()).slice(-2) + ":" + ("00" + time.getMinutes()).slice(-2) + ":" +
                ("00" + time.getSeconds()).slice(-2);

            current_timestamp.textContent = curDate;

        }, 1000);
    </script>


@endsection
