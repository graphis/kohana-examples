<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Base controller for the application. *Most* controllers should extends this class.
 * 
 * @package    Kohana Examples
 * @link       http://azampagl.com/ko3
 * @link       http://kohanaphp.com/
 */
abstract class Controller_Application extends Controller_Template {

	// Default session instance
	protected $_session;
	
	/**
	 * Pass the request to the true template controller,
	 * then initialize the template and session.
	 * 
	 * @param	Request	page request
	 * @return 
	 */
	public function __construct(Request $req)
	{
		// Pass the request to the template controller
		parent::__construct($req);
				
		// Reset the template
		$this->template = 'template'; // @location /application/views/template.php	
		
		// Set the default session instance, this will be used throughout the application
		$this->_session = Session::instance();
	}
	
	/**
	 * Initialize template variables such as title and keywords.
	 * 
	 * @return 
	 */
	public function before()
	{
		// Call template controller before() to initialize template
		parent::before();
		
		// Initialize template variables
		$this->template->title = 'Kohana Examples';
		$this->template->meta_keywords = 'kohana examples';
		$this->template->meta_description = 'Kohana 3.0 Examples';
		
		$this->template->stylesheets =
		$this->template->javascripts =
		$this->template->content = '';
	}

} // End Application Controller