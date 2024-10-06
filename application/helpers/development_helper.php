<?php
defined('BASEPATH') or exit('No direct script access allowed');


if (!function_exists('die_dump')) {
	function die_dump($expression)
	{
		ob_end_clean();
		$var = print_r($expression, TRUE);
		if (is_cli()) {
			echo $var;
		} else {
			echo '<pre>' . html_escape($var) . '</pre>';
		}
		exit();
	}
}
if (!function_exists('randomString')) {
	function randomString($length)
	{
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[random_int(0, $charactersLength - 1)];
		}
		return $randomString;
	}
}
if (!function_exists('enc')) {
	function enc($password){
		$encrypted_password = password_hash($password, PASSWORD_DEFAULT);
		return isset($encrypted_password) ? $encrypted_password : ''; 
	}
}
// if (!function_exists('view')) {
// 	function view($view, $data = []){
// 		$path = APPPATH. 'view';
// 		$blade = new Blade($path, $path . '/cache');
// 		echo $blade->make($view, $data);
// 	}
// }