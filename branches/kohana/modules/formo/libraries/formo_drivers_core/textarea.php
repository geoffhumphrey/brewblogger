<?php defined('SYSPATH') or die('No direct script access.');

class Formo_textarea_Driver extends Formo_Element {
		
	public function render()
	{
		return '<textarea name="'.$this->name.'"'.Formo::quicktagss($this->_find_tags()).'>'.$this->value.'</textarea>';
	}

}