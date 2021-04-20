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
	    // $contents = json_encode($request->get('contents'));
        $view_params = [];
        $view_params['this_year'] = date("Y");
	    
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://localhost:8201/predict/",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "UTF-8",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            // CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/x-www-form-urlencoded",
                "cache-control: no-cache"
            ),
        ));

        curl_setopt($curl, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4 );        
        // $response = json_decode(curl_exec($curl));
        $response = curl_exec($curl);

        if(!isset($response)){
            $view_params['test'] =  "통신 실패";
            return view('index', compact('view_params'));
        } else {
            $view_params['test'] =  "통신 성공";
        }

        return view('index', compact('view_params'));
    }

    public function bot()
    {
        $view_params = [];
        $view_params['test'] = "";
        $view_params['this_year'] = date("Y");

        return view('bot', compact('view_params'));
    }
}
