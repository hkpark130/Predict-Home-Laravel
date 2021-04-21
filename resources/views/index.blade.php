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
                    <form type="post" id="submit-form" >
                        {{ csrf_field() }} 
                        <div class="form-group">
                            <label for="address"> 주소 </label>
                            <select name="address" class="form-control">
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
                                <label for="dis_to_station">역까지 거리 (분)</label>
                                <input type="number" class="form-control" name="dis_to_station" placeholder="1~12" min="1" max="12" required>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="year_of_cons">건축일</label>
                                <input type="number" class="form-control" name="year_of_cons" placeholder="1990~{{$view_params['this_year']}}" min="1990" max="{{$view_params['this_year']}}" required>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="area">방 면적 (m<sup>2</sup>)</label>
                                <input type="number" class="form-control" name="area" placeholder="15~50" min="15" max="50" required>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="floors">층수</label>
                                <input type="number" class="form-control" name="floors" placeholder="1~15" min="1" max="15" required>
                            </div>

                        </div>

                        <!-- <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="separ_toilet" name="separ_toilet">
                                <label class="form-check-label" for="separ_toilet">
                                    화장실 별도
                                </label>
                            </div>
                        </div> -->

                        <input type='submit' id="btn" class="btn btn-primary" value="예상 집 값">
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function($) {
        $(document).on('submit', '#submit-form', function(event) {
            event.preventDefault();
            $('#btn').prop('disabled', true);
            var address = $('select[name=address]').val();
            var dis_to_station = $('input[name=dis_to_station]').val();
            var year_of_cons = $('input[name=year_of_cons]').val();
            var floors = $('input[name=floors]').val();
            var area = $('input[name=area]').val();
            var _token = $('input[name=_token]').val();

            var form = new FormData();
            form.append("dis_to_station", dis_to_station);
            form.append("year_of_cons", year_of_cons);
            form.append("floors", floors);
            form.append("area", area);
            form.append("address", address);

            var settings = {
                "url": "http://localhost:8200/predict/house",
                "method": "POST",
                "timeout": 0,
                "processData": false,
                "mimeType": "multipart/form-data",
                "contentType": false,
                "data": form,
                "headers": {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            };

            $.ajax(settings).done(function (response) {
                alert(response);
                $('#btn').prop('disabled', false);
            });
        });
    });

</script>
@endsection