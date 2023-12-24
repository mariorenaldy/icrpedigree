<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

function send_greeting($email, $member){
	$ci =& get_instance();

	$ci->load->library('email', $ci->config->item('email'));
	$ci->email->set_newline("\r\n");

	$ci->email->set_mailtype('html');
	$ci->email->from($ci->config->item('email')['smtp_user'], 'ICR Pedigree Customer Service');
	// $ci->email->to($email);
	$ci->email->to("mariorenaldy2@gmail.com");
	$ci->email->subject('Registrasi Keanggotaan di ICRPedigree Disetujui / Membership Registration on ICRPedigree Approved');

	$message = '<div style="width: 500px; margin: auto; text-align: justify; text-justify: inter-word;">';
	$message .= '<div style="display: flex; align-items:center;">';
	$message .= '<img src="https://icrpedigree.com/assets/img/icr_logo_hitam.png" style="width: 100px; vertical-align: middle;">';
	$message .= '<span style="font-size: 50px; margin: auto;">ICR Pedigree</span>';
	$message .= '</div>';
	$message .= '<hr style="border-top: 4px solid black; margin-bottom: 1em;">';
	$message .= '<div>Yth. <b>'.$member.'</b>,</div><br>';
	$message .= '<div>Kami senang untuk memberitahukan bahwa registrasi keanggotaan Anda di website ';
	$message .= 'ICRPedigree telah disetujui. Anda kini dapat mengakses semua fitur dan layanan yang tersedia di situs kami.</div><br>';
	$message .= '<div>Sebagai anggota di situs kami, Anda dapat melakukan pendaftaran generasi pertama, pendaftaran pacak, lahir, dan pembuatan sertifikat untuk anjing kesayangan anda.</div><br>';
	$message .= '<div>Kami mengucapkan terima kasih atas kepercayaan Anda dalam menjadi anggota di situs kami dan berharap Anda dapat menikmati pengalaman menggunakan layanan kami. Jangan ragu untuk menghubungi kami jika Anda memerlukan bantuan atau memiliki pertanyaan lebih lanjut.</div><br>';
	$message .= '<div>Salam,</div><br>';
	$message .= '<div style="margin-bottom: 1em;">Tim ICRPedigree</div>';
	$message .= '<hr style="border-top: 4px solid black; margin-bottom: 1em;">';
	$message .= '<div>Dear <b>'.$member.'</b>,</div><br>';
	$message .= '<div>We are pleased to inform you that your membership registration on the ';
	$message .= 'ICRPedigree website has been approved. You can now access all features and services available on our site.</div><br>';
	$message .= '<div>As a member on our site, you can do first generation registration, stud registration, birth regsitration, and make certificates for your beloved dog.</div><br>';
	$message .= '<div>We thank you for your trust in becoming a member on our site and hope that you will enjoy the experience of using our services. Do not hesitate to contact us if you need assistance or have further questions.</div><br>';
	$message .= '<div>Regards,</div><br>';
	$message .= '<div>ICRPedigree Team</div>';
	$message .= '<hr style="border-top: 4px solid black; margin-top: 1em; margin-bottom: 1em;">';
	$message .= '<div>Address: Cisatu 2 Street 12b, Ciumbuleuit, Bandung</div>';
	$message .= '<div>Contact: +6287777802288</div>';
	$message .= '</div>';
	
	$ci->email->message($message);
	return $ci->email->send();
}

