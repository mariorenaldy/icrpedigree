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

function send_birth_link($email, $member, $sire, $dam, $id){
	$ci =& get_instance();

	$ci->load->library('email', $ci->config->item('email'));
	$ci->email->set_newline("\r\n");

	$ci->email->set_mailtype('html');
	$ci->email->from($ci->config->item('email')['smtp_user'], 'ICR Pedigree Customer Service');
	$ci->email->to($email);
	$ci->email->subject('Lapor Pacak Disetujui');

	$message = '<div>Yth. '.$member.',</div><br>';
	$message .= '<div>Kami dari tim ICRPedigree ingin memberitahu Anda bahwa pendaftaran pacak anjing antara '.$sire.' dan '.$dam.' telah disetujui. Anda sekarang dapat mendaftarkan laporan lahir setelah '.$ci->config->item('min_jarak_lapor_lahir').' hari.</div><br>';
	$message .= '<div><a href="'.base_url().'frontend/Births/add/'.$id.'">Lapor Lahir</a></div><br>';
	$message .= '<div>Kami ingin mengingatkan Anda untuk selalu mematuhi pedoman dan peraturan kami untuk memastikan kesehatan dan keamanan anjing Anda. Pastikan bahwa anjing Anda mendapatkan perawatan yang memadai dan sehat selama masa kehamilan dan setelah melahirkan.</div><br>';
	$message .= '<div>Jika Anda memiliki pertanyaan atau kekhawatiran, jangan ragu untuk menghubungi kami kapan saja.</div><br>';
	$message .= '<div>Terima kasih atas partisipasi Anda dalam program kami.</div><br>';
	$message .= '<div>Salam,</div><br>';
	$message .= '<div>Tim ICRPedigree</div>';
	
	$ci->email->message($message);
	return $ci->email->send();
}

function send_stambum_link($email, $member, $sire, $dam, $id){
	$ci =& get_instance();

	$ci->load->library('email', $ci->config->item('email'));
	$ci->email->set_newline("\r\n");

	$ci->email->set_mailtype('html');
	$ci->email->from($ci->config->item('email')['smtp_user'], 'ICR Pedigree Customer Service');
	$ci->email->to($email);
	$ci->email->subject('Lapor Lahir Disetujui');

	$message = '<div>Yth. '.$member.',</div><br>';
	$message .= '<div>Kami dari tim ICRPedigree ingin memberitahukan Anda bahwa pendaftaran kelahiran anjing hasil pacak antara '.$sire.' dan '.$dam.' telah disetujui. Langkah selanjutnya adalah mendaftarkan nama anak dan pembuatan stambum.</div><br>';
	$message .= '<div><a href="'.base_url().'frontend/Stambums/add/'.$id.'">Lapor Anak</a></div><br>';
	$message .= '<div>Mohon diperhatikan bahwa pendaftaran nama anak dan pembuatan stambum harus dilakukan minimal '.$ci->config->item('min_jarak_lapor_anak').' hari setelah tanggal lahir dan batas maksimum '.$ci->config->item('jarak_lapor_anak').' hari dari lahir. Pastikan Anda mematuhi jangka waktu ini untuk memastikan bahwa pendaftaran dilakukan dengan tepat waktu.</div><br>';
	$message .= '<div>Kami ingin mengingatkan Anda untuk memastikan bahwa semua informasi yang diberikan dalam pendaftaran akurat dan sesuai dengan data yang sebenarnya. Hal ini akan membantu kami dalam memastikan bahwa detail informasi anjing yang terdaftar tercetak dengan benar pada stambum.</div><br>';
	$message .= '<div>Jika Anda memiliki pertanyaan atau kekhawatiran mengenai pendaftaran, jangan ragu untuk menghubungi kami kapan saja.</div><br>';
	$message .= '<div>Terima kasih atas partisipasi Anda dalam program kami.</div><br>';
	$message .= '<div>Salam,</div><br>';
	$message .= '<div>Tim ICRPedigree</div>';
	
	$ci->email->message($message);
	return $ci->email->send();
}
?>