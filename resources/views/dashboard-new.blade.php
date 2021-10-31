@extends('layouts.main')

@section('content')

    <div class="container bg-light pt-4">

        @can('isAdmin')

            <div id="avgticket" class="col-sm-12">
               
                <div class="card-group">

                    <div v-for="m in months" class="card text-dark border-light  mb-3 mr-3">

                        <div class="card-header">@{{ m . name }}</div>
                        <div class="card-body ">

                            <div class="">

                                <div class="card text-center mb-3">
                                    <div class="card-body">
                                        <h5 class="card-title">Recebimentos</h5>
                                        <p class="card-text display-5">@{{ m . qtd }}</p>
                                    </div>
                                    <div class="card-footer">
                                        <small class="text-muted">Com outliers: @{{ m . qtd_o }} </small>
                                    </div>
                                </div>

                                <div class="card text-center mb-3">
                                    <div class="card-body">
                                        <h5 class="card-title">Ticket médio</h5>
                                        <p class="card-text display-5 ">@{{ m . val }}</p>
                                    </div>
                                    <div class="card-footer">
                                        <small class="text-muted">Com outliers: @{{ m . val_o }}</small>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>



                </div>

            </div>

            <div class="row">
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <div id="saleschart" style="height: 300px;"></div>
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
                el: '#saleschart',
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

            
            const app_avgticket = new Vue({
                el: "#avgticket",
                data: {
                    months: []
                },
                created() {
                    fetch('/finance/sales/avgticket')
                        .then(response => response.json())
                        .then(json => {
                            this.months = json.months
                        })
                },
                
            });
        </script>
    @endcan


@endsection
