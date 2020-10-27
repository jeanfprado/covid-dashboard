@extends('app')

@section('content')

<div class="row" style="margin-top:30px">
    <div class="col-3">
        <div class="card">
            <div class="card-body">
                <div style="overflow: auto; height: 800px">
                <table class="table table-fixed table-striped">
                    <div class="card-header">
                        <b>Número Óbitos Por Estado</b>
                    </div>
                    <thead>
                        <tr>
                            <th scope="col">Estado</th>
                            <th scope="col">Óbitos</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row"><a class="url-state" href="{{url('/')}}">Brasil</a></th>
                            <td>{{$casePerStates->sum('deaths')}}</td>
                        </tr>
                        @foreach($casePerStates as $state)
                        <tr>
                            <th scope="row"><a class="url-state" href="?state={{$state->uf}}">{{$state->state}}</a></th>
                            <td>{{$state->deaths}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="col-sm-12">
            <h4 style="text-align: center" >Resultados @if(Request::has('state')){{Request::query('state')}} @else Brasil @endif</h4>
            <!-- Chart's container -->
            <div id="chart" style="height: 300px;"></div>
            <hr/>
            <h4 style="text-align: center" >Resultados @if(Request::has('state')){{Request::query('state')}} @else Brasil @endif</h4>
            <!-- Chart's container -->
            <div id="chart2" style="height: 300px;"></div>
            <hr/>

            <h4 style="text-align: center" >Resultados Óbitos Registrado em Cartório @if(Request::has('state')){{Request::query('state')}} @else Brasil @endif</h4>
            <!-- Chart's container -->
            <div id="chart4" style="height: 300px;"></div>

            <h4 style="text-align: center" >Resultados Brasil </h4>
            <!-- Chart's container -->
            <div id="chart3" style="height: 300px;"></div>

        </div>
    </div>
    <div class="col-3">
        <div class="card">
            @if(empty($casesDeathsForCities))
            <div class="card-header">
               <h5><b>Dados Globais</b></h5>
            </div>
            <div class="card-body">
                <h5 class="card-title">Total de Óbitos</h5>
                <p class="card-text">{{ $totalWorld['TotalDeaths'] }}</p>
                <h5 class="card-title">Total de Casos Confirmados</h5>
                <p class="card-text">{{ $totalWorld['TotalConfirmed'] }}</p>
                <h5 class="card-title">Total de Casos Recuperados</h5>
                <p class="card-text">{{ $totalWorld['TotalRecovered'] }}</p>
                <h5 class="card-title">Total de Casos Ativos</h5>
                <p class="card-text">{{$totalWorld['TotalConfirmed'] - $totalWorld['TotalRecovered'] }}</p>
            </div>
            @else
            <div class="card-header">
                <b>Número Óbitos Por Cidade</b>
            </div>
            <div class="card-body">
                <div style="overflow: auto; height: 800px">
                <table class="table table-fixed table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Cidade</th>
                            <th scope="col">Óbitos</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($casesDeathsForCities as $city => $deaths)
                        <tr>
                            <th scope="row" class="col-xs-7">{{$city}}</th>
                            <td class="col-xs-5">{{$deaths}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                    </div>

                </div>
            </div>
            @endif
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

        const chart3 = new Chartisan({
          el: '#chart3',
          url: "@chart('covid_confirmed_recovered_pie_chart')@if(Request::has('state'))?state={{Request::query('state')}}@endif",
          hooks: new ChartisanHooks()
          .legend()
          .colors()
          .tooltip()
          .datasets(['pie'])

        });

        const chart4 = new Chartisan({
          el: '#chart4',
          url: "@chart('registry_deaths_line_chart')@if(Request::has('state'))?state={{Request::query('state')}}@endif",
          hooks: new ChartisanHooks()
          .legend()
          .colors()
          .tooltip()
          .datasets(['line'])

        });
</script>

@endsection
