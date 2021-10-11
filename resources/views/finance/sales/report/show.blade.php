@extends('layouts.main')

@section('content')

    <div class="container">

        <h1 class="display-6 mb-5"> Histórico de faturamento</h1>

        <table class="table table-hover">
            <thead>

                <tr>
                    <th colspan=1 scope="col">Competência</th>
                    @foreach ($financeplans as $item)
                        <th scope="col" class="text-center">{{ $item }}</th>
                    @endforeach
                    <th scope="col" class="text-center">Total</th>

                </tr>

            </thead>

            <tbody>
                @foreach ($salesDates as $item)
                    <tr>
                        @foreach ($item as $dt)
                            <td @if (is_float($dt)) class="text-right" @endif>
                                @if (is_float($dt)) {{ number_format($dt, 2, ',', '.') }}
                                @else {{ $dt }}

                                @endif
                            </td>
                        @endforeach
                    </tr>
                @endforeach

            <tfoot>
                <tr>
                    <th scope="row">Total</th>
                    @foreach ($salesSum as $item)
                        <th scope="row" class="text-right">{{ number_format($item,2,',', '.') }}</th>

                    @endforeach
                </tr>
            </tfoot>
            </tbody>
        </table>
        <div class="" role="group" aria-label="sales report actions">
            <a class="btn btn-secondary" href="/finance"><i class="far fa-window-close"></i> Voltar</a>
            <a class="btn btn-secondary" href="/finance/sales/report/pdf"> <i class="far fa-file-pdf"></i> Exportar PDF</a>
        </div>

    </div>

@endsection