function send_reject($email, $member, $note){
	$ci =& get_instance();

	$ci->load->library('email', $ci->config->item('email'));
	$ci->email->set_newline("\r\n");

	$ci->email->set_mailtype('html');
	$ci->email->from($ci->config->item('email')['smtp_user'], 'ICR Pedigree Customer Service');
	// $ci->email->to($email);
	$ci->email->to("mariorenaldy2@gmail.com");
	$ci->email->subject('Registrasi Keanggotaan di ICRPedigree Ditolak / Membership Registration on ICRPedigree Rejected');

	$message = '<div style="width: 500px; margin: auto; text-align: justify; text-justify: inter-word;">';
	$message .= '<div style="display: flex; align-items:center;">';
	$message .= '<img src="https://icrpedigree.com/assets/img/icr_logo_hitam.png" style="width: 100px; vertical-align: middle;">';
	$message .= '<span style="font-size: 50px; margin: auto;">ICR Pedigree</span>';
	$message .= '</div>';
	$message .= '<hr style="border-top: 4px solid black; margin-bottom: 1em;">';
	$message .= '<div>Yth. <b>'.$member.'</b>,</div><br>';
	$message .= '<div>Mohon maaf, registrasi keanggotaan Anda di website ';
	$message .= 'ICRPedigree tidak disetujui dengan alasan: .</div><br>';
	$message .= '<div>"'.$note.'"</div><br>';
	$message .= '<div>Mohon hubungi kami jika Anda memerlukan bantuan atau memiliki pertanyaan lebih lanjut.</div><br>';
	$message .= '<div>Salam,</div><br>';
	$message .= '<div style="margin-bottom: 1em;">Tim ICRPedigree</div>';
	$message .= '<hr style="border-top: 4px solid black; margin-bottom: 1em;">';
	$message .= '<div>Dear <b>'.$member.'</b>,</div><br>';
	$message .= '<div>We are sorry to inform you that your membership registration on the ';
	$message .= 'ICRPedigree website is not approved because:</div><br>';
	$message .= '<div>"'.$note.'"</div><br>';
	$message .= '<div>Please contact us if you need assistance or have further questions.</div><br>';
	$message .= '<div>Regards,</div><br>';
	$message .= '<div>ICRPedigree Team</div>';
	$message .= '<hr style="border-top: 4px solid black; margin-top: 1em; margin-bottom: 1em;">';
	$message .= '<div>Address: Cisatu 2 Street 12b, Ciumbuleuit, Bandung</div>';
	$message .= '<div>Contact: +6287777802288</div>';
	$message .= '</div>';
	
	$ci->email->message($message);
	return $ci->email->send();
}

function send_paylink($email, $member, $link){
	$ci =& get_instance();

	$ci->load->library('email', $ci->config->item('email'));
	$ci->email->set_newline("\r\n");

	$ci->email->set_mailtype('html');
	$ci->email->from($ci->config->item('email')['smtp_user'], 'ICR Pedigree Customer Service');
	// $ci->email->to($email);
	$ci->email->to("mariorenaldy2@gmail.com");
	$ci->email->subject('Menunggu Pembayaran Registrasi ICRPedigree / Waiting for ICRPedigree Registration Payment');

	$message = '<div style="width: 500px; margin: auto; text-align: justify; text-justify: inter-word;">';
	$message .= '<div style="display: flex; align-items:center;">';
	$message .= '<img src="https://icrpedigree.com/assets/img/icr_logo_hitam.png" style="width: 100px; vertical-align: middle;">';
	$message .= '<span style="font-size: 50px; margin: auto;">ICR Pedigree</span>';
	$message .= '</div>';
	$message .= '<hr style="border-top: 4px solid black; margin-bottom: 1em;">';
	$message .= '<div>Yth. <b>'.$member.'</b>,</div><br>';
	$message .= '<div>Kami ingin memberitahukan bahwa registrasi keanggotaan Anda di website ';
	$message .= 'ICRPedigree masih dalam proses pembayaran. Anda dapat menyelesaikan pembayaran ini melalui link berikut:</div><br>';
	$message .= '<div><a href="'.$link.'" style="color: #E8A317;">Link Pembayaran</a></div><br>';
	$message .= '<div>Jangan ragu untuk menghubungi kami jika Anda memerlukan bantuan atau memiliki pertanyaan lebih lanjut.</div><br>';
	$message .= '<div>Salam,</div><br>';
	$message .= '<div style="margin-bottom: 1em;">Tim ICRPedigree</div>';
	$message .= '<hr style="border-top: 4px solid black; margin-bottom: 1em;">';
	$message .= '<div>Dear <b>'.$member.'</b>,</div><br>';
	$message .= '<div>We want to inform you that your membership registration on the ';
	$message .= 'ICRPedigree website is still in the payment process. You can complete this payment via the following link:</div><br>';
	$message .= '<div><a href="'.$link.'" style="color: #E8A317;">Payment Link</a></div><br>';
	$message .= '<div>Do not hesitate to contact us if you need assistance or have further questions.</div><br>';
	$message .= '<div>Regards,</div><br>';
	$message .= '<div>ICRPedigree Team</div>';
	$message .= '<hr style="border-top: 4px solid black; margin-top: 1em; margin-bottom: 1em;">';
	$message .= '<div>Address: Cisatu 2 Street 12b, Ciumbuleuit, Bandung</div>';
	$message .= '<div>Contact: +6287777802288</div>';
	$message .= '</div>';
	
	$ci->email->message($message);
	return $ci->email->send();
}

