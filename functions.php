<?php 


/**
 * Underscore spremeni niz v url-prijazen niz
 * @param $str
 * @return string
 */
function underscore($str)
{

	$str = str_replace(array("č","ž","š","ć", "Č","Ž","Š","Ć","!","?"),array("c","z","s","c", "c","z","s","c","",""),trim($str));
        $str = preg_replace(array('/[\s.,\']+/'), '_', strtolower($str));
        $str = preg_replace(array('/[^a-z0-9\-_]+/'),'',$str);
        if(empty($str)) $str="_";
        return $str;
	
}

/**
 * Ampersand zamenja znak & z entiteto (za uporabo v url-jih in xml dokumentih)
 * @param $str
 * @return unknown_type
 */
function ampersand($str)
{
	return preg_replace("/&(?![\#a-z0-9]+;)/i", "&amp;", $str);
}

/**
 * http://stackoverflow.com/questions/10520390/stop-script-execution-upon-notice-warning
 * @param [[Type]] $errNo   [[Description]]
 * @param [[Type]] $errStr  [[Description]]
 * @param [[Type]] $errFile [[Description]]
 * @param [[Type]] $errLine [[Description]]
 */
function errHandle($errNo, $errStr, $errFile, $errLine) {
    $msg = "$errStr in $errFile on line $errLine";
    if ($errNo == E_NOTICE || $errNo == E_WARNING) {
        throw new ErrorException($msg, $errNo);
    } else {
        echo $msg;
    }
}