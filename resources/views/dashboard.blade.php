<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>Dashboard - Covid 19 Brasil</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .fakeimg {
            height: 200px;
            background: #aaa;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <a class="navbar-brand" href="#">Dashborad - Covid 19 - Brasil</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
    </nav>
    <div class="container-fluid">
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
                                    <th scope="row"><a class="url-state"
                                        href="{{url('/')}}">Brasil</a></th>
                                    <td>{{$casePerStates->sum('deaths')}}</td>
                                </tr>
                                @foreach($casePerStates as $state)
                                <tr>
                                    <th scope="row"><a class="url-state"
                                            href="?state={{$state->uf}}">{{$state->state}}</a></th>
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

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <!-- Charting library -->
    <script src="https://unpkg.com/echarts/dist/echarts.min.js"></script>
    <!-- Chartisan -->
    <script src="https://unpkg.com/@chartisan/echarts/dist/chartisan_echarts.js"></script>
    <!-- Your application script -->
    <script>
        
        $(document).ready(function(){
            var param;
            $('.url-state').click(function(){
                this.param = $(this).attr('href')

            }) 
            console.log(this.param ?? '')
        })
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>