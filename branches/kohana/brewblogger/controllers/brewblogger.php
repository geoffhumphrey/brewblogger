<?php defined('SYSPATH') OR die('No direct access allowed.');

abstract class Brewblogger_Controller extends Template_Controller {

    // Template view name
    public $template = 'brewblogger/template';

    public function __construct()
    {
        parent::__construct();
        
        Event::add('system.post_controller_constructor', array($this, '_brewblogger'));
    }
    
    public function _brewblogger()
    {
        
    }

} // End Template_Controller