<?

/****************************************************************
*                            	 constants.php			 							*
*                          -------------------			  					*
*     begin                : 01.03.2015 y												*
*     copyright            : Sayqal Solutions 2015							*
*     email                : info@sayqal.uz											*
*	    Written by		   		 : Botirjon G Olimov									*
****************************************************************/

if ( !defined('ARM_IN') )
{
	die("Hacking attempt");
}


define("OWNER", 'Sayqal Test');

define("HOST", 'localhost');
define("SYSTEM_BASE", 'portfolio_db');
define("USERNAME",'root');
define("PASSWORD", '');

define("SERVER_NAME", $_SERVER['SERVER_NAME']);
define("PROGRAM_ID", 15);
define("PROGRAM_VERSION", 1);
define("PROGRAM_NAME", "");
define("PROGRAM_FOLDER", "");

define("SESSION_EXPIRE_TIME", 7200);
define("COOKIE_EXPIRE_TIME", 1 * 24 * 60 * 60);
define("COOKIE_PATH", "/");
define("COOKIE_DOMAIN", $_SERVER['SERVER_NAME']);
define("COOKIE_SECURE", null);

define("UPLOAD_LIMIT", 0);
?>