function send_birth_link($email, $member, $sire, $dam){
	$ci =& get_instance();

	$ci->load->library('email', $ci->config->item('email'));
	$ci->email->set_newline("\r\n");

	$ci->email->set_mailtype('html');
	$ci->email->from($ci->config->item('email')['smtp_user'], 'ICR Pedigree Customer Service');
	// $ci->email->to($email);
	$ci->email->to("mariorenaldy2@gmail.com");
	$ci->email->subject('Lapor Pacak Disetujui / Stud Report Approved');

	$message = '<div style="width: 500px; margin: auto; text-align: justify; text-justify: inter-word;">';
	$message .= '<div style="display: flex; align-items:center;">';
	$message .= '<img src="https://icrpedigree.com/assets/img/icr_logo_hitam.png" style="width: 100px; vertical-align: middle;">';
	$message .= '<span style="font-size: 50px; margin: auto;">ICR Pedigree</span>';
	$message .= '</div>';
	$message .= '<hr style="border-top: 4px solid black; margin-bottom: 1em;">';
	$message .= '<div>Yth. <b>'.$member.'</b>,</div><br>';
	$message .= '<div>Kami dari tim ICRPedigree ingin memberitahu Anda bahwa pendaftaran pacak anjing antara <b>'.$sire.'</b> dan <b>'.$dam.'</b> telah disetujui. Anda sekarang dapat mendaftarkan laporan lahir setelah <b>'.$ci->config->item('min_jarak_lapor_lahir').' hari</b>.</div><br>';
	$message .= '<div>Kami ingin mengingatkan Anda untuk selalu mematuhi pedoman dan peraturan kami untuk memastikan kesehatan dan keamanan anjing Anda. Pastikan bahwa anjing Anda mendapatkan perawatan yang memadai dan sehat selama masa kehamilan dan setelah melahirkan.</div><br>';
	$message .= '<div>Jika Anda memiliki pertanyaan atau kekhawatiran, jangan ragu untuk menghubungi kami kapan saja.</div><br>';
	$message .= '<div>Terima kasih atas partisipasi Anda dalam program kami.</div><br>';
	$message .= '<div>Salam,</div><br>';
	$message .= '<div>Tim ICRPedigree</div>';
	$message .= '<hr style="border-top: 4px solid black; margin-top: 1em; margin-bottom: 1em;">';
	$message .= '<div>Dear <b>'.$member.'</b>,</div><br>';
	$message .= '<div>We, the ICRPedigree team, would like to inform you that the dog stud registration between <b>'.$sire.'</b> and <b>'.$dam.'</b> has been approved. You can now register birth reports after <b>'.$ci->config->item('min_jarak_lapor_lahir').' days</b>.</div><br>';
	$message .= "<div>We want to remind you to always comply with our guidelines and regulations to ensure your dog's health and safety. Ensure that your dog is adequately cared for and healthy during pregnancy and after delivery.</div><br>";
	$message .= '<div>If you have any questions or concerns, feel free to contact us at any time.</div><br>';
	$message .= '<div>Thank you for your participation in our program.</div><br>';
	$message .= '<div>Regards,</div><br>';
	$message .= '<div>ICRPedigree Team</div>';
	$message .= '<hr style="border-top: 4px solid black; margin-top: 1em; margin-bottom: 1em;">';
	$message .= '<div>Address: Cisatu 2 Street 12b, Ciumbuleuit, Bandung</div>';
	$message .= '<div>Contact: +6287777802288</div>';
	$message .= '</div>';
	
	$ci->email->message($message);
	return $ci->email->send();
}

