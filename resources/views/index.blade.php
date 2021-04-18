@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">

                <div class="row">
                    개발중
                </div>

                <form method="post" action="{{url('/house')}}" accept-charset="utf8">
                    {{ csrf_field() }} 
                    <button type="submit" class="btn btn-primary">
                        Python 테스트		
                    </button>
                </form>

                {{$view_params['test']}}

            </div>
        </div>
    </div>
</div>
@endsection