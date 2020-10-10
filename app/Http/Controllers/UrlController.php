<?php

namespace App\Http\Controllers;

use App\Url;
use Illuminate\Http\Request;
use App\Http\Traits\UrlTrait;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class UrlController extends Controller
{
    use UrlTrait;

    public function index(){
        return response()->json(Url::all(),200);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'url' => 'required|active_url|unique:urls,origin_url',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()
            ], 400);
        }

        $url = UrlTrait::createUrl($request->url);

        return response()->json($url->short_full_url,200);    
    }

    public function show($url){
        $urlRedirect = Url::where('short_url', strtolower($url))->get()->last();

        if($urlRedirect){
            //incremente number hit URL to stats
            $urlRedirect->hits += 1;
            $urlRedirect->save();

            $url = $urlRedirect->origin_url;
            return Redirect::to($url);
        }
        else{
            return view('404');
        }
    }

    public function delete($url){
        $urlRedirect = Url::where('short_url', strtolower($url))->get()->last();

        if($urlRedirect){
            $urlRedirect->delete();
         
            return  response()->json('URL DELETED',200);
        }
        else{
            return  response()->json('URL NOT FOUND',404);
        }
    }

    public function stats(){
        $urls = Url::select('hits', 'origin_url')->get();
        $dataSets = array();
        foreach($urls as $url){
            $dataToSend =  [
                "label" => $url->origin_url,
                'backgroundColor' => ['rgba('.rand ( 0 , 255 ).','.rand ( 0 , 255 ).', '.rand ( 0 , 255 ).', 0.5)'],
                'data' => [$url->hits]
            ];
            array_push($dataSets, $dataToSend);
        }       

        $chartjs = app()->chartjs
                ->name('barChartTest')
                ->type('bar')
                ->size(['width' => 400, 'height' => 200])
                ->labels(['urls'])
                ->datasets($dataSets)
                ->options([]);

        return view('stats', compact('chartjs'));
    }
}