function send_stambum_link($email, $member, $sire, $dam){
	$ci =& get_instance();

	$ci->load->library('email', $ci->config->item('email'));
	$ci->email->set_newline("\r\n");

	$ci->email->set_mailtype('html');
	$ci->email->from($ci->config->item('email')['smtp_user'], 'ICR Pedigree Customer Service');
	// $ci->email->to($email);
	$ci->email->to("mariorenaldy2@gmail.com");
	$ci->email->subject('Lapor Lahir Disetujui / Birth Report Approved');

	$message = '<div style="width: 500px; margin: auto; text-align: justify; text-justify: inter-word;">';
	$message .= '<div style="display: flex; align-items:center;">';
	$message .= '<img src="https://icrpedigree.com/assets/img/icr_logo_hitam.png" style="width: 100px; vertical-align: middle;">';
	$message .= '<span style="font-size: 50px; margin: auto;">ICR Pedigree</span>';
	$message .= '</div>';
	$message .= '<hr style="border-top: 4px solid black; margin-bottom: 1em;">';
	$message .= '<div>Yth. <b>'.$member.'</b>,</div><br>';
	$message .= '<div>Kami dari tim ICRPedigree ingin memberitahukan Anda bahwa pendaftaran kelahiran anjing hasil pacak antara <b>'.$sire.'</b> dan <b>'.$dam.'</b> telah disetujui. Langkah selanjutnya adalah mendaftarkan nama anak dan pembuatan sertifikat.</div><br>';
	$message .= '<div>Mohon diperhatikan bahwa pendaftaran nama anak dan pembuatan sertifikat harus dilakukan minimal <b>'.$ci->config->item('min_jarak_lapor_anak').' hari</b> setelah tanggal lahir dan batas maksimum <b>'.$ci->config->item('jarak_lapor_anak').' hari</b> dari lahir. Pastikan Anda mematuhi jangka waktu ini untuk memastikan bahwa pendaftaran dilakukan dengan tepat waktu.</div><br>';
	$message .= '<div>Kami ingin mengingatkan Anda untuk memastikan bahwa semua informasi yang diberikan dalam pendaftaran akurat dan sesuai dengan data yang sebenarnya. Hal ini akan membantu kami dalam memastikan bahwa detail informasi anjing yang terdaftar tercetak dengan benar pada sertifikat.</div><br>';
	$message .= '<div>Jika Anda memiliki pertanyaan atau kekhawatiran mengenai pendaftaran, jangan ragu untuk menghubungi kami kapan saja.</div><br>';
	$message .= '<div>Terima kasih atas partisipasi Anda dalam program kami.</div><br>';
	$message .= '<div>Salam,</div><br>';
	$message .= '<div>Tim ICRPedigree</div>';
	$message .= '<hr style="border-top: 4px solid black; margin-top: 1em; margin-bottom: 1em;">';
	$message .= '<div>Dear <b>'.$member.'</b>,</div><br>';
	$message .= '<div>We, the ICRPedigree team, would like to inform you that the registration of birth from the stud between <b>'.$sire.'</b> and <b>'.$dam.'</b> has been approved. The next step is to register the names of the puppies and create a certificate.</div><br>';
	$message .= '<div>Please note that registration of puppies names and certificate creation must be done at least <b>'.$ci->config->item('min_jarak_lapor_anak').' days</b> after the date of birth and a maximum of <b>'.$ci->config->item('jarak_lapor_anak').' days</b> from birth. Make sure you comply with this timeframe to ensure that registration is done in a timely manner.</div><br>';
	$message .= "<div>We would like to remind you to ensure that all information provided in registration is accurate and in accordance with actual data. This will assist us in ensuring that the registered dog's details are printed correctly on the certificate.</div><br>";
	$message .= '<div>If you have any questions or concerns regarding registration, please feel free to contact us at any time.</div><br>';
	$message .= '<div>Thank you for your participation in our program.</div><br>';
	$message .= '<div>Regards,</div><br>';
	$message .= '<div>ICRPedigree Team</div>';
	$message .= '<hr style="border-top: 4px solid black; margin-top: 1em; margin-bottom: 1em;">';
	$message .= '<div>Address: Cisatu 2 Street 12b, Ciumbuleuit, Bandung</div>';
	$message .= '<div>Contact: +6287777802288</div>';
	$message .= '</div>';
	
	$ci->email->message($message);
	return $ci->email->send();
}
?>