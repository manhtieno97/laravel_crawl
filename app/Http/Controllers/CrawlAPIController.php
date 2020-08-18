<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Facebook;
use FacebookRequest;
class CrawlAPIController extends Controller
{
    public function index(Request $request))
    {
    	$fb = new Facebook\Facebook([
          'app_id' => '3001921703269622',
          'app_secret' => '5c3fe69ada78de7da73720dac9d855c8',
          'default_graph_version' => 'v2.3',
          // . . .
          ]);
        


    	$url_fanpage=$request->get('id_fanpage');
    	$access_token=$request->get('access_token');
    	$id_fanpage=$this->getId($url_fanpage,$access_token);
    	$url=self::URL_FACEBOOK.$id_fanpage.'/feed';
    	$params=[
    		'fields' => (new FanpageFields())->getOptionsStr(),
            'limit' => 50,
    	];
        $data=$fb->request('GET',$url,$params,$access_token);
        dd($data->getUrlEncodedBody());die();


    	$rawResponse=$this->getdata('GET',$url,self::TIMEOUT,$params,$access_token);
 		$body=\GuzzleHttp\json_decode($rawResponse->getBody());
        
        return view('crawlfb',compact('body'));
    }
}
