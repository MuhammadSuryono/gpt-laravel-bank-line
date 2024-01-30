<?php

namespace App\Http\Controllers;

use App;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Config;
use URL;
use Session;
use Input;
use GuzzleHttp\Client;
use GuzzleHttp\Cookie\SessionCookieJar;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;
use File;
use Validator;
use Redirect;


class HomeController extends Controller {
	var $curl;
	var $cookieJar;
	var $api_path;
	//var $jar;



	public function __construct() {
		error_reporting(0);
		ini_set('display_errors', 0);
//		$api_url = 'http://125.213.130.223:9000';
		 $api_url2 = 'http://localhost:8005';

		$this->jar = new \GuzzleHttp\Cookie\CookieJar();
		$this->api_path = 'bank/';
        $this->curl = new Client(['base_uri' => $api_url2,'timeout'  => 15.0,'cookies'=>Session::get('cookieJar'),'headers' => ['Accept' => 'application/json']]);
        // $this->curl2 = new Client(['base_uri' => $api_url2,'timeout'  => 15.0,'cookies'=>Session::get('cookieJar'),'headers' => ['Accept' => 'application/json']]);

    }

	public function index(Request $request)
	{

		$this->deleteCookies();
		Session::forget('cookieJar');
		//throw new \Exception('Failed');
		if($request->input('error')!=null){
			Session::flash('message',$request->input('error'));
		}else{
			Session::forget('message');
		}

		if(Session::has('userId')){
	    	return redirect()->route('dashboard');
	  	}
	  	if(env('APP_TYPE')=='bank'){
	  		return view('pages.login_bank');
	  	}else{
	  		return view('pages.login');
	  	}

	}

	public function deleteCookies(){
		if (isset($_SERVER['HTTP_COOKIE'])) {
			$cookies = explode(';', $_SERVER['HTTP_COOKIE']);
			// foreach($cookies as $cookie) {
			// 	$parts = explode('=', $cookie);
			// 	$name = trim($parts[0]);
			// 	setcookie($name, '', time()-1000);
			// 	setcookie($name, '', time()-1000, '/');
			// }
            foreach($cookies as $cookie) {
                $parts = explode('=', $cookie);
                $name = trim($parts[0]);
                if (isset($_COOKIE[$name])) {
                    //unset($_COOKIE[$name]);
                    // \Cookie::queue(\Cookie::forget($name));
                    // setcookie($name, null, time() -3600, '/');
                    setcookie($name, '', time()-1000);
				    setcookie($name, '', time()-1000, '/');
                }
            }
		}
	}

	public function dashboard()
	{
		$login_item['loginId'] = Session::get('userId');
		$login_item['passwd'] = Session::get('userPass');

		try{
		$res_tree = $this->curl->request('POST', $this->api_path.'getProfiles', [
				'headers' => ['Content-Type' => 'application/json', 'Accept' => 'application/json'],
				'body'    => '{"loginId":"' . $login_item['loginId'] . '", "passwd":"' . $login_item['passwd'] . '"}',
				'http_errors' => false,
				'cookies'=>Session::get('cookieJar')
		]);

		}catch (\GuzzleHttp\Exception\ConnectException $e) {
			Session::forget('userId');
			Session::forget('userPass');
			Session::forget('cookieJar');
			$this->deleteCookies();
			return redirect()->back()->withErrors('No network connection or cannot reach server.');
		}

		$msg = json_decode($res_tree->getBody());
		if(isset($msg->status)){
			if($msg->status=='403'){
				Session::forget('userId');
				Session::forget('userPass');
				Session::forget('cookieJar');
				$this->deleteCookies();
				Session::flush();
				return redirect()->route('login')->withErrors('Forbidden Access. Please Try Again.');
			}
		}
		$userName = Session::get('loginUsername');
		if(!isset($userName)){
			echo 'Cannot connect to Server. Please check your connection.';
			exit;
		};
		$data['user_name'] = $userName;
		//dd($msg->loginMenuTree);
		//dd($res);
		if(isset($msg->loginMenuTree)){
			$data['menu'] = $msg->loginMenuTree;
			return view('pages.home',$data);
		}
		//dd($res);

	}

