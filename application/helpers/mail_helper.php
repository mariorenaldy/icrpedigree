<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

function send_greeting($member){
	$ci =& get_instance();

	$ci->load->library('email', $ci->config->item('email'));
	$ci->email->set_newline("\r\n");

	$ci->email->set_mailtype('html');
	$ci->email->from($ci->config->item('email')['smtp_user'], 'ICR Pedigree Customer Service');
	$ci->email->to($member);
	$ci->email->subject('Register Berhasil');

	$message = '<div>Kepada pengguna ICR Pedigree,</div>';
	$message .= '<div>Admin sudah approve keanggotaan anda di ICR Pedigree. Silakan lakukan login untuk mengakses aplikasi ICR Pedigree.</div>';
	$message .= '<div>Salam </div>';
	$message .= '<div>ICR Pedigree Customer Service</div>';
	$message .= '<div><br/><hr/></div>';

	$ci->email->message($message);
	return $ci->email->send();
}
?>