<?
/****************************************************************
*                            	 sessions.php			 								*
*                          -------------------			  					*
*     begin                : 01.03.2015 y												*
*     copyright            : Sayqal Solutions 2015							*
*     email                : info@sayqal.uz											*
*	    Written by		   		 : Botirjon G Olimov									*
****************************************************************/
if ( !defined('ARM_IN') )
	die("Hacking attempt");

function session_begin($user_login, $user_password)
{
	$ip = getenv('REMOTE_ADDR');

	$_SESSION['login'] = $user_login;
	$_SESSION['password'] = $user_password;
	$_SESSION['ip'] = $ip;
	$_SESSION['start_time'] = time();
	$_SESSION['time'] = time();
	$_SESSION['count'] = 1;

	$user_data['login'] = $_SESSION['login'];
	$user_data['password'] = $_SESSION['password'];
	$user_data['ip'] = $_SESSION['ip'];
	$user_data['count'] = $_SESSION['count'];

	return $user_data;
}

function session_pagestart()
{
	$session_id = session_id();
	$ip = getenv('REMOTE_ADDR');

	if (!empty($session_id))
	{
		$current_time = time();
		$expiry_time = $current_time - SESSION_EXPIRE_TIME;
		$_SESSION['count']++;

		if ($_SESSION['time'] < $expiry_time)	{
			session_end();
			return 0;
		}
		if ($ip == $_SESSION['ip'])
			$_SESSION['time'] = $current_time;
	}
	else {
		session_end();
		return 0;
	}

	$user_data['login'] = $_SESSION['login'];
	$user_data['password'] = $_SESSION['password'];
	$user_data['ip'] = $_SESSION['ip'];
	$user_data['count'] = $_SESSION['count'];
	$user_data['start_time'] = $_SESSION['start_time'];
	$user_data['time'] = $_SESSION['time'];
	
	return $user_data;
}

function session_end()
{
	session_destroy();
}
?>