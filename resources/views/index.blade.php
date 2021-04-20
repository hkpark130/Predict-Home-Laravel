@extends('layouts.app')

@section('content')
<div class="container">
    <h1>머신러닝 페이지</h1><hr>

    <div class="col text-center btn-group">
        <a href="/" class="btn btn-light active"> 집 값 예측 </a>
        <a href="/bot" class="btn btn-light"> 채팅 봇 </a>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">

                <div class="col-md-12">
                    <form method="post" action="{{url('/house')}}" accept-charset="utf8">
                        {{ csrf_field() }} 
                        <div class="form-group">
                            <label for=""> 주소 </label>
                            <select id="address" class="form-control">
                                <option value="0" selected>世田谷区</option>
                                <option value="1">中央区</option>
                                <option value="2">中野区</option>
                                <option value="3">北区</option>
                                <option value="4">千代田区</option>
                                <option value="5">台東区</option>
                                <option value="6">品川区</option>
                                <option value="7">墨田区</option>
                                <option value="8">大田区</option>
                                <option value="9">文京区</option>
                                <option value="10">新宿区</option>
                                <option value="11">杉並区</option>
                                <option value="12">板橋区</option>
                                <option value="13">江戸川区</option>
                                <option value="14">江東区</option>
                                <option value="15">渋谷区</option>
                                <option value="16">港区</option>
                                <option value="17">目黒区</option>
                                <option value="18">練馬区</option>
                                <option value="19">荒川区</option>
                                <option value="20">葛飾区</option>
                                <option value="21">豊島区</option>
                                <option value="22">足立区</option>
                            </select>
                        </div>
                        <div class="form-group row justify-content-center">
                            <div class="form-group col-md-3">
                                <label for="">역까지 거리 (분)</label>
                                <input type="number" class="form-control" id="" placeholder="1~12" required>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="">건축일</label>
                                <input type="number" class="form-control" id="" placeholder="1990~{{$view_params['this_year']}}" required>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="">방 면적 (m<sup>2</sup>)</label>
                                <input type="number" class="form-control" id="" placeholder="15~50" required>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="">층수</label>
                                <input type="number" class="form-control" id="" placeholder="1~15" required>
                            </div>

                        </div>

                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="">
                                <label class="form-check-label">
                                    화장실 별도
                                </label>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">
                            예상 집 값		
                        </button>
                    </form>
                </div>

                {{$view_params['test']}}

            </div>
        </div>
    </div>
</div>
@endsection