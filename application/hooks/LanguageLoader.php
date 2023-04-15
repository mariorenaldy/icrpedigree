<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LanguageLoader
{
    function initialize() {
        $ci =& get_instance();
        $ci->load->helper('language');
        $ci->load->library('session');

        if ($ci->session->userdata('site_lang')) {
            $ci->lang->load('navbar',$ci->session->userdata('site_lang'));
            $ci->lang->load('footer',$ci->session->userdata('site_lang'));
        } else {
            $ci->lang->load('navbar','indonesia');
            $ci->lang->load('footer','indonesia');
        }
    }
}