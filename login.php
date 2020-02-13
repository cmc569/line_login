<?php
@session_start() ;

require_once 'loginSet.php' ;

// if ($_POST['acc']) {
    $url = 'https://access.line.me/oauth2/v2.1/authorize?' ;
    $url .= 'response_type=code' ;
    $url .= '&client_id='.$client_id ;
    $url .= '&redirect_uri=https://linebotclient.azurewebsites.net/line/login/result.php' ;
    $url .= '&state='.uniqid() ;
	$url .= '&scope=openid%20profile%20email' ;
    // $url .= '&bot_prompt=normal' ;
    $url .= '&bot_prompt=aggressive' ;
    
    header('location: '.$url) ;
    exit ;
// }

?>


<!DOCTYPE html>
<html>
<head>
    <title>Line Login</title>
    <meta charset="utf-8">
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport">
    <script>
    function cancel() {
        alert("進行登入流程...") ;
    }
    </script>
	<style>
		.lineBtn {
			width: 303px;
			height: 88px;
			cursor: pointer;
			background-image:url(images/DeskTop/2x/44dp/btn_login_base.png) ;
		}
		.lineBtn:active {
			background-image:url(images/DeskTop/2x/44dp/btn_login_press.png) ;
		}
        
        button {
            padding: 10px;
            width: 100px;
        }
	</style>
</head>
<body>
<form method="POST">
    <div>
    請輸入帳號：<input type="text" name="acc" style="width:95%;">
    </div>

    <div>
    請輸入密碼：<input type="password" name="pwd" style="width:95%;">
    </div>
    <div style="margin-top:20px;">
        <center><input type="submit" onclick="cancel" value="　登入　"></center>
    </div>
</form>
</body>
</html>


