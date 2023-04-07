<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LanguageLoader
{
    function initialize() {
        $ci =& get_instance();
        $ci->load->helper('language');

        $site_lang = $ci->session->userdata('site_lang');
        if ($site_lang) {
            $ci->lang->load('navbar',$ci->session->userdata('site_lang'));
            $ci->lang->load('footer',$ci->session->userdata('site_lang'));
        } else {
            $ci->lang->load('navbar','english');
            $ci->lang->load('footer','english');
        }
    }
}