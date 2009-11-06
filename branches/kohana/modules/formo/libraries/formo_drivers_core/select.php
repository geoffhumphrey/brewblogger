<?php defined('SYSPATH') or die('No direct script access.');

class Formo_select_Driver extends Formo_Element {
	
	public $values = array();
	public $blank = array();

	public function __construct($name='',$info=array())
	{
		parent::__construct($name, $info);

		Formo::instance($this->formo_name)
			->add_function('blank', array($this, 'blank'));
	}

	public static function shortcut($defs, $name, $values, $info=array())
	{
		$info = self::process_info($defs, $info);
		$info['values'] = $values;
		
		return new Formo_select_Driver($name, $info);
	}
		
	public function render()
	{
		$sel = '';
		$sel.= '<select name="'.$this->name.'"'.Formo::quicktagss($this->_find_tags()).">"."\n";
		$i=0;
		foreach ($this->values as $v=>$k) {
			if ($i == 0 AND $this->blank === TRUE)
			{
				$sel.= $this->_option('', '', '');
			}
			
			if (is_array($this->blank) AND in_array($i, $this->blank))
			{
				$sel.= $this->_option('', '', '');
			}		
			
			$k = preg_replace('/_[bB][lL][aA][nN][kK][0-9]*_/','',$k);
			$selected = ($v == $this->value) ? ' selected="selected"' : '';
			$sel .= $this->_option($k, $v, $selected);

			$i++;
		}
		$sel.= "</select>";	
		return $sel;
	}
	
	private function _option($k, $v, $selected)
	{
		return "\t\t".'<option value="'.$v.'"'.$selected.'>'.$k.'</option>'."\n";
	}
	
	public function run_filter($filter, $type)
	{
		$keys = array_keys($this->values);
		$values = array_values($this->values);
		
		$use = ($type == 'pre') ? 'keys' : 'values';
				
		foreach (${$use} as $k=>$val)
		{
			${$use}[$k] = call_user_func($filter, $val);
		}
		
		if ($keys AND $values)
		{
			$this->values = array_combine($keys, $values);
		}
	}
	
	protected function validate_this()
	{
		if ( ! $this->has_blank() AND $this->value == '')
		{
			$this->error = $this->error_msg;
			return $this->error;
		}
			
		$keys = array_map('strtolower', array_keys($this->values));
		if ( ! in_array(strtolower($this->value), $keys))
		{
			$this->error = $this->error_msg;
			return $this->error;
		}
		
		parent::validate_this();		
	}
	
	protected function has_blank()
	{
		return ( ! empty($this->blank)) ? TRUE : FALSE;
	}
	
	public function blank($element = '', $list = FALSE)
	{	
		$form = Formo::instance($this->formo_name);
		$list = ( ! $list) ? $element : $list;
		$element = ($list) ? $element : Formo::$last_accessed;
		
		if ( ! is_array($list))
		{
			$list = TRUE;
		}

		$form->{$this->name}->blank = $list;
	}

}