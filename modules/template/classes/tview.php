<?php defined('SYSPATH') or die('No direct script access.');

class TView extends Kohana_View {

	/**
	 * Returns a new View object.
	 *
	 * @param   string  view filename
	 * @param   array   array of values
	 * @return  View
	 */
	public static function factory($file = NULL, array $data = NULL)
	{
		// Load the configuration
		$config = Kohana::config('template');
		$template = $config->active;
		
		if ( ! isset($config->{$template}) OR ! isset($config->{$template}['view_dir']))
		{
			throw new Kohana_Exception('Template view directory never defined');
		}
		
		return parent::factory($config->{$template}['view_dir'].$file, $data);		
	}

} // End Template View
