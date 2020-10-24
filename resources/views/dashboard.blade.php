@extends('app')
@section('content')

<head>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="css.app" rel="stylesheet">
</head>

<div class="row" style="margin-top:30px">
    <div class="col-3">
        <div class="card">
            <div class="card-body">
                <div style="overflow: auto; height: 640px">
                    <table class="table table-fixed table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Estado</th>
                                <th scope="col" style="min-width: 100px">Nº Obtos</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row"><a style="color: black" class="url-state" href="{{url('/')}}">Brasil</a></th>
                                <td>{{$casePerStates->sum('deaths')}}</td>
                            </tr>
                            @foreach($casePerStates as $state)
                            <tr>
                                <th scope="row">
                                    <a style="color: black" class="url-state" href="?state={{$state->uf}}">{{$state->state}}</a>
                                </th>
                                <td>{{$state->deaths}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 charts">
        <div class="col-sm-12">
            <!-- Chart's container -->
            <div id="chart" style="height: 300px;"></div>
        </div>
        <div class="col-sm-6">
            <!-- Chart's container -->
            <div id="chart2" style="width: 400px; height: 400px;"></div>
        </div>    
    </div>
    <div class="col-3">
        <div class="card card-table">
            <div class="card-body">
                <div style="overflow: auto; height: 640px">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Cidade</th>
                                <th scope="col" style="min-width: 100px">Nº Obtos</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($listCity as $key => $value)
                            <tr>
                            <th scope="row">{{$key}}</th>
                                <td>{{$value}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<!-- Charting library -->
<script src="https://unpkg.com/echarts/dist/echarts.min.js"></script>
<!-- Chartisan -->
<script src="https://unpkg.com/@chartisan/echarts/dist/chartisan_echarts.js"></script>
<!-- Your application script -->
<script>
    const chart = new Chartisan({
          el: '#chart',
          url: "@chart('covid_confirmed_deaths_bar_chart')@if(Request::has('state'))?state={{Request::query('state')}}@endif",
          hooks: new ChartisanHooks()
          .legend()
          .colors()
          .tooltip()
          .datasets(['bar'])
          
        });
        const chart2 = new Chartisan({
          el: '#chart2',
          url: "@chart('covid_confirmed_deaths_pie_chart')@if(Request::has('state'))?state={{Request::query('state')}}@endif",
          hooks: new ChartisanHooks()
          .legend()
          .colors()
          .tooltip()
          .datasets(['pie'])
          
        });
</script>

@endsection