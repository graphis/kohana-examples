<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Controller to handle request errors.
 * 
 * @package    Kohana Examples
 * @link       http://azampagl.com/ko3
 * @link       http://kohanaphp.com/
 */
class Controller_Errors extends Controller_Application {
	
	/**
	 * This action will handle 404 errors (page not found).
	 * 
	 * @return	void
	 */
	public function action_404()
	{
		// Set the page title, keywords, and description
		$this->template->title .= ' - Page Not Found';
		$this->template->meta_keywords .= '';
		$this->template->meta_description .= '';
		
		// Load stylesheets
		$this->template->styles += array('media/css/errors.css' => 'screen');
		
		// Load view
		$this->template->content = View::factory('errors/404');
	}

} // End Errors Controller
