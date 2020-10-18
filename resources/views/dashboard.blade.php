@extends('app')

@section('content')

<div class="row" style="margin-top:30px">
    <div class="col-sm-3">
        <div class="card">
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Estado</th>
                            <th scope="col">Nº Obtos</th>
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
    <div class="col-sm-9">
        <!-- Chart's container -->
        <div id="chart" style="height: 300px;"></div>
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
          loader: {
          color: '#000000',
          size: [30, 30],
          type: 'bar',
          textColor: '#000000',
          text: 'Carregando dados...',
          },
          hooks: new ChartisanHooks()
          .legend()
          .colors()
          .tooltip(),
        });
</script>

@endsection