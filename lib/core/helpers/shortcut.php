<?php
function sf(){
	$args = func_get_args();
	return call_user_func_array('sprintf',$args);
}
function pf(){
	$args = func_get_args();
	return call_user_func_array('printf',$args);
}
// stolen from rails
function h($str = ''){
    return htmlentities($str,ENT_COMPAT,'UTF-8');
}
