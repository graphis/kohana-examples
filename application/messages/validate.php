<?php defined('SYSPATH') or die('No direct script access.');

return array
(
	'auth_token'    	=> 'Authorization token was invalid',
	'username'			=> array
	(
		'not_empty'			=> 'Username is required',
		'min_length'		=> 'The username provided is to short',
		'invalid'			=> 'The username provided is invalid',
		'unqiue'			=> 'The username provided already exists',
	),
	'password'			=> array
	(
		'not_empty'			=> 'Password is required',
		'min_length'		=> 'The password provided is to short',
	),
	'password_confirm'	=> array
	(
		'matches'			=> 'Password confirmation does not match',
	),
	'email'				=> array
	(
		'not_empty'			=> 'Email is required',
		'email'				=> 'The email provided is not valid',
		'unqiue'			=> 'The email provided already exists',
		'email_domain'		=> 'The email domain provided does not exist',
	),
	'first_name'		=> array
	(
		'not_empty'			=> 'First name is required',
		'max_length'		=> 'The first name provided is to long',
	),	
	'last_name'			=> array
	(
		'not_empty'			=> 'Last name is required',
		'max_length'		=> 'The last name provided is to long',
	),
	'birthday'			=> array
	(
		'date'				=> 'The birthday provided is invalid',
	),
	'phone'				=> array
	(
		'phone'				=> 'The phone number provided is invalid',
	),
	'website'			=> array
	(
		'url'				=> 'The website must be a valid url',
	),
	'ip'				=> array
	(
		'ip'				=> 'The IP must be a valid IP address, and non-private',
	),
);