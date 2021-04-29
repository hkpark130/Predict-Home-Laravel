<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\SimpleHttpClient;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Redis;

class ServerController extends Controller
{
    private $api;

    public function index()
    {
        $view_params = [];
        $view_params['this_year'] = date("Y");

        return view('index', compact('view_params'));
    }

    public function house(Request $request)
    {
        $api = new SimpleHttpClient;
        $address = $request->get('address');
	    $dis_to_station = $request->get('dis_to_station');
        $year_of_cons = $request->get('year_of_cons');
        $area = $request->get('area');
        $floors = $request->get('floors');
        // $separ_toilet = is_null($request->get('separ_toilet')) ? '0' : '1';
        // 크롤링한 데이터가 다 "화장실 별도" 라서 의미가 없음
        $md5_key = md5(json_encode($request->all()));

        $param = array(
                    "dis_to_station"=>$dis_to_station,
                    "year_of_cons"=>$year_of_cons,
                    "floors"=>$floors,
                    "separ_toilet"=>0,
                    "area"=>$area,
                    "address"=>$address
                );
        
        try { //캐쉬에 있는지 확인
            $redis_value = Redis::hGetAll($md5_key);

            if(!empty($redis_value)) {
                $response = $redis_value["value"];
            } else{
                $response = $api->apiRequest('GET', '/predict/house/', $param);
            }
            $request->merge(['value' => $response]);
            
        } catch (\Exception $e){
            return response::make(\GuzzleHttp\json_encode(["error_message" => $e->getMessage()]));
        }
        
        // return response::make($response);
        $response = (string)$response ."円";

        return $response;
    }

    public function bot()
    {
        $view_params = [];

        return view('bot', compact('view_params'));
    }
}
