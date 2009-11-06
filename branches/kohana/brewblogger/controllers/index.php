<?php defined('SYSPATH') OR die('No direct access allowed.');

class Index_Controller extends Brewblogger_Controller {

    public function index()
    {
        $this->template->content = 'basic content';
    }

}