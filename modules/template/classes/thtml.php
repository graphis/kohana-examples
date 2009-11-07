<?php defined('SYSPATH') OR die('No direct access allowed.');

class THtml extends Kohana_HTML {
	
	/**
	 * Returns the location of the media folder for the configured template.
	 * 
	 * @return	string
	 */
	protected static function _template()
	{
		// Load the configuration
		$config = Kohana::config('template');
		$template = $config->active;
		
		if ( ! isset($config->{$template}) OR ! isset($config->{$template}['media_dir']))
		{
			throw new Kohana_Exception('Template media directory never defined');
		}
		
		return $config->{$template}['media_dir'];		
	}

	/**
	 * Creates a style sheet link.
	 *
	 * @param   string  file name
	 * @param   array   default attributes
	 * @param   boolean  include the index page
	 * @return  string
	 */
	public static function style($file, array $attributes = NULL, $index = FALSE)
	{
		return parent::style(self::_template().$file, $attributes, $index);
	}

	/**
	 * Creates a script link.
	 *
	 * @param   string   file name
	 * @param   array    default attributes
	 * @param   boolean  include the index page
	 * @return  string
	 */
	public static function script($file, array $attributes = NULL, $index = FALSE)
	{
		return parent::script(self::_template().$file, $attributes, $index);
	}

	/**
	 * Creates a image link.
	 *
	 * @param   string   file name
	 * @param   array    default attributes
	 * @return  string
	 */
	public static function image($file, array $attributes = NULL)
	{
		return parent::image(self::_template().$file, $attributes);
	}

} // End Template html
