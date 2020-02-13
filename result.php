<?php
// print_r($_REQUEST) ;
@session_start() ;

require_once 'loginSet.php' ;

$error = $_GET['error'] ;

$code = $_GET['code'] ;
$state = $_GET['state'] ;
$access_token = $_GET['access_token'] ;
$tag = $_GET['acc'] ;

// print_r($_GET) ; exit ;
//
$authUrl = 'https://linebotclient.azurewebsites.net/line/login/result.php' ;

if ($code) {
	//get token
    $header = array (
        'Content-Type: application/x-www-form-urlencoded',
    ) ;

	$post_data = array (
		'grant_type' => 'authorization_code',
		'client_id' => $client_id,
		'client_secret' => $client_secret,
		'code' => $code,
		'redirect_uri' => $authUrl
	) ;

	$url = 'https://api.line.me/oauth2/v2.1/token' ;

	$ch = curl_init($url) ;
	curl_setopt($ch, CURLOPT_POST, true) ;
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST') ;
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true) ;
	curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post_data)) ;
	curl_setopt($ch, CURLOPT_HTTPHEADER,$header) ;

	$result = curl_exec($ch) ;
	$returnCode = curl_getinfo($ch, CURLINFO_HTTP_CODE) ;
	$returnCode = curl_getinfo($ch) ;
	curl_close($ch);
	
	$arr = json_decode($result, true) ;
	// echo '<pre>'."\n" ;
	// print_r($arr) ;
	// exit ;
    
    $aToken = $arr['access_token'] ;
    $_SESSION['aToken'] = $aToken ;
        
    $jwt = explode('.', $arr['id_token']) ;
    $json = base64_decode($jwt[1]) ;
    
    unset($arr) ;
    $arr = json_decode($json, true) ;
    $email = $arr['email'] ;
    echo 'email = '.$email ;
    // echo 'aToken='.$aToken ; 
    $url = 'https://api.line.me/v2/profile' ;

    $opts = array(
        'http' => array(
            'header' => "Authorization: Bearer ".$aToken."\r\n",
        )
     );

     $context = stream_context_create($opts) ;
     
     $res = file_get_contents($url, false, $context) ;
     echo'<pre>'."<br>\n" ;
    print_r($res) ;
    
    exit ;
    
    
    
    // $json = shell_exec('curl -v -X GET https://api.line.me/v2/profile -H "Authorization: Bearer '.$aToken.'"') ;
    // print_r($json) ;
    
    // $profile = json_decode($json, true) ;
    
}
?>

