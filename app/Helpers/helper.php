<?php 

use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Cookie\SessionCookieJar;

if ( ! function_exists('assets_url'))
{
	/**
	* Get the URL to an asset
	*
	* @param string $path
	* @param bool $secure
	* @return string
	*/
	function assets_url($asset)
	{
	return asset('assets/' . ltrim($asset, '/'));
	}
}



if ( ! function_exists('htmlDecode'))
{

	function htmlDecode($value)
	{
		$description=$value;
		//$value = htmlspecialchars($value, ENT_QUOTES,'ISO-8859-1', true);
		//$description = html_entity_decode($value,ENT_QUOTES,'UTF-8');
		
		return HTML::decode($description);
		
	}
}

function redirect_now($url,$session_name=false,$msg=false, $code = 302)
{
	$url = route($url);

    try {
        \App::abort($code, '', ['Location' => $url]);
    } catch (\Exception $exception) {
        // the blade compiler catches exceptions and rethrows them
        // as ErrorExceptions :(
        //
        // also the __toString() magic method cannot throw exceptions
        // in that case also we need to manually call the exception
        // handler
        $previousErrorHandler = set_exception_handler(function () {
        });
        restore_error_handler();
        call_user_func($previousErrorHandler, $exception);
        die;
    }
}

/*if ( ! function_exists('curl'))
{

	function curl($method,$value)
	{
		$api_path = '';

		//$cookieJar = new SessionCookieJar('SESSION_STORAGE', true);
		//$cookieJar = ['PHPSESSID' => ]session()->getId();
		//dd($cookieJar);
		//$api_url = 'http://localhost:8080';
		$api_url = 'http://103.58.101.227:8080';
		//$api_url = 'http://192.168.43.234:8080';
		//$api_url = 'http://10.6.226.200:10008';
		//$api_url = 'http://10.6.226.31:10008';
		//$api_url = 'http://10.1.15.183:8080';
		$curl = new Client(['base_uri' => $api_url,'timeout'  => 15.0,'http_errors' => false,'cookies'=>Session::get('cookieJar'),'headers' => ['Accept' => 'application/json']]);

		try{
			$res = $curl->request('POST', $api_path.$method, [
				'headers' => ['Content-Type' => 'application/json', 'Accept' => 'application/json'],
				'body'    => $value,
				'http_errors' => false,
				'cookies'=>Session::get('cookieJar')

	        ]);
			
	        $status = $res->getStatusCode();

	        if($status==200){
				$res = json_decode((string)$res->getBody());
			}else if($status==403){

				$res = json_decode((string)$res->getBody());
			}else{
		        // The server responded with some error. You can throw back your exception
		        // to the calling function or decide to handle it here

		        throw new \Exception('Failed');
		    }

		}catch (\GuzzleHttp\Exception\ConnectException $e) {
		    //Catch the guzzle connection errors over here.These errors are something 
		    // like the connection failed or some other network error
			//$msg['message']=$e->getMessage();
			$res = new stdClass();
		    $res ->message = $e->getMessage();
		}

		
		return $res;

	}
}*/



if ( ! function_exists('set_activity'))
{
	/**
	* Get the URL to an asset
	*
	* @param string $path
	* @param bool $secure
	* @return string
	*/
	function set_activity($action,$description,$details)
	{
		$user = Settings::getCurrentUser();
		/*$log = Regulus\ActivityLog\Models\Activity::log([
            'contentId'   => $user->id,
            'contentType' => $user->username,
            'action'      => $action,
            'description' => $description,
            'details'     => $details
        ]);

        return $log;*/
		
	}
}

if( ! function_exists('cutWord'))
{
	function cutWord($string, $your_desired_width) {
	  $parts = preg_split('/([\s\n\r]+)/', $string, null, PREG_SPLIT_DELIM_CAPTURE);
	  $parts_count = count($parts);

	  $length = 0;
	  $last_part = 0;
	  for (; $last_part < $parts_count; ++$last_part) {
	    $length += strlen($parts[$last_part]);
	    if ($length > $your_desired_width) { break; }
	  }

	  return implode(array_slice($parts, 0, $last_part));
	}
}

if( ! function_exists('check_in_array'))
{
	function check_in_array($val,$array){
		if (in_array($val, $array))
		{
		  return true;
		}
		else
		{
		  return false;
		}
	}
}

if( ! function_exists('getViewFolder'))
{
	function getViewFolder()
	{
		if(env('APP_TYPE')=='bank'){
	  		$viewurl = 'bank-line.';
	  	}else{
	  		$viewurl = 'front-line.';
	  	}
		return $viewurl;
	}
}

if( ! function_exists('dateFormat'))
{
	function dateFormat($date,$format)
	{
		return Carbon\Carbon::createFromFormat('d/m/Y H:i:s', $date)->format($format);
	}
}

if( ! function_exists('image_url'))
{
	function image_url($url)
	{
		return URL::to('/').'/files/'.$url;
	}
}

if ( ! function_exists('assets_img'))
{
	/**
	* Get the URL to an asset
	*
	* @param string $path
	* @param bool $secure
	* @return string
	*/
	function assets_img($url,$width=null,$height=null)
	{
		$url = URL::to('/').'/assets/img/'.$url;

		if($width!=null || $height!=null){
			$url .= '?';
			
			if($width!=null){
				$url.='&width='.$width;
			}
			if($height!=null){
				$url.='&height='.$height;
			}
		}
		
		return $url;
	}
}


?>