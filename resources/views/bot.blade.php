@extends('layouts.app')

@section('content')
<div class="container">
    <h1>머신러닝 페이지</h1><hr>

    <div class="col text-center btn-group">
        <a href="/" class="btn btn-light"> 집 값 예측 </a>
        <a href="/bot" class="btn btn-light active"> 채팅 봇 </a>
    </div>

    <div class="row">
        <div class="col-md-12">
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