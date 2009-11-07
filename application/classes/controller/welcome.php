<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Welcome page.
 * 
 * @package    Kohana Examples
 * @link       http://azampagl.com/ko3
 * @link       http://kohanaphp.com/
 */
class Controller_Welcome extends Controller_Application {
	
	/**
	 * Main action for our home page.  It will load
	 * up the proper stylesheets, javascripts, and views.
	 * 
	 * @return	void
	 */
	public function action_index()
	{
		// Set the page title, keywords, and description
		$this->template->title .= ' - Home';
		$this->template->meta_keywords .= ', kohana examples home';
		$this->template->meta_description .= ' - Home';
		
		// Load our page sepcific stylesheets
		$this->template->stylesheets .= thtml::style('css/welcome.css', array('media' => 'screen'));
		
		// Load our template view
		$this->template->content = TView::factory('welcome');
	}

} // End Welcome Controller
