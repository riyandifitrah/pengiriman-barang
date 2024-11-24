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
	function enc($password)
	{
		$encrypted_password = password_hash($password, PASSWORD_DEFAULT);
		return isset($encrypted_password) ? $encrypted_password : '';
	}
}
if (!function_exists('get_name_month')) {
	function get_name_month(){
		$bln = array(
			1 => "Januari",
			"Februari",
			"Maret",
			"April",
			"Mei",
			"Juni",
			"July",
			"Agustus",
			"September",
			"Oktober",
			"November",
			"Desember"
		  );
		  return $bln;
	}
}
if (!function_exists('get_user_menu')) {
	function get_user_menu($role_id)
	{
		$menus = [
			1 => [
				'main_menu' => [
					[
						'username' => 'Admin',
						'title' => 'Add User',
						'icon' => 'fas fa-user-plus',
						// 'sub_menus' => [
						// 	[
						// 		'title' => '',
						// 		'url' => '',
						// 		'icon' => '',
						// 	],
						// ],
					],
				],
			],
			// <i class="fas fa-angle-left right"></i>
			// <i class="far fa-circle nav-icon"></i>
			// <i class="far fa-circle nav-icon"></i>
			2 => [
				'main_menu' => [
					[
						'username' => 'Sender',
						'title' => 'Pengiriman Barang',
						'icon' => 'fas fa-shipping-fast',
						'sub_menus' => [
							[
								'title' => 'Data Barang',
								'url' => base_url('beranda'),
								'icon' => 'far fa-circle nav-icon',
							],
							[
								'title' => 'Form Input Barang',
								'url' => base_url('form-input-barang'),
								'icon' => 'far fa-circle nav-icon',
							],
						],
					],
				],
			],
			3 => [
				'main_menu' => [
					[
						'username' => 'Harbors',
						'title' => 'Check Package',
						'icon' => 'fas fa-copy',
						'sub_menus' => [
							[
								'title' => 'Arrived Data',
								'url' => base_url('arrived'),
								'icon' => 'far fa-circle nav-icon',
							],
							// [
							// 	'title' => 'Receiver Data',
							// 	'url' => base_url(''),
							// 	'icon' => 'far fa-circle nav-icon',
							// ],
						],
					],
				],
			],
			4 => [
				'main_menu' => [
					[
						'username' => 'Receiver',
						'title' => 'Check Package',
						'icon' => 'fas fa-copy',
						'sub_menus' => [
							// [
							// 	'title' => 'Arrived Data',
							// 	'url' => base_url('arrived'),
							// 	'icon' => 'far fa-circle nav-icon',
							// ],
							[
								'title' => 'Receiver Data',
								'url' => base_url('received'),
								'icon' => 'far fa-circle nav-icon',
							],
						],
					],
				],
			],
			5 => [
				'main_menu' => [
					[
						'username' => 'root',
						'title' => 'Pengiriman Barang',
						'icon' => 'fas fa-shipping-fast',
						'sub_menus' => [
							[
								'title' => 'Data Barang',
								'url' => base_url('beranda'),
								'icon' => 'far fa-circle nav-icon',
							],
							[
								'title' => 'Form Input Barang',
								'url' => base_url('form-input-barang'),
								'icon' => 'far fa-circle nav-icon',
							],
						],
					],
					[
						'username' => 'root',
						'title' => 'Check Package',
						'icon' => 'fas fa-copy',
						'sub_menus' => [
							[
								'title' => 'Arrived Data',
								'url' => base_url('arrived'),
								'icon' => 'far fa-circle nav-icon',
							],
							[
								'title' => 'Receiver Data',
								'url' => base_url('received'),
								'icon' => 'far fa-circle nav-icon',
							],
						],
					],
				],
			],
		];
		// Filter menu berdasarkan role_id
		return $menus[$role_id]['main_menu'] ?? [];
	}
}
// if (!function_exists('view')) {
// 	function view($view, $data = []){
// 		$path = APPPATH. 'view';
// 		$blade = new Blade($path, $path . '/cache');
// 		echo $blade->make($view, $data);
// 	}
// }