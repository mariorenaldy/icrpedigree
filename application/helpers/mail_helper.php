<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

function send_greeting($email, $member){
	$ci =& get_instance();

	$ci->load->library('email', $ci->config->item('email'));
	$ci->email->set_newline("\r\n");

	$ci->email->set_mailtype('html');
	$ci->email->from($ci->config->item('email')['smtp_user'], 'ICR Pedigree Customer Service');
	// $ci->email->to($email);
	$ci->email->to("rizalafriandi01@gmail.com");
	$ci->email->subject('Registrasi Keanggotaan di ICRPedigree Disetujui / Membership Registration on ICRPedigree Approved');

	$message = '<div style="width: 500px; margin: auto; text-align: justify; text-justify: inter-word;">';
	$message .= '<div style="display: flex; align-items:center;">';
	$message .= '<img src="https://icrpedigree.com/assets/img/icr_logo_hitam.png" style="width: 100px; vertical-align: middle;">';
	$message .= '<span style="font-size: 50px; margin: auto;">ICR Pedigree</span>';
	$message .= '</div>';
	$message .= '<hr style="border-top: 4px solid black; margin-bottom: 1em;">';
	$message .= '<div>Yth. <b>'.$member.'</b>,</div><br>';
	$message .= '<div>Dengan senang hati kami informasikan kepada Anda bahwa registrasi keanggotaan Anda di website ';
	$message .= 'ICRPedigree telah disetujui. Anda kini dapat mengakses semua fitur dan layanan yang tersedia di situs kami.</div><br>';
	$message .= '<div>Sebagai anggota di situs kami, Anda dapat melakukan pendaftaran generasi pertama, pendaftaran pacak, lahir, dan pembuatan sertifikat untuk anjing kesayangan Anda.</div><br>';
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
	$ci->email->to("rizalafriandi01@gmail.com");
	$ci->email->subject('Registrasi Keanggotaan di ICRPedigree Ditolak / Membership Registration on ICRPedigree Rejected');

	$message = '<div style="width: 500px; margin: auto; text-align: justify; text-justify: inter-word;">';
	$message .= '<div style="display: flex; align-items:center;">';
	$message .= '<img src="https://icrpedigree.com/assets/img/icr_logo_hitam.png" style="width: 100px; vertical-align: middle;">';
	$message .= '<span style="font-size: 50px; margin: auto;">ICR Pedigree</span>';
	$message .= '</div>';
	$message .= '<hr style="border-top: 4px solid black; margin-bottom: 1em;">';
	$message .= '<div>Yth. <b>'.$member.'</b>,</div><br>';
	$message .= '<div>Mohon maaf, registrasi keanggotaan Anda di website ';
	$message .= 'ICRPedigree tidak disetujui dengan alasan:</div><br>';
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
	$ci->email->to("rizalafriandi01@gmail.com");
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

function send_approve_dog($email, $member, $dog){
	$ci =& get_instance();

	$ci->load->library('email', $ci->config->item('email'));
	$ci->email->set_newline("\r\n");

	$ci->email->set_mailtype('html');
	$ci->email->from($ci->config->item('email')['smtp_user'], 'ICR Pedigree Customer Service');
	// $ci->email->to($email);
	$ci->email->to("rizalafriandi01@gmail.com");
	$ci->email->subject('Pendaftaran Anjing Disetujui / Dog Registration Has Been Approved');

	$message = '<div style="width: 500px; margin: auto; text-align: justify; text-justify: inter-word;">';
	$message .= '<div style="display: flex; align-items:center;">';
	$message .= '<img src="https://icrpedigree.com/assets/img/icr_logo_hitam.png" style="width: 100px; vertical-align: middle;">';
	$message .= '<span style="font-size: 50px; margin: auto;">ICR Pedigree</span>';
	$message .= '</div>';
	$message .= '<hr style="border-top: 4px solid black; margin-bottom: 1em;">';
	$message .= '<div>Yth. <b>'.$member.'</b>,</div><br>';
	$message .= '<div>Dengan senang hati kami informasikan kepada Anda bahwa pendaftaran anjing dengan nama <b>'.$dog.'</b> telah disetujui. Anda kini dapat mengajukan pencetakan sertifikat untuk anjing ini melalui website ICRPedigree.</div><br>';
	$message .= '<div>Salam,</div><br>';
	$message .= '<div style="margin-bottom: 1em;">Tim ICRPedigree</div>';

	$message .= '<hr style="border-top: 4px solid black; margin-bottom: 1em;">';

	$message .= '<div>Dear <b>'.$member.'</b>,</div><br>';
	$message .= '<div>We are pleased to inform you that the registration of the dog with the name <b>'.$dog.'</b> has been approved. You can now request for certificate printing for this dog via the ICRPedigree website.</div><br>';
	$message .= '<div>Regards,</div><br>';
	$message .= '<div>ICRPedigree Team</div>';
	$message .= '<hr style="border-top: 4px solid black; margin-top: 1em; margin-bottom: 1em;">';
	$message .= '<div>Address: Cisatu 2 Street 12b, Ciumbuleuit, Bandung</div>';
	$message .= '<div>Contact: +6287777802288</div>';
	$message .= '</div>';
	
	$ci->email->message($message);
	return $ci->email->send();
}

function send_reject_dog($email, $member, $dog, $reason){
	$ci =& get_instance();

	$ci->load->library('email', $ci->config->item('email'));
	$ci->email->set_newline("\r\n");

	$ci->email->set_mailtype('html');
	$ci->email->from($ci->config->item('email')['smtp_user'], 'ICR Pedigree Customer Service');
	// $ci->email->to($email);
	$ci->email->to("rizalafriandi01@gmail.com");
	$ci->email->subject('Pendaftaran Anjing Ditolak / Dog Registration Has Been Rejected');

	$message = '<div style="width: 500px; margin: auto; text-align: justify; text-justify: inter-word;">';
	$message .= '<div style="display: flex; align-items:center;">';
	$message .= '<img src="https://icrpedigree.com/assets/img/icr_logo_hitam.png" style="width: 100px; vertical-align: middle;">';
	$message .= '<span style="font-size: 50px; margin: auto;">ICR Pedigree</span>';
	$message .= '</div>';
	$message .= '<hr style="border-top: 4px solid black; margin-bottom: 1em;">';
	$message .= '<div>Yth. <b>'.$member.'</b>,</div><br>';
	$message .= '<div>Mohon maaf, pendaftaran anjing dengan nama <b>'.$dog.'</b> telah ditolak dengan alasan:</div><br>';
	$message .= '<div>"'.$reason.'"</div><br>';
	$message .= '<div>Mohon hubungi kami jika Anda memerlukan bantuan atau memiliki pertanyaan lebih lanjut.</div><br>';
	$message .= '<div>Salam,</div><br>';
	$message .= '<div style="margin-bottom: 1em;">Tim ICRPedigree</div>';

	$message .= '<hr style="border-top: 4px solid black; margin-bottom: 1em;">';

	$message .= '<div>Dear <b>'.$member.'</b>,</div><br>';
	$message .= '<div>We are sorry to inform you that the registration of a dog with the name <b>'.$puppy.'</b> has been rejected because:</div><br>';
	$message .= '<div>"'.$reason.'"</div><br>';
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

function send_birth_link($email, $member, $sire, $dam){
	$ci =& get_instance();

	$ci->load->library('email', $ci->config->item('email'));
	$ci->email->set_newline("\r\n");

	$ci->email->set_mailtype('html');
	$ci->email->from($ci->config->item('email')['smtp_user'], 'ICR Pedigree Customer Service');
	// $ci->email->to($email);
	$ci->email->to("rizalafriandi01@gmail.com");
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

function send_reject_stud($email, $member, $sire, $dam, $reason){
	$ci =& get_instance();

	$ci->load->library('email', $ci->config->item('email'));
	$ci->email->set_newline("\r\n");

	$ci->email->set_mailtype('html');
	$ci->email->from($ci->config->item('email')['smtp_user'], 'ICR Pedigree Customer Service');
	// $ci->email->to($email);
	$ci->email->to("rizalafriandi01@gmail.com");
	$ci->email->subject('Lapor Pacak Ditolak / Stud Report Rejected');

	$message = '<div style="width: 500px; margin: auto; text-align: justify; text-justify: inter-word;">';
	$message .= '<div style="display: flex; align-items:center;">';
	$message .= '<img src="https://icrpedigree.com/assets/img/icr_logo_hitam.png" style="width: 100px; vertical-align: middle;">';
	$message .= '<span style="font-size: 50px; margin: auto;">ICR Pedigree</span>';
	$message .= '</div>';
	$message .= '<hr style="border-top: 4px solid black; margin-bottom: 1em;">';
	$message .= '<div>Yth. <b>'.$member.'</b>,</div><br>';
	$message .= '<div>Mohon maaf, laporan pacak anjing antara <b>'.$sire.'</b> dan <b>'.$dam.'</b> telah ditolak dengan alasan:</div><br>';
	$message .= '<div>"'.$reason.'"</div><br>';
	$message .= '<div>Mohon hubungi kami jika Anda memerlukan bantuan atau memiliki pertanyaan lebih lanjut.</div><br>';
	$message .= '<div>Salam,</div><br>';
	$message .= '<div style="margin-bottom: 1em;">Tim ICRPedigree</div>';

	$message .= '<hr style="border-top: 4px solid black; margin-bottom: 1em;">';

	$message .= '<div>Dear <b>'.$member.'</b>,</div><br>';
	$message .= '<div>We are sorry to inform you that the dog stud report between <b>'.$sire.'</b> and <b>'.$dam.'</b> has been rejected because:</div><br>';
	$message .= '<div>"'.$reason.'"</div><br>';
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

function send_stambum_link($email, $member, $sire, $dam){
	$ci =& get_instance();

	$ci->load->library('email', $ci->config->item('email'));
	$ci->email->set_newline("\r\n");

	$ci->email->set_mailtype('html');
	$ci->email->from($ci->config->item('email')['smtp_user'], 'ICR Pedigree Customer Service');
	// $ci->email->to($email);
	$ci->email->to("rizalafriandi01@gmail.com");
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

function send_reject_birth($email, $member, $sire, $dam, $reason){
	$ci =& get_instance();

	$ci->load->library('email', $ci->config->item('email'));
	$ci->email->set_newline("\r\n");

	$ci->email->set_mailtype('html');
	$ci->email->from($ci->config->item('email')['smtp_user'], 'ICR Pedigree Customer Service');
	// $ci->email->to($email);
	$ci->email->to("rizalafriandi01@gmail.com");
	$ci->email->subject('Lapor Lahir Ditolak / Birth Report Rejected');

	$message = '<div style="width: 500px; margin: auto; text-align: justify; text-justify: inter-word;">';
	$message .= '<div style="display: flex; align-items:center;">';
	$message .= '<img src="https://icrpedigree.com/assets/img/icr_logo_hitam.png" style="width: 100px; vertical-align: middle;">';
	$message .= '<span style="font-size: 50px; margin: auto;">ICR Pedigree</span>';
	$message .= '</div>';
	$message .= '<hr style="border-top: 4px solid black; margin-bottom: 1em;">';
	$message .= '<div>Yth. <b>'.$member.'</b>,</div><br>';
	$message .= '<div>Mohon maaf, laporan kelahiran anjing dari hasil pacak antara <b>'.$sire.'</b> dan <b>'.$dam.'</b> telah ditolak dengan alasan:</div><br>';
	$message .= '<div>"'.$reason.'"</div><br>';
	$message .= '<div>Mohon hubungi kami jika Anda memerlukan bantuan atau memiliki pertanyaan lebih lanjut.</div><br>';
	$message .= '<div>Salam,</div><br>';
	$message .= '<div style="margin-bottom: 1em;">Tim ICRPedigree</div>';

	$message .= '<hr style="border-top: 4px solid black; margin-bottom: 1em;">';

	$message .= '<div>Dear <b>'.$member.'</b>,</div><br>';
	$message .= '<div>We are sorry to inform you that the dog birth report from the stud between <b>'.$sire.'</b> and <b>'.$dam.'</b> has been rejected because:</div><br>';
	$message .= '<div>"'.$reason.'"</div><br>';
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

function send_approve_puppy($email, $member, $puppy){
	$ci =& get_instance();

	$ci->load->library('email', $ci->config->item('email'));
	$ci->email->set_newline("\r\n");

	$ci->email->set_mailtype('html');
	$ci->email->from($ci->config->item('email')['smtp_user'], 'ICR Pedigree Customer Service');
	// $ci->email->to($email);
	$ci->email->to("rizalafriandi01@gmail.com");
	$ci->email->subject('Pendaftaran Anak Anjing Disetujui / Puppy Registration Has Been Approved');

	$message = '<div style="width: 500px; margin: auto; text-align: justify; text-justify: inter-word;">';
	$message .= '<div style="display: flex; align-items:center;">';
	$message .= '<img src="https://icrpedigree.com/assets/img/icr_logo_hitam.png" style="width: 100px; vertical-align: middle;">';
	$message .= '<span style="font-size: 50px; margin: auto;">ICR Pedigree</span>';
	$message .= '</div>';
	$message .= '<hr style="border-top: 4px solid black; margin-bottom: 1em;">';
	$message .= '<div>Yth. <b>'.$member.'</b>,</div><br>';
	$message .= '<div>Dengan senang hati kami informasikan kepada Anda bahwa pendaftaran anak anjing dengan nama <b>'.$puppy.'</b> telah disetujui. Anda kini dapat mengajukan pencetakan sertifikat untuk anak anjing ini melalui website ICRPedigree.</div><br>';
	$message .= '<div>Salam,</div><br>';
	$message .= '<div style="margin-bottom: 1em;">Tim ICRPedigree</div>';

	$message .= '<hr style="border-top: 4px solid black; margin-bottom: 1em;">';

	$message .= '<div>Dear <b>'.$member.'</b>,</div><br>';
	$message .= '<div>We are pleased to inform you that the registration of the puppy with the name <b>'.$puppy.'</b> has been approved. You can now request for certificate printing for this puppy via the ICRPedigree website.</div><br>';
	$message .= '<div>Regards,</div><br>';
	$message .= '<div>ICRPedigree Team</div>';
	$message .= '<hr style="border-top: 4px solid black; margin-top: 1em; margin-bottom: 1em;">';
	$message .= '<div>Address: Cisatu 2 Street 12b, Ciumbuleuit, Bandung</div>';
	$message .= '<div>Contact: +6287777802288</div>';
	$message .= '</div>';
	
	$ci->email->message($message);
	return $ci->email->send();
}

function send_reject_puppy($email, $member, $puppy, $reason){
	$ci =& get_instance();

	$ci->load->library('email', $ci->config->item('email'));
	$ci->email->set_newline("\r\n");

	$ci->email->set_mailtype('html');
	$ci->email->from($ci->config->item('email')['smtp_user'], 'ICR Pedigree Customer Service');
	// $ci->email->to($email);
	$ci->email->to("rizalafriandi01@gmail.com");
	$ci->email->subject('Pendaftaran Anak Anjing Ditolak / Puppy Registration Has Been Rejected');

	$message = '<div style="width: 500px; margin: auto; text-align: justify; text-justify: inter-word;">';
	$message .= '<div style="display: flex; align-items:center;">';
	$message .= '<img src="https://icrpedigree.com/assets/img/icr_logo_hitam.png" style="width: 100px; vertical-align: middle;">';
	$message .= '<span style="font-size: 50px; margin: auto;">ICR Pedigree</span>';
	$message .= '</div>';
	$message .= '<hr style="border-top: 4px solid black; margin-bottom: 1em;">';
	$message .= '<div>Yth. <b>'.$member.'</b>,</div><br>';
	$message .= '<div>Mohon maaf, pendaftaran anak anjing dengan nama <b>'.$puppy.'</b> telah ditolak dengan alasan:</div><br>';
	$message .= '<div>"'.$reason.'"</div><br>';
	$message .= '<div>Mohon hubungi kami jika Anda memerlukan bantuan atau memiliki pertanyaan lebih lanjut.</div><br>';
	$message .= '<div>Salam,</div><br>';
	$message .= '<div style="margin-bottom: 1em;">Tim ICRPedigree</div>';

	$message .= '<hr style="border-top: 4px solid black; margin-bottom: 1em;">';

	$message .= '<div>Dear <b>'.$member.'</b>,</div><br>';
	$message .= '<div>We are sorry to inform you that the registration of a puppy with the name <b>'.$puppy.'</b> has been rejected because:</div><br>';
	$message .= '<div>"'.$reason.'"</div><br>';
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
//certificate emails
function send_deliver_certificate($email, $member, $dog){
	$ci =& get_instance();

	$ci->load->library('email', $ci->config->item('email'));
	$ci->email->set_newline("\r\n");

	$ci->email->set_mailtype('html');
	$ci->email->from($ci->config->item('email')['smtp_user'], 'ICR Pedigree Customer Service');
	// $ci->email->to($email);
	$ci->email->to("rizalafriandi01@gmail.com");
	$ci->email->subject('Sertifikat Anjing Anda Sedang Dikirim / Your Dog Certificate Is Being Delivered');

	$message = '<div style="width: 500px; margin: auto; text-align: justify; text-justify: inter-word;">';
	$message .= '<div style="display: flex; align-items:center;">';
	$message .= '<img src="https://icrpedigree.com/assets/img/icr_logo_hitam.png" style="width: 100px; vertical-align: middle;">';
	$message .= '<span style="font-size: 50px; margin: auto;">ICR Pedigree</span>';
	$message .= '</div>';
	$message .= '<hr style="border-top: 4px solid black; margin-bottom: 1em;">';
	$message .= '<div>Yth. <b>'.$member.'</b>,</div><br>';
	$message .= '<div>Kami ingin memberitahu Anda bahwa sertifikat untuk anjing Anda dengan nama <b>'.$dog.'</b> sedang dikirim.</div><br>';
	$message .= '<div>Jangan ragu untuk menghubungi kami jika Anda memerlukan bantuan atau memiliki pertanyaan lebih lanjut.</div><br>';
	$message .= '<div>Salam,</div><br>';
	$message .= '<div>Tim ICRPedigree</div>';

	$message .= '<hr style="border-top: 4px solid black; margin-top: 1em; margin-bottom: 1em;">';
	
	$message .= '<div>Dear <b>'.$member.'</b>,</div><br>';
	$message .= '<div>We want to inform you that the certificate for your dog with the name <b>'.$dog.'</b> is being delivered.</div><br>';
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

function send_arrived_certificate($email, $member, $dog, $address){
	$ci =& get_instance();

	$ci->load->library('email', $ci->config->item('email'));
	$ci->email->set_newline("\r\n");

	$ci->email->set_mailtype('html');
	$ci->email->from($ci->config->item('email')['smtp_user'], 'ICR Pedigree Customer Service');
	// $ci->email->to($email);
	$ci->email->to("rizalafriandi01@gmail.com");
	$ci->email->subject('Sertifikat Anjing Anda Telah Sampai Pada Tujuan / Your Dog Certificate Has Arrived At Its Destination');

	$message = '<div style="width: 500px; margin: auto; text-align: justify; text-justify: inter-word;">';
	$message .= '<div style="display: flex; align-items:center;">';
	$message .= '<img src="https://icrpedigree.com/assets/img/icr_logo_hitam.png" style="width: 100px; vertical-align: middle;">';
	$message .= '<span style="font-size: 50px; margin: auto;">ICR Pedigree</span>';
	$message .= '</div>';
	$message .= '<hr style="border-top: 4px solid black; margin-bottom: 1em;">';
	$message .= '<div>Yth. <b>'.$member.'</b>,</div><br>';
	$message .= '<div>Kami ingin memberitahu Anda bahwa sertifikat untuk anjing Anda dengan nama <b>'.$dog.'</b> telah sampai pada alamat <b>'.$address.'</b>.</div><br>';
	$message .= '<div>Jangan ragu untuk menghubungi kami jika Anda memerlukan bantuan atau memiliki pertanyaan lebih lanjut.</div><br>';
	$message .= '<div>Salam,</div><br>';
	$message .= '<div>Tim ICRPedigree</div>';

	$message .= '<hr style="border-top: 4px solid black; margin-top: 1em; margin-bottom: 1em;">';
	
	$message .= '<div>Dear <b>'.$member.'</b>,</div><br>';
	$message .= '<div>We want to inform you that the certificate for your dog with the name <b>'.$dog.'</b> has arrived at <b>'.$address.'</b>.</div><br>';
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

function send_reject_certificate($email, $member, $dog, $reason){
	$ci =& get_instance();

	$ci->load->library('email', $ci->config->item('email'));
	$ci->email->set_newline("\r\n");

	$ci->email->set_mailtype('html');
	$ci->email->from($ci->config->item('email')['smtp_user'], 'ICR Pedigree Customer Service');
	// $ci->email->to($email);
	$ci->email->to("rizalafriandi01@gmail.com");
	$ci->email->subject('Permintaan Cetak Sertifikat Anjing Anda Ditolak / Your Certificate Print Request Has Been Rejected');

	$message = '<div style="width: 500px; margin: auto; text-align: justify; text-justify: inter-word;">';
	$message .= '<div style="display: flex; align-items:center;">';
	$message .= '<img src="https://icrpedigree.com/assets/img/icr_logo_hitam.png" style="width: 100px; vertical-align: middle;">';
	$message .= '<span style="font-size: 50px; margin: auto;">ICR Pedigree</span>';
	$message .= '</div>';
	$message .= '<hr style="border-top: 4px solid black; margin-bottom: 1em;">';
	$message .= '<div>Yth. <b>'.$member.'</b>,</div><br>';
	$message .= '<div>Mohon maaf, permintaan cetak sertifikat untuk anjing Anda dengan nama <b>'.$dog.'</b> telah ditolak dengan alasan:</div><br>';
	$message .= '<div>"'.$reason.'"</div><br>';
	$message .= '<div>Mohon hubungi kami jika Anda memerlukan bantuan atau memiliki pertanyaan lebih lanjut.</div><br>';
	$message .= '<div>Salam,</div><br>';
	$message .= '<div style="margin-bottom: 1em;">Tim ICRPedigree</div>';

	$message .= '<hr style="border-top: 4px solid black; margin-bottom: 1em;">';

	$message .= '<div>Dear <b>'.$member.'</b>,</div><br>';
	$message .= '<div>We are sorry to inform you that the certificate print request for your dog with the name <b>'.$dog.'</b> has been rejected because:</div><br>';
	$message .= '<div>"'.$reason.'"</div><br>';
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

//microchip emails
function send_approve_microchip($email, $member, $dog, $ind_date, $eng_date, $time){
	$ci =& get_instance();

	$ci->load->library('email', $ci->config->item('email'));
	$ci->email->set_newline("\r\n");

	$ci->email->set_mailtype('html');
	$ci->email->from($ci->config->item('email')['smtp_user'], 'ICR Pedigree Customer Service');
	// $ci->email->to($email);
	$ci->email->to("rizalafriandi01@gmail.com");
	$ci->email->subject('Permintaan Pemasangan Microchip Anda Disetujui / Your Microchip Implant Request Has Been Approved');

	$message = '<div style="width: 500px; margin: auto; text-align: justify; text-justify: inter-word;">';
	$message .= '<div style="display: flex; align-items:center;">';
	$message .= '<img src="https://icrpedigree.com/assets/img/icr_logo_hitam.png" style="width: 100px; vertical-align: middle;">';
	$message .= '<span style="font-size: 50px; margin: auto;">ICR Pedigree</span>';
	$message .= '</div>';
	$message .= '<hr style="border-top: 4px solid black; margin-bottom: 1em;">';
	$message .= '<div>Yth. <b>'.$member.'</b>,</div><br>';
	$message .= '<div>Kami ingin memberitahu Anda bahwa janji pemasangan microchip pada tanggal <b>'.$ind_date.'</b> jam <b>'.$time.'</b> untuk anjing Anda dengan nama <b>'.$dog.'</b> telah disetujui.</div><br>';
	$message .= '<div>Mohon datang dan bawa anjing Anda ke kantor ICR pada tanggal dan waktu yang telah ditentukan.</div><br>';
	$message .= '<div>Jangan ragu untuk menghubungi kami jika Anda memerlukan bantuan atau memiliki pertanyaan lebih lanjut.</div><br>';
	$message .= '<div>Salam,</div><br>';
	$message .= '<div>Tim ICRPedigree</div>';

	$message .= '<hr style="border-top: 4px solid black; margin-top: 1em; margin-bottom: 1em;">';
	
	$message .= '<div>Dear <b>'.$member.'</b>,</div><br>';
	$message .= '<div>We want to inform you that the microchip implant appointment on <b>'.$eng_date.'</b> at <b>'.$time.'</b> for your dog with the name <b>'.$dog.'</b> has been approved.</div><br>';
	$message .= '<div>Please come and bring your dog to the ICR office on the specified date and time.</div><br>';
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

function send_implanted_microchip($email, $member, $dog){
	$ci =& get_instance();

	$ci->load->library('email', $ci->config->item('email'));
	$ci->email->set_newline("\r\n");

	$ci->email->set_mailtype('html');
	$ci->email->from($ci->config->item('email')['smtp_user'], 'ICR Pedigree Customer Service');
	// $ci->email->to($email);
	$ci->email->to("rizalafriandi01@gmail.com");
	$ci->email->subject('Microchip Anjing Anda Telah Dipasang / Your Dog Microchip Has Been Implanted');

	$message = '<div style="width: 500px; margin: auto; text-align: justify; text-justify: inter-word;">';
	$message .= '<div style="display: flex; align-items:center;">';
	$message .= '<img src="https://icrpedigree.com/assets/img/icr_logo_hitam.png" style="width: 100px; vertical-align: middle;">';
	$message .= '<span style="font-size: 50px; margin: auto;">ICR Pedigree</span>';
	$message .= '</div>';
	$message .= '<hr style="border-top: 4px solid black; margin-bottom: 1em;">';
	$message .= '<div>Yth. <b>'.$member.'</b>,</div><br>';
	$message .= '<div>Kami ingin memberitahu Anda bahwa pemasangan microchip untuk anjing Anda dengan nama <b>'.$dog.'</b> telah selesai dilakukan.</div><br>';
	$message .= '<div>Jangan ragu untuk menghubungi kami jika Anda memerlukan bantuan atau memiliki pertanyaan lebih lanjut.</div><br>';
	$message .= '<div>Salam,</div><br>';
	$message .= '<div>Tim ICRPedigree</div>';

	$message .= '<hr style="border-top: 4px solid black; margin-top: 1em; margin-bottom: 1em;">';
	
	$message .= '<div>Dear <b>'.$member.'</b>,</div><br>';
	$message .= '<div>We want to inform you that the microchip implant for your dog with the name <b>'.$dog.'</b> has been done.</div><br>';
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

function send_reject_microchip($email, $member, $dog, $reason){
	$ci =& get_instance();

	$ci->load->library('email', $ci->config->item('email'));
	$ci->email->set_newline("\r\n");

	$ci->email->set_mailtype('html');
	$ci->email->from($ci->config->item('email')['smtp_user'], 'ICR Pedigree Customer Service');
	// $ci->email->to($email);
	$ci->email->to("rizalafriandi01@gmail.com");
	$ci->email->subject('Permintaan Pemasangan Microchip Anjing Anda Ditolak / Your Dog Microchip Implant Request Has Been Rejected');

	$message = '<div style="width: 500px; margin: auto; text-align: justify; text-justify: inter-word;">';
	$message .= '<div style="display: flex; align-items:center;">';
	$message .= '<img src="https://icrpedigree.com/assets/img/icr_logo_hitam.png" style="width: 100px; vertical-align: middle;">';
	$message .= '<span style="font-size: 50px; margin: auto;">ICR Pedigree</span>';
	$message .= '</div>';
	$message .= '<hr style="border-top: 4px solid black; margin-bottom: 1em;">';
	$message .= '<div>Yth. <b>'.$member.'</b>,</div><br>';
	$message .= '<div>Mohon maaf, permintaan pemasangan microchip untuk anjing Anda dengan nama <b>'.$dog.'</b> telah ditolak dengan alasan:</div><br>';
	$message .= '<div>"'.$reason.'"</div><br>';
	$message .= '<div>Mohon hubungi kami jika Anda memerlukan bantuan atau memiliki pertanyaan lebih lanjut.</div><br>';
	$message .= '<div>Salam,</div><br>';
	$message .= '<div style="margin-bottom: 1em;">Tim ICRPedigree</div>';

	$message .= '<hr style="border-top: 4px solid black; margin-bottom: 1em;">';

	$message .= '<div>Dear <b>'.$member.'</b>,</div><br>';
	$message .= '<div>We are sorry to inform you that the microchip implant request for your dog with the name <b>'.$dog.'</b> has been rejected because:</div><br>';
	$message .= '<div>"'.$reason.'"</div><br>';
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

//order emails
function send_deliver_order($email, $member, $invoice){
	$ci =& get_instance();

	$ci->load->library('email', $ci->config->item('email'));
	$ci->email->set_newline("\r\n");

	$ci->email->set_mailtype('html');
	$ci->email->from($ci->config->item('email')['smtp_user'], 'ICR Pedigree Customer Service');
	// $ci->email->to($email);
	$ci->email->to("rizalafriandi01@gmail.com");
	$ci->email->subject('Pesanan Anda Sedang Dikirim / Your Order Is Being Delivered');

	$message = '<div style="width: 500px; margin: auto; text-align: justify; text-justify: inter-word;">';
	$message .= '<div style="display: flex; align-items:center;">';
	$message .= '<img src="https://icrpedigree.com/assets/img/icr_logo_hitam.png" style="width: 100px; vertical-align: middle;">';
	$message .= '<span style="font-size: 50px; margin: auto;">ICR Pedigree</span>';
	$message .= '</div>';
	$message .= '<hr style="border-top: 4px solid black; margin-bottom: 1em;">';
	$message .= '<div>Yth. <b>'.$member.'</b>,</div><br>';
	$message .= '<div>Kami ingin memberitahu Anda bahwa pesanan Anda dengan nomor invoice <b>'.$invoice.'</b> sedang dikirim.</div><br>';
	$message .= '<div>Jangan ragu untuk menghubungi kami jika Anda memerlukan bantuan atau memiliki pertanyaan lebih lanjut.</div><br>';
	$message .= '<div>Salam,</div><br>';
	$message .= '<div>Tim ICRPedigree</div>';

	$message .= '<hr style="border-top: 4px solid black; margin-top: 1em; margin-bottom: 1em;">';
	
	$message .= '<div>Dear <b>'.$member.'</b>,</div><br>';
	$message .= '<div>We want to inform you that your order with the invoice number <b>'.$invoice.'</b> is being delivered.</div><br>';
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

function send_arrived_order($email, $member, $invoice, $address){
	$ci =& get_instance();

	$ci->load->library('email', $ci->config->item('email'));
	$ci->email->set_newline("\r\n");

	$ci->email->set_mailtype('html');
	$ci->email->from($ci->config->item('email')['smtp_user'], 'ICR Pedigree Customer Service');
	// $ci->email->to($email);
	$ci->email->to("rizalafriandi01@gmail.com");
	$ci->email->subject('Pesanan Anda Telah Sampai Pada Tujuan / Your Order Has Arrived At Its Destination');

	$message = '<div style="width: 500px; margin: auto; text-align: justify; text-justify: inter-word;">';
	$message .= '<div style="display: flex; align-items:center;">';
	$message .= '<img src="https://icrpedigree.com/assets/img/icr_logo_hitam.png" style="width: 100px; vertical-align: middle;">';
	$message .= '<span style="font-size: 50px; margin: auto;">ICR Pedigree</span>';
	$message .= '</div>';
	$message .= '<hr style="border-top: 4px solid black; margin-bottom: 1em;">';
	$message .= '<div>Yth. <b>'.$member.'</b>,</div><br>';
	$message .= '<div>Kami ingin memberitahu Anda bahwa pesanan Anda dengan nomor invoice <b>'.$invoice.'</b> telah sampai pada alamat <b>'.$address.'</b>.</div><br>';
	$message .= '<div>Jangan ragu untuk menghubungi kami jika Anda memerlukan bantuan atau memiliki pertanyaan lebih lanjut.</div><br>';
	$message .= '<div>Salam,</div><br>';
	$message .= '<div>Tim ICRPedigree</div>';

	$message .= '<hr style="border-top: 4px solid black; margin-top: 1em; margin-bottom: 1em;">';
	
	$message .= '<div>Dear <b>'.$member.'</b>,</div><br>';
	$message .= '<div>We want to inform you that your order with the invoice number <b>'.$invoice.'</b> has arrived at <b>'.$address.'</b>.</div><br>';
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

function send_reject_order($email, $member, $invoice, $reason){
	$ci =& get_instance();

	$ci->load->library('email', $ci->config->item('email'));
	$ci->email->set_newline("\r\n");

	$ci->email->set_mailtype('html');
	$ci->email->from($ci->config->item('email')['smtp_user'], 'ICR Pedigree Customer Service');
	// $ci->email->to($email);
	$ci->email->to("rizalafriandi01@gmail.com");
	$ci->email->subject('Pesanan Anda Ditolak / Your Order Has Been Rejected');

	$message = '<div style="width: 500px; margin: auto; text-align: justify; text-justify: inter-word;">';
	$message .= '<div style="display: flex; align-items:center;">';
	$message .= '<img src="https://icrpedigree.com/assets/img/icr_logo_hitam.png" style="width: 100px; vertical-align: middle;">';
	$message .= '<span style="font-size: 50px; margin: auto;">ICR Pedigree</span>';
	$message .= '</div>';
	$message .= '<hr style="border-top: 4px solid black; margin-bottom: 1em;">';
	$message .= '<div>Yth. <b>'.$member.'</b>,</div><br>';
	$message .= '<div>Mohon maaf, pesanan Anda dengan nomor invoice <b>'.$invoice.'</b> telah ditolak dengan alasan:</div><br>';
	$message .= '<div>"'.$reason.'"</div><br>';
	$message .= '<div>Mohon hubungi kami jika Anda memerlukan bantuan atau memiliki pertanyaan lebih lanjut.</div><br>';
	$message .= '<div>Salam,</div><br>';
	$message .= '<div style="margin-bottom: 1em;">Tim ICRPedigree</div>';

	$message .= '<hr style="border-top: 4px solid black; margin-bottom: 1em;">';

	$message .= '<div>Dear <b>'.$member.'</b>,</div><br>';
	$message .= '<div>We are sorry to inform you that your order with the invoice number <b>'.$invoice.'</b> has been rejected because:</div><br>';
	$message .= '<div>"'.$reason.'"</div><br>';
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

//kennel update
function send_approve_kennel_update($email, $member){
	$ci =& get_instance();

	$ci->load->library('email', $ci->config->item('email'));
	$ci->email->set_newline("\r\n");

	$ci->email->set_mailtype('html');
	$ci->email->from($ci->config->item('email')['smtp_user'], 'ICR Pedigree Customer Service');
	// $ci->email->to($email);
	$ci->email->to("rizalafriandi01@gmail.com");
	$ci->email->subject('Pengubahan Data Kennel Disetujui / Kennel Data Change Approved');

	$message = '<div style="width: 500px; margin: auto; text-align: justify; text-justify: inter-word;">';
	$message .= '<div style="display: flex; align-items:center;">';
	$message .= '<img src="https://icrpedigree.com/assets/img/icr_logo_hitam.png" style="width: 100px; vertical-align: middle;">';
	$message .= '<span style="font-size: 50px; margin: auto;">ICR Pedigree</span>';
	$message .= '</div>';
	$message .= '<hr style="border-top: 4px solid black; margin-bottom: 1em;">';
	$message .= '<div>Yth. <b>'.$member.'</b>,</div><br>';
	$message .= '<div>Kami ingin menginformasikan bahwa pengubahan data kennel Anda telah disetujui.</div><br>';
	$message .= '<div>Salam,</div><br>';
	$message .= '<div style="margin-bottom: 1em;">Tim ICRPedigree</div>';

	$message .= '<hr style="border-top: 4px solid black; margin-bottom: 1em;">';

	$message .= '<div>Dear <b>'.$member.'</b>,</div><br>';
	$message .= '<div>We would like to inform you that your kennel data change has been approved.</div><br>';
	$message .= '<div>Regards,</div><br>';
	$message .= '<div>ICRPedigree Team</div>';
	$message .= '<hr style="border-top: 4px solid black; margin-top: 1em; margin-bottom: 1em;">';
	$message .= '<div>Address: Cisatu 2 Street 12b, Ciumbuleuit, Bandung</div>';
	$message .= '<div>Contact: +6287777802288</div>';
	$message .= '</div>';
	
	$ci->email->message($message);
	return $ci->email->send();
}

function send_reject_kennel_update($email, $member, $reason){
	$ci =& get_instance();

	$ci->load->library('email', $ci->config->item('email'));
	$ci->email->set_newline("\r\n");

	$ci->email->set_mailtype('html');
	$ci->email->from($ci->config->item('email')['smtp_user'], 'ICR Pedigree Customer Service');
	// $ci->email->to($email);
	$ci->email->to("rizalafriandi01@gmail.com");
	$ci->email->subject('Pengubahan Data Kennel Ditolak / Kennel Data Change Rejected');

	$message = '<div style="width: 500px; margin: auto; text-align: justify; text-justify: inter-word;">';
	$message .= '<div style="display: flex; align-items:center;">';
	$message .= '<img src="https://icrpedigree.com/assets/img/icr_logo_hitam.png" style="width: 100px; vertical-align: middle;">';
	$message .= '<span style="font-size: 50px; margin: auto;">ICR Pedigree</span>';
	$message .= '</div>';
	$message .= '<hr style="border-top: 4px solid black; margin-bottom: 1em;">';
	$message .= '<div>Yth. <b>'.$member.'</b>,</div><br>';
	$message .= '<div>Mohon maaf, pengubahan data kennel Anda ditolak dengan alasan:</div><br>';
	$message .= '<div>"'.$reason.'"</div><br>';
	$message .= '<div>Mohon hubungi kami jika Anda memerlukan bantuan atau memiliki pertanyaan lebih lanjut.</div><br>';
	$message .= '<div>Salam,</div><br>';
	$message .= '<div style="margin-bottom: 1em;">Tim ICRPedigree</div>';

	$message .= '<hr style="border-top: 4px solid black; margin-bottom: 1em;">';

	$message .= '<div>Dear <b>'.$member.'</b>,</div><br>';
	$message .= '<div>We are sorry to inform you that your kennel data change has been rejected because:</div><br>';
	$message .= '<div>"'.$reason.'"</div><br>';
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

//become pro
function send_approve_pro($email, $member){
	$ci =& get_instance();

	$ci->load->library('email', $ci->config->item('email'));
	$ci->email->set_newline("\r\n");

	$ci->email->set_mailtype('html');
	$ci->email->from($ci->config->item('email')['smtp_user'], 'ICR Pedigree Customer Service');
	// $ci->email->to($email);
	$ci->email->to("rizalafriandi01@gmail.com");
	$ci->email->subject('Menjadi Member Pro Disetujui / Become Pro Member Approved');

	$message = '<div style="width: 500px; margin: auto; text-align: justify; text-justify: inter-word;">';
	$message .= '<div style="display: flex; align-items:center;">';
	$message .= '<img src="https://icrpedigree.com/assets/img/icr_logo_hitam.png" style="width: 100px; vertical-align: middle;">';
	$message .= '<span style="font-size: 50px; margin: auto;">ICR Pedigree</span>';
	$message .= '</div>';
	$message .= '<hr style="border-top: 4px solid black; margin-bottom: 1em;">';
	$message .= '<div>Yth. <b>'.$member.'</b>,</div><br>';
	$message .= '<div>Dengan senang hati kami informasikan kepada Anda bahwa permintaan Anda untuk mengubah jenis keanggotaan menjadi Member Pro di website ';
	$message .= 'ICRPedigree telah disetujui. Anda kini dapat mengakses semua fitur dan layanan yang tersedia di situs kami.</div><br>';
	$message .= '<div>Sebagai anggota di situs kami, Anda dapat melakukan pendaftaran generasi pertama, pendaftaran pacak, lahir, dan pembuatan sertifikat untuk anjing kesayangan Anda.</div><br>';
	$message .= '<div>Kami mengucapkan terima kasih atas kepercayaan Anda dalam menjadi anggota di situs kami dan berharap Anda dapat menikmati pengalaman menggunakan layanan kami. Jangan ragu untuk menghubungi kami jika Anda memerlukan bantuan atau memiliki pertanyaan lebih lanjut.</div><br>';
	$message .= '<div>Salam,</div><br>';
	$message .= '<div style="margin-bottom: 1em;">Tim ICRPedigree</div>';

	$message .= '<hr style="border-top: 4px solid black; margin-bottom: 1em;">';
	
	$message .= '<div>Dear <b>'.$member.'</b>,</div><br>';
	$message .= '<div>We are pleased to inform you that your request to change your membership type to Member Pro on the ';
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

function send_reject_pro($email, $member, $reason){
	$ci =& get_instance();

	$ci->load->library('email', $ci->config->item('email'));
	$ci->email->set_newline("\r\n");

	$ci->email->set_mailtype('html');
	$ci->email->from($ci->config->item('email')['smtp_user'], 'ICR Pedigree Customer Service');
	// $ci->email->to($email);
	$ci->email->to("rizalafriandi01@gmail.com");
	$ci->email->subject('Menjadi Member Pro Ditolak / Become Pro Member Rejected');

	$message = '<div style="width: 500px; margin: auto; text-align: justify; text-justify: inter-word;">';
	$message .= '<div style="display: flex; align-items:center;">';
	$message .= '<img src="https://icrpedigree.com/assets/img/icr_logo_hitam.png" style="width: 100px; vertical-align: middle;">';
	$message .= '<span style="font-size: 50px; margin: auto;">ICR Pedigree</span>';
	$message .= '</div>';
	$message .= '<hr style="border-top: 4px solid black; margin-bottom: 1em;">';
	$message .= '<div>Yth. <b>'.$member.'</b>,</div><br>';
	$message .= '<div>Mohon maaf, permintaan Anda untuk mengubah jenis keanggotaan menjadi Member Pro ditolak dengan alasan:</div><br>';
	$message .= '<div>"'.$reason.'"</div><br>';
	$message .= '<div>Mohon hubungi kami jika Anda memerlukan bantuan atau memiliki pertanyaan lebih lanjut.</div><br>';
	$message .= '<div>Salam,</div><br>';
	$message .= '<div style="margin-bottom: 1em;">Tim ICRPedigree</div>';

	$message .= '<hr style="border-top: 4px solid black; margin-bottom: 1em;">';

	$message .= '<div>Dear <b>'.$member.'</b>,</div><br>';
	$message .= '<div>We are sorry to inform you that your request to change your membership type to Member Pro has been rejected because:</div><br>';
	$message .= '<div>"'.$reason.'"</div><br>';
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

//change dog owner
function send_approve_ownership($email, $member, $dog, $newOwner){
	$ci =& get_instance();

	$ci->load->library('email', $ci->config->item('email'));
	$ci->email->set_newline("\r\n");

	$ci->email->set_mailtype('html');
	$ci->email->from($ci->config->item('email')['smtp_user'], 'ICR Pedigree Customer Service');
	// $ci->email->to($email);
	$ci->email->to("rizalafriandi01@gmail.com");
	$ci->email->subject('Pengubahan Pemilik Anjing Disetujui / Dog Ownership Change Approved');

	$message = '<div style="width: 500px; margin: auto; text-align: justify; text-justify: inter-word;">';
	$message .= '<div style="display: flex; align-items:center;">';
	$message .= '<img src="https://icrpedigree.com/assets/img/icr_logo_hitam.png" style="width: 100px; vertical-align: middle;">';
	$message .= '<span style="font-size: 50px; margin: auto;">ICR Pedigree</span>';
	$message .= '</div>';
	$message .= '<hr style="border-top: 4px solid black; margin-bottom: 1em;">';
	$message .= '<div>Yth. <b>'.$member.'</b>,</div><br>';
	$message .= '<div>Kami ingin menginformasikan bahwa pengubahan pemilik anjing Anda dengan nama <b>'.$dog.'</b> kepada <b>'.$newOwner.'</b> telah disetujui.</div><br>';
	$message .= '<div>Salam,</div><br>';
	$message .= '<div style="margin-bottom: 1em;">Tim ICRPedigree</div>';

	$message .= '<hr style="border-top: 4px solid black; margin-bottom: 1em;">';

	$message .= '<div>Dear <b>'.$member.'</b>,</div><br>';
	$message .= '<div>We would like to inform you that the change of ownership for a dog with the name <b>'.$dog.'</b> to <b>'.$newOwner.'</b> has been approved.</div><br>';
	$message .= '<div>Regards,</div><br>';
	$message .= '<div>ICRPedigree Team</div>';
	$message .= '<hr style="border-top: 4px solid black; margin-top: 1em; margin-bottom: 1em;">';
	$message .= '<div>Address: Cisatu 2 Street 12b, Ciumbuleuit, Bandung</div>';
	$message .= '<div>Contact: +6287777802288</div>';
	$message .= '</div>';
	
	$ci->email->message($message);
	return $ci->email->send();
}

function send_reject_ownership($email, $member, $dog, $newOwner, $reason){
	$ci =& get_instance();

	$ci->load->library('email', $ci->config->item('email'));
	$ci->email->set_newline("\r\n");

	$ci->email->set_mailtype('html');
	$ci->email->from($ci->config->item('email')['smtp_user'], 'ICR Pedigree Customer Service');
	// $ci->email->to($email);
	$ci->email->to("rizalafriandi01@gmail.com");
	$ci->email->subject('Pengubahan Pemilik Anjing Ditolak / Dog Ownership Change Rejected');

	$message = '<div style="width: 500px; margin: auto; text-align: justify; text-justify: inter-word;">';
	$message .= '<div style="display: flex; align-items:center;">';
	$message .= '<img src="https://icrpedigree.com/assets/img/icr_logo_hitam.png" style="width: 100px; vertical-align: middle;">';
	$message .= '<span style="font-size: 50px; margin: auto;">ICR Pedigree</span>';
	$message .= '</div>';
	$message .= '<hr style="border-top: 4px solid black; margin-bottom: 1em;">';
	$message .= '<div>Yth. <b>'.$member.'</b>,</div><br>';
	$message .= '<div>Mohon maaf, pengubahan pemilik anjing Anda dengan nama <b>'.$dog.'</b> kepada <b>'.$newOwner.'</b> ditolak dengan alasan:</div><br>';
	$message .= '<div>"'.$reason.'"</div><br>';
	$message .= '<div>Mohon hubungi kami jika Anda memerlukan bantuan atau memiliki pertanyaan lebih lanjut.</div><br>';
	$message .= '<div>Salam,</div><br>';
	$message .= '<div style="margin-bottom: 1em;">Tim ICRPedigree</div>';

	$message .= '<hr style="border-top: 4px solid black; margin-bottom: 1em;">';

	$message .= '<div>Dear <b>'.$member.'</b>,</div><br>';
	$message .= '<div>We are sorry to inform you that the change of ownership for a dog with the name <b>'.$dog.'</b> to <b>'.$newOwner.'</b> has been rejected because:</div><br>';
	$message .= '<div>"'.$reason.'"</div><br>';
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
//update photo & RIP
function send_approve_update_canine($email, $member, $dog){
	$ci =& get_instance();

	$ci->load->library('email', $ci->config->item('email'));
	$ci->email->set_newline("\r\n");

	$ci->email->set_mailtype('html');
	$ci->email->from($ci->config->item('email')['smtp_user'], 'ICR Pedigree Customer Service');
	// $ci->email->to($email);
	$ci->email->to("rizalafriandi01@gmail.com");
	$ci->email->subject('Laporan Ubah Foto & RIP Anjing Disetujui / Dog Photo & RIP Change Report Approved');

	$message = '<div style="width: 500px; margin: auto; text-align: justify; text-justify: inter-word;">';
	$message .= '<div style="display: flex; align-items:center;">';
	$message .= '<img src="https://icrpedigree.com/assets/img/icr_logo_hitam.png" style="width: 100px; vertical-align: middle;">';
	$message .= '<span style="font-size: 50px; margin: auto;">ICR Pedigree</span>';
	$message .= '</div>';
	$message .= '<hr style="border-top: 4px solid black; margin-bottom: 1em;">';
	$message .= '<div>Yth. <b>'.$member.'</b>,</div><br>';
	$message .= '<div>Kami ingin menginformasikan bahwa laporan ubah foto & RIP anjing Anda dengan nama <b>'.$dog.'</b> telah disetujui.</div><br>';
	$message .= '<div>Salam,</div><br>';
	$message .= '<div style="margin-bottom: 1em;">Tim ICRPedigree</div>';

	$message .= '<hr style="border-top: 4px solid black; margin-bottom: 1em;">';

	$message .= '<div>Dear <b>'.$member.'</b>,</div><br>';
	$message .= '<div>We would like to inform you that your photo & RIP change report for a dog with the name <b>'.$dog.'</b> has been approved.</div><br>';
	$message .= '<div>Regards,</div><br>';
	$message .= '<div>ICRPedigree Team</div>';
	$message .= '<hr style="border-top: 4px solid black; margin-top: 1em; margin-bottom: 1em;">';
	$message .= '<div>Address: Cisatu 2 Street 12b, Ciumbuleuit, Bandung</div>';
	$message .= '<div>Contact: +6287777802288</div>';
	$message .= '</div>';
	
	$ci->email->message($message);
	return $ci->email->send();
}

function send_reject_update_canine($email, $member, $dog, $reason){
	$ci =& get_instance();

	$ci->load->library('email', $ci->config->item('email'));
	$ci->email->set_newline("\r\n");

	$ci->email->set_mailtype('html');
	$ci->email->from($ci->config->item('email')['smtp_user'], 'ICR Pedigree Customer Service');
	// $ci->email->to($email);
	$ci->email->to("rizalafriandi01@gmail.com");
	$ci->email->subject('Laporan Ubah Foto & RIP Anjing Ditolak / Dog Photo & RIP Change Report Rejected');

	$message = '<div style="width: 500px; margin: auto; text-align: justify; text-justify: inter-word;">';
	$message .= '<div style="display: flex; align-items:center;">';
	$message .= '<img src="https://icrpedigree.com/assets/img/icr_logo_hitam.png" style="width: 100px; vertical-align: middle;">';
	$message .= '<span style="font-size: 50px; margin: auto;">ICR Pedigree</span>';
	$message .= '</div>';
	$message .= '<hr style="border-top: 4px solid black; margin-bottom: 1em;">';
	$message .= '<div>Yth. <b>'.$member.'</b>,</div><br>';
	$message .= '<div>Mohon maaf, laporan ubah foto & RIP anjing Anda dengan nama <b>'.$dog.'</b> ditolak dengan alasan:</div><br>';
	$message .= '<div>"'.$reason.'"</div><br>';
	$message .= '<div>Mohon hubungi kami jika Anda memerlukan bantuan atau memiliki pertanyaan lebih lanjut.</div><br>';
	$message .= '<div>Salam,</div><br>';
	$message .= '<div style="margin-bottom: 1em;">Tim ICRPedigree</div>';

	$message .= '<hr style="border-top: 4px solid black; margin-bottom: 1em;">';

	$message .= '<div>Dear <b>'.$member.'</b>,</div><br>';
	$message .= '<div>We are sorry to inform you that your photo & RIP change report for a dog with the name <b>'.$dog.'</b> has been rejected because:</div><br>';
	$message .= '<div>"'.$reason.'"</div><br>';
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

//update birth
function send_approve_update_birth($email, $member, $sire, $dam){
	$ci =& get_instance();

	$ci->load->library('email', $ci->config->item('email'));
	$ci->email->set_newline("\r\n");

	$ci->email->set_mailtype('html');
	$ci->email->from($ci->config->item('email')['smtp_user'], 'ICR Pedigree Customer Service');
	// $ci->email->to($email);
	$ci->email->to("rizalafriandi01@gmail.com");
	$ci->email->subject('Laporan Ubah Lahir Disetujui / Birth Change Report Approved');

	$message = '<div style="width: 500px; margin: auto; text-align: justify; text-justify: inter-word;">';
	$message .= '<div style="display: flex; align-items:center;">';
	$message .= '<img src="https://icrpedigree.com/assets/img/icr_logo_hitam.png" style="width: 100px; vertical-align: middle;">';
	$message .= '<span style="font-size: 50px; margin: auto;">ICR Pedigree</span>';
	$message .= '</div>';
	$message .= '<hr style="border-top: 4px solid black; margin-bottom: 1em;">';
	$message .= '<div>Yth. <b>'.$member.'</b>,</div><br>';
	$message .= '<div>Kami ingin menginformasikan bahwa laporan ubah data kelahiran dari hasil pacak antara <b>'.$sire.'</b> dan <b>'.$dam.'</b> telah disetujui.</div><br>';
	$message .= '<div>Salam,</div><br>';
	$message .= '<div style="margin-bottom: 1em;">Tim ICRPedigree</div>';

	$message .= '<hr style="border-top: 4px solid black; margin-bottom: 1em;">';

	$message .= '<div>Dear <b>'.$member.'</b>,</div><br>';
	$message .= '<div>We would like to inform you that your birth change report from a stud between <b>'.$sire.'</b> and <b>'.$dam.'</b> has been approved.</div><br>';
	$message .= '<div>Regards,</div><br>';
	$message .= '<div>ICRPedigree Team</div>';
	$message .= '<hr style="border-top: 4px solid black; margin-top: 1em; margin-bottom: 1em;">';
	$message .= '<div>Address: Cisatu 2 Street 12b, Ciumbuleuit, Bandung</div>';
	$message .= '<div>Contact: +6287777802288</div>';
	$message .= '</div>';
	
	$ci->email->message($message);
	return $ci->email->send();
}

function send_reject_update_birth($email, $member, $sire, $dam, $reason){
	$ci =& get_instance();

	$ci->load->library('email', $ci->config->item('email'));
	$ci->email->set_newline("\r\n");

	$ci->email->set_mailtype('html');
	$ci->email->from($ci->config->item('email')['smtp_user'], 'ICR Pedigree Customer Service');
	// $ci->email->to($email);
	$ci->email->to("rizalafriandi01@gmail.com");
	$ci->email->subject('Laporan Ubah Lahir Ditolak / Birth Change Report Rejected');

	$message = '<div style="width: 500px; margin: auto; text-align: justify; text-justify: inter-word;">';
	$message .= '<div style="display: flex; align-items:center;">';
	$message .= '<img src="https://icrpedigree.com/assets/img/icr_logo_hitam.png" style="width: 100px; vertical-align: middle;">';
	$message .= '<span style="font-size: 50px; margin: auto;">ICR Pedigree</span>';
	$message .= '</div>';
	$message .= '<hr style="border-top: 4px solid black; margin-bottom: 1em;">';
	$message .= '<div>Yth. <b>'.$member.'</b>,</div><br>';
	$message .= '<div>Mohon maaf, laporan ubah data kelahiran dari hasil pacak antara <b>'.$sire.'</b> dan <b>'.$dam.'</b> ditolak dengan alasan:</div><br>';
	$message .= '<div>"'.$reason.'"</div><br>';
	$message .= '<div>Mohon hubungi kami jika Anda memerlukan bantuan atau memiliki pertanyaan lebih lanjut.</div><br>';
	$message .= '<div>Salam,</div><br>';
	$message .= '<div style="margin-bottom: 1em;">Tim ICRPedigree</div>';

	$message .= '<hr style="border-top: 4px solid black; margin-bottom: 1em;">';

	$message .= '<div>Dear <b>'.$member.'</b>,</div><br>';
	$message .= '<div>We are sorry to inform you that your birth change report from the stud between <b>'.$sire.'</b> and <b>'.$dam.'</b> has been rejected because:</div><br>';
	$message .= '<div>"'.$reason.'"</div><br>';
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
?>