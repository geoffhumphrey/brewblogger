<?php defined('SYSPATH') OR die('No direct access allowed.');

class Formo_reset_Driver extends Formo_Element {

	public function render()
	{
		return '<input type="reset" name="'.$this->name.'"'.Formo::quicktagss($this->_find_tags()).' />';
	}
	
	protected function build()
	{
		return "\t".$this->open
			  .$this->element()
			  .$this->close."\n";
	}

	public function add_post($value)
	{
		return;
	}
	
	public function validate_this()
	{
		return;
	}
	
	public function get_value()
	{
		return FALSE;
	}
	
	public function clear()
	{
		return;
	}

}