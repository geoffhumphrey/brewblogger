<?php defined('SYSPATH') OR die('No direct access allowed.');

/*=====================================

Formo Fieldset Plugin

Add fieldset/legend to a form


Adds fieldset($legend_title, [$fieldset_tags], [$legend_tags]) method to form

Usage example:

$form
	->plugin('fieldset')
	->legend('User Settings', 'class=myfieldset', 'class=mylegend')
	...

=====================================*/

class Formo_fieldset {

	protected $fieldset = FALSE;
	protected $legend;
	
	protected $form;
	
	protected $fieldset_tags = array();
	protected $legend_name;
	protected $legend_tags = array();
	
	public static function load($form)
	{
		return new Formo_fieldset($form);
	}
	
	public function __construct($form)
	{
		$this->form = $form;
		
		Event::add('formo.pre_render', array($this, 'pre_render'));
		
		$this->form
			->add_function('fieldset', array($this, 'fieldset'));
	}
	
	public function fieldset($legend, $fieldset_info = array(), $legend_info = array())
	{					
		$this->fieldset_tags = Formo::quicktags($fieldset_info);
		$this->legend_name = $legend;
		$this->legend_tags = Formo::quicktags($legend_info);
		
		$this->fieldset = $this->render_fieldset();
		$this->legend = $this->render_legend();
	}
			
	protected function render_fieldset()
	{
		return '<fieldset'.Formo::quicktagss($this->fieldset_tags).'>'."\n";
	}
	
	protected function render_legend()
	{
		return '<legend'.Formo::quicktagss($this->legend_tags).'>'.$this->legend_name.'</legend>'."\n";
	}
	
	public function pre_render()
	{
		if ( ! $this->fieldset)
			return;
			
		$this->form->_open .= $this->fieldset.$this->legend;
		$this->form->_close = '</fieldset>'.$this->form->_close;
	}	

}