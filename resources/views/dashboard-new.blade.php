@extends('layouts.main')

@section('content')

    <div class="container">

        @can('isAdmin')
            <div class="row">
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <div id="chart" style="height: 300px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        @endcan

    </div>

@endsection

@section('bodyscript')

    @can('isAdmin')

        <script>
            const chart = new Chartisan({
                el: '#chart',
                url: "@chart('sales_chart')",
                error: {
                    color: '#ff00ff',
                    size: [30, 30],
                    text: 'Yarr! There was an error...',
                    textColor: '#ffff00',
                    type: 'general',
                    debug: true,
                },

                hooks: new ChartisanHooks()
                    .colors()
                    .legend({
                        bottom: 0
                    })
                    .tooltip()
                    .title({
                        textAlign: 'center',
                        left: '50%',
                        text: 'Evolução das vendas',
                    }),
                options: {

                }
            });
        </script>
    @endcan


@endsection
