<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

function send_greeting($email, $member){
	$ci =& get_instance();

	$ci->load->library('email', $ci->config->item('email'));
	$ci->email->set_newline("\r\n");

	$ci->email->set_mailtype('html');
	$ci->email->from($ci->config->item('email')['smtp_user'], 'ICR Pedigree Customer Service');
	$ci->email->to($email);
	$ci->email->subject('Registrasi Keanggotaan di www.ICRPedigree.com Disetujui');

	$message = '<div>Yth. '.$member.',</div><br>';
	$message .= '<div>Kami senang untuk memberitahukan bahwa registrasi keanggotaan Anda di website ';
	$message .= '<a href="'.base_url().'frontend">www.ICRPedigree.com</a> telah disetujui. Anda kini dapat mengakses semua fitur dan layanan yang tersedia di situs kami.</div><br>';
	$message .= '<div>Sebagai anggota di situs kami, Anda dapat melakukan pendaftaran generasi pertama, pendaftaran pacak, lahir, dan pembuatan sertifikat untuk anjing kesayangan anda.</div><br>';
	$message .= '<div>Kami mengucapkan terima kasih atas kepercayaan Anda dalam menjadi anggota di situs kami dan berharap Anda dapat menikmati pengalaman menggunakan layanan kami. Jangan ragu untuk menghubungi kami jika Anda memerlukan bantuan atau memiliki pertanyaan lebih lanjut.</div><br>';
	$message .= '<div>Salam,</div><br>';
	$message .= '<div>Tim ICRPedigree</div>';
	
	$ci->email->message($message);
	return $ci->email->send();
}

function send_reset_password($email, $username, $password){
	$ci =& get_instance();

	$ci->load->library('email', $ci->config->item('email'));
	$ci->email->set_newline("\r\n");

	$ci->email->set_mailtype('html');
	$ci->email->from($ci->config->item('email')['smtp_user'], 'ICR Pedigree Customer Service');
	$ci->email->to($email);
	$ci->email->subject('Password Telah Diubah - Silakan Login Kembali ke Website ICRPedigree');

	$message = '<div>Anggota ICR Pedigree Yth.,</div><br>';
	$message .= '<div>Kami ingin memberitahu Anda bahwa password akun Anda dengan username <b>'.$username;
	$message .= '</b> telah diubah ke <b>'.$password.'</b>.</div><br>';
	$message .= '<div>Silakan login kembali ke situs web kami di <a href="'.base_url().'frontend">www.ICRPedigree.com</a> ';
	$message .= 'dengan menggunakan password baru Anda. Jangan lupa untuk mengganti password tersebut sesuai dengan preferensi Anda agar tetap aman.</div><br>';
	$message .= '<div>Jika Anda tidak merasa melakukan perubahan password atau menemukan aktivitas yang mencurigakan pada akun Anda, silakan hubungi tim dukungan pelanggan kami segera di ';
	$message .= '<a href="mailto:icr_indonesia@yahoo.com">icr_indonesia@yahoo.com</a>.</div><br>';
	$message .= '<div>Terima kasih atas perhatiannya</div><br>';
	$message .= '<div>Salam,</div><br>';
	$message .= '<div>Tim ICRPedigree</div>';

	$ci->email->message($message);
	return $ci->email->send();
}
?>