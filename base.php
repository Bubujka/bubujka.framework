<?php
header('Content-Type: text/html; charset=utf-8');

date_default_timezone_set('Europe/Moscow');
ini_set('display_errors','on');

define('BASE_DIRECTORY',dirname(__FILE__));
define('CACHE_DIRECTORY',dirname(__FILE__).'/cache');
define('FSTAB',BASE_DIRECTORY.'/fstab.php');
define('ROUTE_FILE',BASE_DIRECTORY.'/etc/route.php');

$_SERVER['REDIRECT_QUERY_STRING'] = preg_replace('/(&.*)/','',$_SERVER['REDIRECT_QUERY_STRING']);
define('RAW_HTTP_STRING', $_SERVER['REDIRECT_QUERY_STRING']);


function bu_getHostName(){
    $host = $_SERVER['HTTP_HOST'];
    return $host;
}
define('HTTP_HOST',bu_getHostName());
if (stristr(PHP_OS, 'WIN'))  
    set_include_path('.;'.BASE_DIRECTORY);
else 
    set_include_path('.:'.BASE_DIRECTORY);

?>
