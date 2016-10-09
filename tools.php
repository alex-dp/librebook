<?php

$val_ext = array("7z", "zip", "epub", "pbd", "fb2", "pdf", "mobi", "djvu",
	"azw", "azw2", "azw3", "tar.xz", "tar.gz", "rar");

function get_lang($get, $header) {

	if (isset($get))
	    $locale = substr($get, 0, 2);

	else
	    $locale = substr($header, 0, 2);

	if(!in_array($locale, array('en', 'it')))
	    $locale = 'en';

	include_once 'languages/' . $locale . '.php';

	return $lang;
}


function startsWith($haystack, $needle) {
    return (substr($haystack, 0, strlen($needle)) === $needle);
}

function lstrip($string, $pre) {
    return startsWith($string, $pre) ?
        substr($string, strlen($pre)) : $string;
}

?>