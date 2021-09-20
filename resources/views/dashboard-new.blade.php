@extends('layouts.main')

@section('content')

<div class="container">

    <div class="row">
        <div class="col-sm-6">
          <div class="card">
            <div class="card-body">
                <div id="chart" style="height: 300px;"></div>
            </div>
          </div>
        </div>
    </div>

</div>
   
@endsection

@section('bodyscript')
    <script>
        const chart = new Chartisan({
        el: '#chart',
        url: "@chart('sales_chart')",
      });
    </script>
@endsection
