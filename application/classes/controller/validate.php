<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Kohana Validate Example
 *
 * @package    Kohana Examples
 * @link       http://azampagl.com/ko3
 * @link       http://kohanaphp.com/
 */
class Controller_Validate extends Controller_Application {

	/**
	 * Main action for our validate example.  It will load
	 * up the proper stylesheet, javascripts, and views.
	 * 
	 * @return	void
	 */
	public function action_index()
	{
		// Set the page title, keywords, and description
		$this->template->title .= ' - Validate Example';
		$this->template->meta_keywords .= ', kohana examples validate';
		$this->template->meta_description .= ' - Validate';
		
		// Load stylesheets
		$this->template->styles += array('media/css/validate.css' => 'screen');
		
		// Load javascripts
		$this->template->scripts += array('media/js/jquery/jquery.form.js', 'media/js/validate.js');
		
		// Load view and bind variables
		$this->template->content = View::factory('validate')
			->bind('page_token', $page_token);
			
		// Generate a page token to *aid* against CSRF
		$page_token = text::random('alnum', 32);
		$this->_session->set('page_token', $page_token);
	}
	
	/**
	 * Processes our data from the POST submission.  It
	 * will only accept AJAX requests.
	 * 
	 * @return	void
	 */
	public function action_submit()
	{
		if ($this->_is_ajax === TRUE)
		{			
			// Keep track of the status and any errors that occur
			$success = TRUE;
			$errors = array();
			
			// Filters for our form data	
			$filters = array
			(
				TRUE => array                                 /// Filters for ALL fields ('field' => TRUE will apply the filter to all fields)
				(
					'trim' => NULL                            // We're going to trim all of the data sent to us
				),            
			);
			
			// Rules for our form data	
			$rules = array
			(
				'username'			=> array                  /// Rules for username
				(                
					'not_empty'			=> NULL,              // Make sure it's not empty
					'min_length'		=> array(5),          // Make sure it is at least 5 characters
				),
				'password'			=> array                  /// Rules for password
				(               
					'not_empty'			=> NULL,              // Make sure it's not empty
					'min_length'		=> array(8),          // Make sure it is at least 8 characters
				),
				'password_confirm'	=> array                  /// Rules for password confirm
				(                
					'matches'			=> array('password'), // Make sure it matches our password
				),
				'email'				=> array                  /// Rules for email
				(
					'not_empty'			=> NULL,              // Make sure it's not empty
					'email'				=> array(TRUE),       // Valid email?  Pass TRUE for strict email verification
				),
				'first_name'		=> array                  /// Rules for first name
				(                
					'not_empty'			=> NULL,              // Make sure it's not empty
					'max_length'		=> array(25),         // Make sure it doesn't exceed 25 characters
				),
				'last_name'			=> array                  /// Rules for last name
				(                
					'not_empty'			=> NULL,              // Make sure it's not empty
					'max_length'		=> array(25),         // Make sure it doesn't exceed 25 characters
				),
				'birthday'			=> array                  /// Rules for birthday
				(
					'date'				=> NULL,              // Make sure the birthday is a date
				),		
				'phone'				=> array                  /// Rules for ip
				(
					'phone'				=> NULL,              // Check if the phone is legitimate
				),
				'website'				=> array              /// Rules for website
				(
					'url'				=> NULL,              // Check to see if it is a valid URL
				),	
				'ip'				=> array                  /// Rules for ip
				(
					'ip'				=> array(FALSE),      // Valid IP?  Pass FALSE to NOT ALLOW private addresses
				),							
			);
			
			// Custom checks (callbacks) for our form data
			$callbacks = array
			(
				'username' => array                              /// Callbacks for username
				(
					array($this, 'check_username'),              // Custom username check, by passing $this, it will look inside this class for the function
				),
				'email' => array                                 /// Callbacks for email
				(
					array($this, 'check_email'),                 // Custom email check
				),
			);
		
			// Build the validator
			$data = Validate::factory($_POST);
			
			// Apply our filters
			foreach($filters as $field => $field_filters)
			{
				$data->filters($field, $field_filters);
			}
			
			// Apply our rules
			foreach($rules as $field => $field_rules)
			{
				$data->rules($field, $field_rules);
			}
			
			// Apply our callbacks
			foreach($callbacks as $field => $field_callbacks)
			{
				$data->callbacks($field, $field_callbacks);
			}
			
			// Where are the message translations located?  In our case... /application/messages/examples/validate.php
			$message_file = 'validate';
			
			// Check if the page token is valid, skip everything else if it isn't
			if (arr::get($_POST, 'page_token') != $this->_session->get('page_token'))
			{
				$success = FALSE;
				$message =  Kohana::message($message_file);
				$errors['page_token'] = $message['page_token'];
			}
			// If the auth token wasn't valid, don't process anything
			if ($success === TRUE AND ! $data->check())
			{
				$success = FALSE;
				$errors = $data->errors($message_file); // If we didn't pass our $message_file, it would return an array of raw errors
			}
			
			if ($success === TRUE)
			{
				// Handle Sanitation
			
				// Handle Database Submission :: *should be handled in a Model*
			}	
			
			// Call our json view and set our variables
			$this->request->response = View::factory('json')
				->set('success', $success)
				->set('errors', $errors);				
		}
		else
		{
			// Lets only process ajax requests for now
			$this->request->status = 403; // Client Forbidden
		}
	}	
	
	/**
	 * Check is the username provided is invalid already exists.
	 * 
	 * @param	Validate	validate object
	 * @param	string		$field
	 * @return	void
	 */
	public function check_username(Validate $validator, $field)
	{
		$username = strtolower($validator[$field]);
		
		// Silly example to show how to add an error
		if ($username == 'admin')
		{
			$validator->error($field, 'invalid');
		}		
		
		// A legitimate check would be to see if the username already exists
		
		// Database processing :: *should be handled in a Model*
		
		if ($exists = FALSE)
		{
			$validator->error($field, 'unqiue');
		}
	}
	
	/**
	 * Check to see if the email already exists in the database.
	 * 
	 * @param	Validate	validate object
	 * @param	string		$field
	 * @return	void
	 */
	public function check_email(Validate $validator, $field)
	{
		$email = strtolower($validator[$field]);	
		
		// Check if the email already exists
		
		// Database processing :: *should be handled in a Model*
		
		if ($exists = FALSE)
		{
			$validator->error($field, 'unqiue');
		}
	}

} // End Validate Example Controller