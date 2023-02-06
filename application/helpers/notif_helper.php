<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

function firebase_notif($to, $title, $desc){
	$url = 'https://fcm.googleapis.com/fcm/send';
	$key = 'AAAALe2LeZU:APA91bEqr2n1PRxkOyOfx8IwYO1O_1gjprFkq1AITOGUu3GYp2ZBi-8-AvM4ADI3m94NEv4cq-uKcMBU3pJXBhO21CyuVgPNX2l7VYXj5IllxEr6sika8eaJp1IgXCHALA5_xYw92pXK';

	$fields = array (
		'to' => $to,
		'notification' => array(
		"channelId" => "ICRPedigree",
		'title' => $title,
		'body' => $desc
		)
	);
	$fields = json_encode ( $fields );

	$headers = array (
		'Authorization: key=' . $key,
		'Content-Type: application/json'
	);

	$ch = curl_init ();
	curl_setopt ( $ch, CURLOPT_URL, $url );
	curl_setopt ( $ch, CURLOPT_POST, true );
	curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers );
	curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
	curl_setopt ( $ch, CURLOPT_POSTFIELDS, $fields );

	$result = curl_exec ( $ch );
	// echo $result;
	curl_close ( $ch );
}
?>