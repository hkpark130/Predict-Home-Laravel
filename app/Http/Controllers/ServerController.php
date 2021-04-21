<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServerController extends Controller
{
    public function index()
    {
        $view_params = [];
        $view_params['test'] = "";
        $view_params['this_year'] = date("Y");

        return view('index', compact('view_params'));
    }

    public function house(Request $request)
    {
        $address = $request->get('address');
	    $dis_to_station = $request->get('dis_to_station');
        $year_of_cons = $request->get('year_of_cons');
        $area = $request->get('area');
        $floors = $request->get('floors');
        // $separ_toilet = is_null($request->get('separ_toilet')) ? '0' : '1';
        // 크롤링한 데이터가 다 "화장실 별도" 라서 의미가 없음

        $curl = curl_init();
        $data = json_encode(array(
                    "dis_to_station"=>$dis_to_station,
                    "year_of_cons"=>$year_of_cons,
                    "floors"=>$floors,
                    "separ_toilet"=>0,
                    "area"=>$area,
                    "address"=>$address
                ));
                
        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://localhost:8201/predict/house/",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "UTF-8",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            // CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/x-www-form-urlencoded",
                "cache-control: no-cache",
                "data: $data"
            )
        ));

        curl_setopt($curl, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4 );
        $response = curl_exec($curl);

        if(!isset($response)){
            $response =  "통신 실패";
        }

        return $response;
    }

    public function bot()
    {
        $view_params = [];

        return view('bot', compact('view_params'));
    }
}
