<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#[\AllowDynamicProperties]

class LangSwitch extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->helper(array('url', 'cookie'));
    }

    function switchLanguage($language = "indonesia") {
        set_cookie('site_lang', $language, '2147483647'); 
        redirect(base_url());
    }
}