	public function getDashboardContent()
	{
		$login_item['loginId'] = Session::get('userId');
		$login_item['passwd'] = Session::get('userPass');
		$activity_param = [
			"action"=>"SEARCH",
			"loginId"=>$login_item['loginId'],
			"currentPage"=>"1",
			"pageSize"=>"10",
			"orderBy"=>[
				"activityDate"=>"DESC",
			],
		];
		$userName = Session::get('loginUsername');
		$lastLoginDate = Session::get('lastLoginDate');
		//$activity_res = curl($this->api_path.'MNU_GPCASH_LOG_ACTV/getActivityByUser',json_encode($activity_param));
		$activity_res = $this->curl->request('POST', $this->api_path.'MNU_GPCASH_LOG_ACTV/getActivityByUser', [
				'headers' => ['Content-Type' => 'application/json', 'Accept' => 'application/json'],
				'body'    => json_encode($activity_param),
				'timeout' => 15.0,
				'cookies' => Session::get('cookieJar'),
				'http_errors' => false
		]);

		$activity_res = json_decode($activity_res->getBody());
		//dd($activity_res);

		$data['last_activity'] = $activity_res->result;
		$data['total_activity'] = $activity_res->totalRecord;
		//$res = curl('login','{"loginId":"'.$login_item['loginId'].'", "passwd":"'.$login_item['passwd'].'"}');
		$data['user_name'] =$userName;
		$data['user_last_login'] = $lastLoginDate;
		//dd($data);
		return view('pages.view.dashboard',$data);
	}

