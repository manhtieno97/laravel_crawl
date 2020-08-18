<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Crawl\FanpageFields;
use App\Posts;
class CrawlFbController extends Controller
{
	const URL_FACEBOOK = 'https://graph.facebook.com/';
	const TIMEOUT = 60;
    const VERSION = "v8.0/";
    const LIMIT = 10;
    const METHOD = 'GET';
	public function __construct()
    {
        $this->client = new Client();
    }
    public function index(){
    	return view('crawlfb');
    }
    public function crawlfb(Request $request){

        $this->validate($request, [
                    'fanpage' => 'required',
                    'access_token' => 'required',
                ]);
        $body = $this->getBody($request->fanpage, $request->access_token , $request->limit , $request->timeout);
        $image = [];
        foreach ($body->data as $key => $value) {
            if( !Posts::where('id_post', $value->id)->first() && !empty($value->message))
            {
                $data['title'] = $value->message;
                $data['id_post'] = $value->id;
                foreach ($value->attachments->data as $key1 => $img) {
                    $image[] = $img->media->image->src;
                }
                $data['image'] = json_encode($image);
                Posts::create($data);
            }
        }
        return view('crawlfb',$request);
    }
    // set giới hạn và time out
    protected function setLimitAndTimeOut($limit = null, $timeout = null){
        if(empty($limit) && empty($timeout))
        {
            $limit = self::LIMIT;
            $timeout = self::TIMEOUT;
        }
        return array(
            'limit' => $limit,
            'timeout' => $timeout,
        );
    }
    // lấy chi tiết bài viết
    protected function getBody( $fanpage, $access_token,$limit = null, $timeout = null){
        $id_fanpage = $this->getId($fanpage,$access_token);

        $limitAndTimeOut = $this->setLimitAndTimeOut($limit , $timeout);
        $url = self::URL_FACEBOOK.self::VERSION . $id_fanpage . '/posts';
        $params = $this->setParams($limitAndTimeOut['limit']);
        $rawResponse = $this->getdata(self::METHOD, $url,$limitAndTimeOut['timeout'], $params, $access_token);
 
        $bodyData = \GuzzleHttp\json_decode($rawResponse->getBody());
        return $bodyData;
    }
    // thực hiện request lấy dữ liệu bài biết trên page
    protected function getdata($method, $url, $timeout, $params, $access_token){
    	$response = $this->client->request($method, $url,[
                "timeout" => $timeout,
                "query" => array_merge($params,[
                    'access_token' => $access_token
                ])
            ]);
    	return $response;
    }
    //lấy id của page facebook
    protected function getId($url, $access_token){
    	if (!empty($url)) {
		     $id_fanpage = $this->client->get('https://graph.facebook.com/?id=' . $url . '&access_token=' . $access_token);
		     $id_fanpage = \GuzzleHttp\json_decode($id_fanpage->getBody());
		     return $id_fanpage->id;
  		}
    }

    protected function setParams($limit = null) {
        if(!empty($limit)){
            $params = [
                'fields' => (new FanpageFields())->getOptionsStr(),
                'limit' => $limit,
            ];
        }else{
            $params = [
                'fields' => (new FanpageFields())->getOptionsStr(),
                'limit' => 100,
            ];
        }
        return $params;
    }
}
