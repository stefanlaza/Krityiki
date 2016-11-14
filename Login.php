<?php
session_name('kritikyi');
session_set_cookie_params(2*7*24*60*60);
session_start();
if (isset($_SESSION['id']) && !isset($_COOKIE['cookieRememberMe']) && !$_SESSION['rememberMe'])
{
	$_SESSION = array();
	session_destroy();
	header("Location: index.php");
	exit;
}
if (isset($_GET['logout']))
{
	$_SESSION = array();
	session_destroy();
	header("Location: index.php");
	exit;
}
if (isset($_POST['login']))
{
	$err = array();
	if (!$_POST['username'] || !$_POST['password'])
		$err[] = 'All the fields must be filled in!';
	if (!count($err))
	{
		$con = connect();
		$user = CheckCredentials($con,$_POST['username'],$_POST['password']);
		if ($user!=$USER_DOESNT_EXIST)
		{
			$_SESSION['id']=$user[0];
			$_SESSION['username'] = $user[1];
			$_SESSION['role']=$user[6];
			$_SESSION['rememberMe']=(int)$_POST['rememberMe'];
			
			setcookie('cookieRememberMe',(int)$_POST['rememberMe']);
		}
		else $err[]='Wrong username or password!';
		$con = null;
	}
	if ($err)
	{
		$_SESSION['msg']['login-err'] = implode('<br />',$err);
	}
	header("Location: index.php");
	exit;
}
?>