	public function postLogin(Request $request){
		//dd($this->curl);
		$login_item['loginId'] = $request->input('loginId');
		$login_item['passwd'] = $request->input('passwd');
		$login_item['key'] = $request->input('key');

		$validator = Validator::make($login_item, [
            'loginId' => 'required',
            'passwd' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('/')
                        ->withErrors($validator)
                        ->withInput();
        }
		$request->session()->regenerate();

        //$res = curl('login','{"loginId":"'.$login_item['loginId'].'", "passwd":"'.$login_item['passwd'].'"}');
		try{
		$res = $this->curl->request('POST', $this->api_path.'login', [
				'headers' => ['Content-Type' => 'application/json', 'Accept' => 'application/json'],
				'body'    => '{"loginId":"'.$login_item['loginId'].'", "passwd":"'.$login_item['passwd'].'","key":"'.$login_item['key'].'"}',
				'timeout' => 15.0,
				'cookies' => $this->jar,
				'http_errors' => false
		]);
		}catch (\GuzzleHttp\Exception\ConnectException $e) {
			Session::forget('userId');
			Session::forget('userPass');
			$this->deleteCookies();
			return redirect()->back()->withErrors('No network connection or cannot reach server.');
		}
		//dd($this->jar);
		$status = $res->getStatusCode();
		$res = json_decode($res->getBody());
		//dd($this->curl);


        if($status=='200'){
			Session::put('cookieJar', $this->jar);
			Session::put('lastLoginDate', $res->lastLoginDate);
			Session::put('loginUsername', $res->loginUsername);
        	Session::put('userId', $login_item['loginId']);
			Session::put('userPass', $login_item['passwd']);
        	return redirect()->route('dashboard');
        }else{
        	Session::forget('userId');
			Session::forget('userPass');
			$this->deleteCookies();
			if(strpos($res->message, 'GPT-0100141') !== false || strpos($res->message, 'GPT-0100140') !== false) {
				return redirect()->back()->withErrors($res->message)->withInput()->with('login_id', $login_item['loginId']);
			}else{
				return redirect()->back()->withErrors($res->message);
			}
        }
	}


    public function fetchDataTable(Request $request){
        $data = array();
        $action = $request->input('action');
        $value = $request->input('value');
        $draw = $request->input('draw');
        $order = $request->input('order');
        $custom_order = $request->input('custom_order');
        $columns = $request->input('columns');
        foreach ($value as $key => $row) {
            if (is_null($row)) {
                $value[$key] = "";
            }
        }
        $start = $request->input('start');
        $length = $request->input('length');
        $currentPage = ((int)$start/(int)$length)+1;
        $menu = $request->input('menu');
        $orderDir =	strtoupper($order[0]['dir']);
        $orderColumn =	$columns[(int)$order[0]['column']]['data'];
        //var_dump($columns);
        //exit;
        $url_action = $request->input('url_action');
        $result_key = $request->input('result_key');
        $data = array_merge($value,$data);
        $data['action'] = $action;
        $data['loginId'] = Session::get('userId');
        $data['currentPage'] = $currentPage;
        $data['pageSize'] = $request->input('length');
        $data['orderBy'] = (!empty($custom_order)?$custom_order:array($orderColumn=>$orderDir));
        $json = json_encode($data);
        //var_dump($json);
        //exit;
        //$res = curl($this->api_path.$menu.'/'.$url_action,$json);
		try {
			$res = $this->curl->request('POST', $this->api_path . $menu . '/' . $url_action, [
					'headers' => ['Content-Type' => 'application/json', 'Accept' => 'application/json'],
					'body' => $json,
					'timeout' => 15.0,
					'cookies' => Session::get('cookieJar'),
					'http_errors' => false
			]);
		}catch (\GuzzleHttp\Exception\ConnectException $e) {
			App::abort(500);
			exit;
		}
		//var_dump($res);
		//exit;
		$res = json_decode($res->getBody());

		if(isset($res->status)){
			if($res->status=='403'){
				Session::forget('userId');
				Session::forget('userPass');
				Session::forget('cookieJar');
				$this->deleteCookies();
				Session::flush();
				return redirect()->route('login')->withErrors('Forbidden Access. Please Try Again.');
			}
		}
        $res->recordsTotal = $res->totalRecord;
        $res->recordsFiltered = $res->totalRecord;
        $res->draw=$draw;
        /*foreach($res->{$result_key} as $row){
            $content = array();
            foreach ($row as $value){
               $content[] = $value;
            }
            $result[] = $content;
        }*/
        $res->data=$res->{$result_key};
        unset($res->totalRecord);
        unset($res->totalPage);
        unset($res->{$result_key});
        echo(json_encode($res));
        //var_dump(json_encode($res));
    }

	public function postAdd(Request $request){
		$data = array();
        $url_action = 'submit';
		$value = $request->input('value');
		$menu = $request->input('menu');
		$data = array_merge($value,$data);
		$data['action'] = 'CREATE';
		$data['loginId'] = Session::get('userId');
        if(!empty($request->input('url_action'))){
            $url_action = $request->input('url_action');
        };
		$json = json_encode($data);
		//var_dump($json);
		//exit;
		try{
		$res = $this->curl->request('POST', $this->api_path.$menu.'/'.$url_action, [
				'headers' => ['Content-Type' => 'application/json', 'Accept' => 'application/json'],
				'body'    => $json,
				'timeout' => 15.0,
				'cookies'=>Session::get('cookieJar'),
				'http_errors' => false
		]);
		}catch (\GuzzleHttp\Exception\ConnectException $e) {
			App::abort(500);
			exit;
		}
		$msg = json_decode($res->getBody());
		$result['status'] = $res->getStatusCode();
		$result['message'] = $msg->message;
		if(isset($msg->referenceNo)) {
			$result['referenceNo'] = $msg->referenceNo;
		}
		if(isset($msg->dateTimeInfo)) {
		$result['dateTimeInfo'] = $msg->dateTimeInfo;
		}
		echo json_encode($result);
	}

	public function postEdit(Request $request){
		$data = array();
		$url_action = 'submit';
		$value = $request->input('value');
		$menu = $request->input('menu');
		$data = array_merge($value,$data);
		$data['action'] = 'UPDATE';
		$data['loginId'] = Session::get('userId');
        if(!empty($request->input('url_action'))){
            $url_action = $request->input('url_action');
        };

		$json = json_encode($data);
		//var_dump($json);
		//exit;
		try{
		$res = $this->curl->request('POST', $this->api_path.$menu.'/'.$url_action, [
				'headers' => ['Content-Type' => 'application/json', 'Accept' => 'application/json'],
				'body'    => $json,
				'timeout' => 15.0,
				'cookies'=>Session::get('cookieJar'),
				'http_errors' => false
		]);
		}catch (\GuzzleHttp\Exception\ConnectException $e) {
			App::abort(500);
			exit;
		}
		$msg = json_decode($res->getBody());
		$result['status'] = $res->getStatusCode();
		$result['message'] = $msg->message;
		if(isset($msg->referenceNo)) {
			$result['referenceNo'] = $msg->referenceNo;
		}
		if(isset($msg->dateTimeInfo)) {
			$result['dateTimeInfo'] = $msg->dateTimeInfo;
		}
		echo json_encode($result);
	}

	public function postDelete(Request $request){
		$data = array();
		$value = $request->input('value');
		$menu = $request->input('menu');
		$url_action = $request->input('url_action');
		$data = array_merge($value,$data);
		$data['action'] = 'DELETE';

		$data['loginId'] = Session::get('userId');

		$json = json_encode($data);
		//var_dump($json);
		//exit;
		try{
		$res = $this->curl->request('POST', $this->api_path.$menu.'/'.$url_action, [
				'headers' => ['Content-Type' => 'application/json', 'Accept' => 'application/json'],
				'body'    => $json,
				'timeout' => 15.0,
				'cookies'=>Session::get('cookieJar'),
				'http_errors' => false
		]);
		}catch (\GuzzleHttp\Exception\ConnectException $e) {
			App::abort(500);
			exit;
		}
		$msg = json_decode($res->getBody());
		$result['status'] = $res->getStatusCode();
		$result['message'] = $msg->message;
		if(isset($msg->referenceNo)) {
			$result['referenceNo'] = $msg->referenceNo;
		}
		if(isset($msg->dateTimeInfo)) {
			$result['dateTimeInfo'] = $msg->dateTimeInfo;
		}
		echo json_encode($result);
	}

	public function postDetail(Request $request){
		$data = array();
		$value = $request->input('value');
		foreach ($value as $key => $row) {
			if (is_null($row)) {
				$value[$key] = "";
			}
		}
		$menu = $request->input('menu');
		$url_action = $request->input('url_action');
		$action = $request->input('action');
		$data = array_merge($value,$data);
		$data['action'] = $action;
		$data['loginId'] = Session::get('userId');
		$json = json_encode($data);
		try{
		$res = $this->curl->request('POST', $this->api_path.$menu.'/'.$url_action, [
				'headers' => ['Content-Type' => 'application/json', 'Accept' => 'application/json'],
				'body'    => $json,
				'timeout' => 15.0,
				'cookies'=>Session::get('cookieJar'),
				'http_errors' => false

		]);
		}catch (\GuzzleHttp\Exception\ConnectException $e) {
			App::abort(500);
			exit;
		}
		$msg = json_decode($res->getBody());
		$result['status'] = $res->getStatusCode();
		if(isset($msg->result[0]->referenceNo)){
			echo json_encode($msg);
			exit;
		}
		if(isset($msg->message)) {
			$result['message'] = $msg->message;
		}
		if(isset($msg->dateTimeInfo)) {
			$result['dateTimeInfo'] = $msg->dateTimeInfo;
		}
		echo json_encode($result);
	}

	public function postDetail2(Request $request){
		$data = array();
		$value = $request->input('value');
		foreach ($value as $key => $row) {
			if (is_null($row)) {
				$value[$key] = "";
			}
		}
		$menu = $request->input('menu');
		$url_action = $request->input('url_action');
		$action = $request->input('action');
		$data = array_merge($value,$data);
		$data['action'] = $action;
		$data['loginId'] = Session::get('userId');
		$json = json_encode($data);
		try{
		$res = $this->curl2->request('POST', $this->api_path.$menu.'/'.$url_action, [
				'headers' => ['Content-Type' => 'application/json', 'Accept' => 'application/json'],
				'body'    => $json,
				'timeout' => 15.0,
				'cookies'=>Session::get('cookieJar'),
				'http_errors' => false

		]);
		}catch (\GuzzleHttp\Exception\ConnectException $e) {
			App::abort(500);
			exit;
		}
		$msg = json_decode($res->getBody());
		$result['status'] = $res->getStatusCode();
		if(isset($msg->result[0]->referenceNo)){
			echo json_encode($msg);
			exit;
		}
		if(isset($msg->message)) {
			$result['message'] = $msg->message;
		}
		if(isset($msg->dateTimeInfo)) {
			$result['dateTimeInfo'] = $msg->dateTimeInfo;
		}
		echo json_encode($result);
	}

	public function logout(){
		$data = array();
		$data['logout'] = 1;
		$body = json_encode($data);
		try{
		$res = $this->curl->request('POST', $this->api_path.'/logout', [
				'headers' => ['Content-Type' => 'application/json', 'Accept' => 'application/json'],
				'timeout' => 10.0,
				'body' => $body,
				'cookies'=>Session::get('cookieJar'),
				'http_errors' => false

		]);
		}catch (\GuzzleHttp\Exception\ConnectException $e) {
			App::abort(500);
			exit;
		}
		$msg = json_decode($res->getBody());
		//$status = $res->getStatusCode();

		if($msg->message=='success'){
		Session::forget('userId');
		Session::forget('userPass');
		Session::forget('cookieJar');
		$this->deleteCookies();
		Session::flush();
		return redirect()->route('login');
		}else{
			Session::forget('userId');
			Session::forget('userPass');
			Session::forget('cookieJar');
			$this->deleteCookies();
			Session::flush();
			return redirect()->route('login');
		}
	}

	public static function getViewURL(){
		/*if(env('APP_TYPE')=='bank'){
	  		$viewurl = 'bank-line.';
	  	}else{
	  		$viewurl = 'front-line.';
	  	}*/

	  	return 'bank-line.';
	}

	public static function getView(Request $request){

		//$view = getViewFolder().$request->input('parent').'.'.$request->input('menu').'.'.$request->input('action');
		$view = getViewFolder();

		if($request->input('service')){
			$view .= $request->input('service');
			$view .= '.';
		}
		if($request->input('action')){
			$view .= $request->input('action');

		}

		$data['menu'] = $request->input('menu');
		$data['type'] = '';
		if($request->input('action')!='landing'){
			$data['type'] = $request->input('action');
		}

		$data['service'] = $request->input('service');
		//var_dump($view);

		return view($view,$data);
		// SOME CODE

	}

	public static function getTrxStatusDetailView(Request $request){

		$menuCode = $request->input('value');
		$returnView = '';

		$returnView = 'bank-line.MNU_GPCASH_BO_RPT_TRX_STS.partial.'.$menuCode;
		/*if($menuCode == 'MNU_GPCASH_F_FUND_DOMESTIC'){
			$returnView = 'bank-line.MNU_GPCASH_BO_RPT_TRX_STS.partial.MNU_GPCASH_F_FUND_DOMESTIC';
		} else if ($menuCode == 'MNU_GPCASH_F_FUND_INHOUSE') {
			$returnView = 'bank-line.MNU_GPCASH_BO_RPT_TRX_STS.partial.MNU_GPCASH_F_FUND_INHOUSE';
		} else if ($menuCode == 'MNU_GPCASH_F_BILL_PAYMENT') {
			$returnView = 'bank-line.MNU_GPCASH_BO_RPT_TRX_STS.partial.MNU_GPCASH_F_BILL_PAYMENT';
		} else if ($menuCode == 'MNU_GPCASH_F_FUND_BENEFICIARY') {
			$returnView = 'bank-line.MNU_GPCASH_BO_RPT_TRX_STS.partial.MNU_GPCASH_F_FUND_BENEFICIARY';
		} else if ($menuCode == 'MNU_GPCASH_F_LIQ_SWEEP_IN'){
			$returnView = 'bank-line.MNU_GPCASH_BO_RPT_TRX_STS.partial.MNU_GPCASH_F_LIQ_SWEEP_IN';
		} else if ($menuCode == 'MNU_GPCASH_F_LIQ_SWEEP_OUT'){
			$returnView = 'bank-line.MNU_GPCASH_BO_RPT_TRX_STS.partial.MNU_GPCASH_F_LIQ_SWEEP_OUT';
		} else if ($menuCode == 'MNU_GPCASH_F_MASS_FUND_PAYROLL'){
			$returnView = 'bank-line.MNU_GPCASH_BO_RPT_TRX_STS.partial.MNU_GPCASH_F_MASS_FUND_PAYROLL';
		} else {
			$returnView = 'bank-line.MNU_GPCASH_BO_RPT_TRX_STS.partial.EXECUTE';
		}*/


		$data['service'] = $request->input('service');

		return view($returnView, $data);

	}

	public function downloadFile(Request $request){

		$menu = $request->input('service'); //Input::get('service');
        $url_action = $request->input('url_action'); //Input::get('url_action');

        $data = array();
		$data['loginId'] = Session::get('userId');
		$json = json_encode($data);

		try {

			/*$res = $this->curl->request('GET', $this->api_path.$menu.'/'.$url_action, [
					'headers' => ['Content-Type' => 'application/json', 'Accept' => 'application/json'],
					'body' => $json,
					'xhrFields' => ['withCredentials' => true, 'responseType' => 'arraybuffer'],
					'timeout' => 60000,
					'cookies' => Session::get('cookieJar'),
					'http_errors' => false
			]);*/
			$res = $this->curl->request('GET', $this->api_path.$menu.'/'.$url_action, [
					'headers' => ['Content-Type' => 'application/octet-stream', 'Accept' => 'application/octet-stream'],
					'body' => $json,
					'xhrFields' => ['withCredentials' => true, 'responseType' => 'arraybuffer'],
					'timeout' => 60000,
					'cookies' => Session::get('cookieJar'),
					'http_errors' => false
			]);
		}catch (\GuzzleHttp\Exception\ConnectException $e) {
			App::abort(500);
			exit;
		}
		//var_dump($res->getHeader('Content-Disposition')[0]);
		//exit;
		$file_name = str_replace("attachment;filename=","",$res->getHeader('Content-Disposition')[0]);
		//var_dump($res->getBody()->getContents());

		$msg = (string)$res->getBody();



		/*if(isset($msg->message)) {
			$result['status'] = $res->getStatusCode();
			$result['message'] = $msg->message;
		}else{
			$result = $msg;
			$result->status = $res->getStatusCode();
		}

		echo json_encode($result);*/
		//echo $msg;
		$path = storage_path('app/public/'.$file_name);

		file_put_contents($path, $msg);

		if(headers_sent()){
			exit("PDF stream will be corrupted - there is already output from previous code.");
		}

		header('Cache-Control: public, must-revalidate, max-age=0');
		header('Pragma: public');
		header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');
		header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');

		header('Content-Type: application/force-download');
		header('Content-Type: application/octet-stream', false);
		header('Content-Type: application/download', false);

		header('Content-Disposition: attachment; filename="'.basename($path).'";');
		header('Content-Transfer-Encoding: binary');
		header('Content-Length: '.filesize($path));
		header('Content-Type: application/octet-stream', false);

		$file = readfile($path);

		echo $file;
		exit();


	}


	public static function getViewWithURL(Request $request){

		$view = getViewFolder();

		if($request->input('viewURL')){
			$view .= $request->input('viewURL');
		}
		return view($view);
	}

	public static function getEditor(Request $request){
		$view = getViewFolder().$request->input('parent').'.'.$request->input('menu').'.add';
		//dd($view);
		$data['parent'] = $request->input('parent');
		$data['menu'] = $request->input('menu');
		$data['type'] = 'add';
		$data['service'] = $request->input('service');
		return view($view,$data);
		// SOME CODE
		//return view('pages.view.editor.'.$slug);
	}

	public static function getDetail($slug){

		// SOME CODE
		return view('pages.view.detail.'.$slug);
	}

	public function getAPIData(Request $request){
		$data = array();
		$value = $request->input('value');
		if(!empty($value)) {
			foreach ($value as $key => $row) {
				if (is_null($row)) {
					$value[$key] = "";
				}
			}
			$data = array_merge($value,$data);
		}
		$menu = $request->input('menu');
		$url_action = $request->input('url_action');
		$action = $request->input('action');

		$data['action'] = $action;
		$data['loginId'] = Session::get('userId');
		$json = json_encode($data);
		//var_dump($json);
		//exit;
		try
		{
			$res = $this->curl->request('POST',  $this->api_path.$menu.'/'.$url_action, [
					'headers' => ['Content-Type' => 'application/json', 'Accept' => 'application/json'],
					'body'    => $json,
					'timeout' => 15.0,
					'http_errors' => false,
					'cookies'=>Session::get('cookieJar')
			]);

		}catch (\GuzzleHttp\Exception\ConnectException $e) {
			App::abort(500);
			exit;
		}
		$msg = json_decode($res->getBody());
		if(isset($msg->status)){
			if($msg->status=='403'){
				Session::forget('userId');
				Session::forget('userPass');
				Session::forget('cookieJar');
				$this->deleteCookies();
				Session::flush();
				return redirect()->route('login')->withErrors('Forbidden Access. Please Try Again.');
			}
		}
		//dd($msg);
		if(isset($msg->message)) {
			$result['status'] = $res->getStatusCode();
			$result['message'] = $msg->message;

			if(isset($msg->referenceNo)) {
				$result['referenceNo'] = $msg->referenceNo;
			}
			if(isset($msg->dateTimeInfo)) {
				$result['dateTimeInfo'] = $msg->dateTimeInfo;
			}

			//for Cheque Status Menu
			if (isset($msg->statusCode)) {
				$result['statusCode'] = $msg->statusCode;
			}
			if (isset($msg->statusName)) {
				$result['statusName'] = $msg->statusName;
			}

		}else{
			$result = $msg;
			$result->status = $res->getStatusCode();
		}



		echo json_encode($result);

	}

	public function forceChangePassword(Request $request){
		$data = array();
		$value = $request->input('value');
		if(!empty($value)) {
			foreach ($value as $key => $row) {
				if (is_null($row)) {
					$value[$key] = "";
				}
			}
			$data = array_merge($value,$data);
		}
		$menu = $request->input('menu');
		$url_action = $request->input('url_action');
		$action = $request->input('action');

		$data['action'] = $action;

		$json = json_encode($data);
		//var_dump($json);
		//exit;
		try
		{
		$res = $this->curl->request('POST',  $this->api_path.$menu.'/'.$url_action, [
				'headers' => ['Content-Type' => 'application/json', 'Accept' => 'application/json'],
				'body'    => $json,
				'timeout' => 15.0,
				'http_errors' => false,
				'cookies'=>Session::get('cookieJar')
		]);
		}catch (\GuzzleHttp\Exception\ConnectException $e) {
			App::abort(500);
			exit;
		}
		//}
		//catch (RequestException $e)
		//{

		//	App::abort(500, 'Internal Server Error');
		//	return;
		//}
		$msg = json_decode($res->getBody());
		//dd($msg);
		if(isset($msg->message)) {
			$result['status'] = $res->getStatusCode();
			$result['message'] = $msg->message;
		}else{
			$result = $msg;
			$result->status = $res->getStatusCode();
		}

		echo json_encode($result);

	}

	public function heartBeat(Request $request){
		$data = array();
		$data['key'] = '';
		$json = json_encode($data);
		try

		{
			$res = $this->curl->request('POST',  $this->api_path.'/heartBeat', [
					'headers' => ['Content-Type' => 'application/json', 'Accept' => 'application/json'],
					'body'    => $json,
					'timeout' => 15.0,
					'http_errors' => false,
					'cookies'=>Session::get('cookieJar')
			]);
		}catch (\GuzzleHttp\Exception\ConnectException $e) {
			//App::abort(500);
			//exit;
		}

		$msg = json_decode($res->getBody());

		if(isset($msg->message)) {
			$result['status'] = $res->getStatusCode();
			$result['message'] = $msg->message;
		}else{
			$result = $msg;
			$result->status = $res->getStatusCode();
		}

		echo json_encode($result);

	}

	public function uploadFile(Request $request){
		$data = array();
		/*$value = $request->file('data');
		// $request->file->store('logos');
		// error_log("##########################################################" + $value);
		// print_r($value);
		$menu = $request->input('menu');
		$url_action = $request->input('url_action');
		// $data = array_merge($value,$data);
		$data['loginId'] = Session::get('userId');*/
		// $json = json_encode($value);
		$dir ='D:\\GPT\\WorkspaceDevMC\\bankline-dev\\public\\robots.txt';
		$curl_file = curl_file_create($dir);
		// $data['file'] = $curl_file;
		$data['file'] = $curl_file;
		$data['action'] = 'SEARCH';
		$data['menuCode'] = 'MNU_GPCASH_MT_PROMO';
		$json = json_encode($data);

		// $formData = new FormData($request->file);
        // $formData.append("file", form);


		$params = array('file' => $request->file);

		try{
		$res = $this->curl->request('POST', $this->api_path.'MNU_GPCASH_MT_HELPDESK/upload?'. http_build_query($params), [
				'headers' => ['Content-Type' => ''],
				//'headers' => ['Content-Type' => 'application/json', 'Accept' => 'application/json'],
				'body'    => $json,
				'xhrFields' => ['withCredentials' => true],
				'timeout' => 60000,
				'processData' => false, //prevent jQuery from automatically transforming the data into a query string
              	'contentType'=> false,
              	'cache' => false,
              	'enctype' => 'multipart/form-data',
				'cookies'=>Session::get('cookieJar'),
				'http_errors' => false

		]);
		}catch (\GuzzleHttp\Exception\ConnectException $e) {
			App::abort(500);
			exit;
		}
		$msg = json_decode($res->getBody());
		$result['status'] = $res->getStatusCode();
		if(isset($msg->result[0]->referenceNo)){
			echo json_encode($msg);
			exit;
		}
		if(isset($msg->message)) {
			$result['message'] = $msg->message;
		}
		if(isset($msg->dateTimeInfo)) {
			$result['dateTimeInfo'] = $msg->dateTimeInfo;
		}
		echo json_encode($result);
	}

}
