<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

function send_greeting($member){
	$this->load->library('email', $this->config->item('email'));
	$this->email->set_newline("\r\n");

	$this->email->set_mailtype('html');
	$this->email->from($this->config->item('email')['smtp_user'], 'ICR Pedigree Customer Service');
	$this->email->to($member);
	$this->email->subject('Register Berhasil');

	$message = '<div>Kepada pengguna ICR Pedigree,</div>';
	$message .= '<div>Admin sudah approve keanggotaan anda di ICR Pedigree. Silakan lakukan login untuk mengakses aplikasi ICR Pedigree.</div>';
	$message .= '<div>Salam </div>';
	$message .= '<div>ICR Pedigree Customer Service</div>';
	$message .= '<div><br/><hr/></div>';

	$this->email->message($message);
	return $this->email->send();
}
?>