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
	
	// Is the request ajax?
	protected $_is_ajax;
	
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
		
		// Set the template
		$this->template = 'template';
		
		// Set the default session instance, this will be used throughout the application
		$this->_session = Session::instance();
		
		// Is the request ajax?
		if (Request::$is_ajax OR $this->request !== Request::instance())
		{
			$this->_is_ajax = TRUE;
		}
	}
	
	/**
	 * Determine whether the request is ajax or not.  If it is, send the
	 * proper headers and turn off aut-rendering.
	 * 
	 * Initialize template variables such as title and keywords
	 * if it is a normal request.
	 * 
	 * @return	void
	 */
	public function before()
	{		
		if ($this->_is_ajax === TRUE)
		{
			// Turn off auto-rendering
    		$this->auto_render = FALSE;
		
			// Send headers for a json response
			$this->request->headers['Cache-Control'] = 'no-cache, must-revalidate';
			$this->request->headers['Expires'] = 'Sun, 30 Jul 1989 19:30:00 GMT';
			$this->request->headers['Content-Type'] = 'application/json';
		}
		else
		{
			// Call template controller before() to initialize template
			parent::before();
			
			// Initialize template variables
			$this->template->title = 'Kohana Examples';
			$this->template->meta_keywords = 'kohana examples';
			$this->template->meta_description = 'Kohana 3.0 Examples';
				
			$this->template->styles =
			$this->template->scripts = array();
			
			$this->template->content     = '';
		}
	}

} // End Application Controller
