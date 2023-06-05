<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('dd')) {
	function dd($data)
	{
		echo "<pre>";
		print_r($data);
		echo "</pre>";
		die;
	}
}

if (!function_exists('show')) {
	function show($data)
	{
		echo "<pre>";
		print_r($data);
		echo "</pre>";
	}
}

function active_link($page)
{
	$current_url = current_url();

	if ($current_url == base_url($page)) {
		echo '';
	} else {
		echo 'collapsed';
	}
}

function is_table_referenced($table = '', $column = [])
{
	$CI = &get_instance();

	$CI->load->database();
	$result = $CI->db->get_where($table, $column)->num_rows();

	if ($result > 0) {
		return 'disabled';
	} else {
		return '';
	}
}

if (!function_exists('passwordhash')) {
	function passwordhash($password)
	{
		$options = array(
			'cost' => 4,
		);
		return password_hash($password, PASSWORD_BCRYPT, $options);
	}
}

if (!function_exists('passwordverify')) {
	function passwordverify($password, $hash)
	{
		if (password_verify($password, $hash)) {
			return true;
		} else {
			return false;
		}
	}
}

if (!function_exists('generate_hash')) {
	function generate_hash()
	{
		$CI = &get_instance();
		return $CI->security->get_csrf_hash();
	}
}

function e($sData)
{
	$id = (float)$sData * 525325.24;
	return base64_encode($id);
}

function d($sData)
{
	$url_id = base64_decode($sData);
	$id = (float)$url_id / 525325.24;
	return $id;
}

if (!function_exists('encrypt_message')) {
	function encrypt_message($message, $encryption_key)
	{
		$key = hex2bin($encryption_key);
		$nonceSize = openssl_cipher_iv_length('aes-256-ctr');
		$nonce = openssl_random_pseudo_bytes($nonceSize);
		$ciphertext = openssl_encrypt(
			$message,
			'aes-256-ctr',
			$key,
			OPENSSL_RAW_DATA,
			$nonce
		);
		return base64_encode($nonce . $ciphertext);
	}
}

if (!function_exists('decrypt_message')) {
	function decrypt_message($message, $encryption_key)
	{
		$key = hex2bin($encryption_key);
		$message = base64_decode($message);
		$nonceSize = openssl_cipher_iv_length('aes-256-ctr');
		$nonce = mb_substr($message, 0, $nonceSize, '8bit');
		$ciphertext = mb_substr($message, $nonceSize, null, '8bit');
		$plaintext = openssl_decrypt(
			$ciphertext,
			'aes-256-ctr',
			$key,
			OPENSSL_RAW_DATA,
			$nonce
		);
		return $plaintext;
	}
}
