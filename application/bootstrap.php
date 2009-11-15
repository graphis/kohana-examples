<?php defined('SYSPATH') or die('No direct script access.');

//-- Environment setup --------------------------------------------------------

/**
 * Set the default time zone.
 *
 * @see  http://docs.kohanaphp.com/features/localization#time
 * @see  http://php.net/timezones
 */
date_default_timezone_set('UTC');

/**
 * Enable the Kohana auto-loader.
 *
 * @see  http://docs.kohanaphp.com/features/autoloading
 * @see  http://php.net/spl_autoload_register
 */
spl_autoload_register(array('Kohana', 'auto_load'));

/**
 * Enable the Kohana auto-loader for unserialization.
 *
 * @see  http://php.net/spl_autoload_call
 * @see  http://php.net/manual/var.configuration.php#unserialize-callback-func
 */
ini_set('unserialize_callback_func', 'spl_autoload_call');

/**
 * Set if the application is in development (FALSE)
 * or if the application is in production (TRUE).
 */
define('IN_PRODUCTION', FALSE);

/**
 * Display errors only when in development.
 */
ini_set('display_errors', ! IN_PRODUCTION); 

//-- Configuration and initialization -----------------------------------------

/**
 * Initialize Kohana, setting the default options.
 *
 * The following options are available:
 *
 * - string   base_url    path, and optionally domain, of your application   NULL
 * - string   index_file  name of your index file, usually "index.php"       index.php
 * - string   charset     internal character set used for input and output   utf-8
 * - string   cache_dir   set the internal cache directory                   APPPATH/cache
 * - boolean  errors      enable or disable error handling                   TRUE
 * - boolean  profile     enable or disable internal profiling               TRUE
 * - boolean  caching     enable or disable internal caching                 FALSE
 */
Kohana::init
(
	array
	(
		'base_url'   => '/ko3/examples/',
		'index_file' => FALSE,
		'profile'    => ! IN_PRODUCTION,     // Disabling profiling if we are in production
		'caching'    => IN_PRODUCTION,       // Enable caching if we are in production
	)
);

/**
 * Attach the file write to logging. Multiple writers are supported.
 */
Kohana::$log->attach(new Kohana_Log_File(APPPATH.'logs'));

/**
 * Attach a file reader to config. Multiple readers are supported.
 */
Kohana::$config->attach(new Kohana_Config_File);

/**
 * Enable modules. Modules are referenced by a relative or absolute path.
 */
Kohana::modules(array(
	'database'   => MODPATH.'database',   // Database access
	'userguide'  => MODPATH.'userguide',  // User guide and API documentation
	));

if ( ! Route::cache())
{		
	/**
	 * Set the routes. Each route must have a minimum of a name, a URI and a set of
	 * defaults for the URI.  'id' should be able to handle any characters passed to it.
	 */
	Route::set('default', '(<controller>(/<action>(/<id>)))', array('id' => '.+'))
		->defaults(array(
			'controller' => 'welcome',
			'action'     => 'index',
		));
		
	/**
	 * Catch-all for pages that do not exist.
	 */
	Route::set('catch_all', '<path>', array('path' => '.+'))
		->defaults(array(
			'controller' => 'errors',
			'action'     => '404',
		));
	
	// Cache the routes if in production
	Route::cache(IN_PRODUCTION);
}

/**
 * Execute the main request. A source of the URI can be passed, eg: $_SERVER['PATH_INFO'].
 * If no source is specified, the URI will be automatically detected.
 */

$request = Request::instance();

if (IN_PRODUCTION === TRUE)
{
	// If we're in production, we want to handle erros nicely
	try
	{
		// Attempt to execute the response
		$request->execute()
			->send_headers();
	}
	catch (Exception $e)
	{
		// Was the page found?
		if ($request->status == 404 OR $e instanceof Kohana_Request_Exception)
		{
			$title = 'Kohana Examples - Page Not Found';
			$view = View::factory('errors/404');
		}		
		// The error was an internal server error or something else, we should record it for analysis
		else
		{
			$title = 'Kohana Examples - Page Error';
			$view = View::factory('errors/500');
			
			// Write a log as an internal server error
			Kohana::$log->add(Kohana::ERROR, Kohana::exception_text($e));
		}		
		
		$request->response = View::factory('template')
			->set('title', $title)
			->set('meta_keywords', '')
			->set('meta_description', '')
			->set('stylesheets', html::style('css/errors.css', array('media' => 'screen')))
			->set('javascripts', '')
			->set('content', $view);
	}
}
else
{
	// We want to display errors if we are not in production
	$request->execute()
		->send_headers();
}

// Echo the response
echo $request->response;