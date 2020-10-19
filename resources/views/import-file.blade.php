@extends('app')

@section('content')

<div class="row" style="margin-top:30px">
    @if($errors->any())
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-ban"></i> Alerta!</h4>
        @foreach($errors->all() as $error )
        {{ $error }} <br />
        @endforeach
    </div>
    @endif
    @if (session('error'))

    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-ban"></i> Alerta!</h4>
        {{ session('error') }}
    </div>
    @endif

    @if (session('success'))

    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-check"></i> Sucesso!</h4>
        {{ session('success') }}
    </div>
    @endif
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <form action="{{route('import.store')}}" method="POST" enctype="multipart/form-data" >
                    @csrf
                    <div class="form-group">
                        <label for="file">Arquivo:</label>
                        <input type="file" name="file" class="form-control-file" id="file">
                    </div>

                    <button type="submit" class="btn btn-primary mb-2">Upload</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
@endsection