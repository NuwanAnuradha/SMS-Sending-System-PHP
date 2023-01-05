<?php

	if(isset($_POST['to']) && isset($_POST['message']) && isset($_POST['sender'])
		&& !empty($_POST['to']) && !empty($_POST['message']) && !empty($_POST['sender']))

	{

		//echo "string";
		$form_sender_phone = $_POST['sender'];
		$form_reciepient_phone = $_POST['to'];
		$form_message = $_POST['message'];



	$api_key = "fd4bacf7f5e44957b324302720f80a8c";
	$api_token = "5232c6d50eaa409ab4f485845f13365d";

	$sender_phone_number = $form_sender_phone;
	$reciever_phone_number = $form_reciepient_phone; //"94774682424";
	$message = $form_message; //"This is a Test Message for testing my App";

	//Converting to an array -> $reciever_phone_number for Multiple Purpose
	$reciever_phone_number = [$reciever_phone_number];

	$content = [

		'to' => $reciever_phone_number,
		'from' => $sender_phone_number,
		'body' => $message

	];

	//convert content into json 
	$json_content = json_encode($content);
	$curl = curl_init("https://.sms.api.sinch.com/xms/v1/{$api_key}/batches");


	curl_setopt($ch, CURLOPT_HTTPHEADER, array[

			'Content-Type: application/json ',
			'Authorization: Bearer'.$api_token

		]);
	curl_setopt($ch, CURLOPT_POST, true); //post request
	curl_setopt($ch, CURLOPT_POSTFIELDS, $json_content);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

	//Executing the HTTP Request
	$result = curl_exec($ch); //return weather HTTP Request was successful or not


	$html_code = '

		<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title></title>

	<style type="text/css">
		body{
			background color: blue;
			color: #5e2d8c;
			font-size: 20px;
		}
		

		.form-button{
			background-color: #5e2d8c;
			border: rgb(78, 79, 33);
			color: #f3c2cb;
			border-radius: 10px;
			padding: 10px;
			font-weight: bold;
		}
		.title{
			margin: 10ox auto;
			padding: 10px;
			text-align: center;
			background-color: white;
			border-radius: 10px;
			width: 50%;
		}
		
	</style>

</head>
<body>
		<div class="title">
			<h2>';


			$html_code2 = '</h2> </div> </body> </html> ';




	//checking the results
	if(curl_errno($ch)) {
		//if there is an error
		//echo "Message was not sent ! "; //First Option
		//echo "\n";
		//echo "Error:".curl_error($ch); //Second Option

		echo $html_code. 'message was not been sent'.$html_code2;

	}

	else
			if(result){



	{
		//sms was sent successfully
		//echo "Message sent Successfully !"; //First Option
		//echo "\n";
		//echo $result; //Second Option

		echo $html_code. 'message has been sent successfully!'.$html_code2;
		}
		else{
			//echo "Message was not Sent";
			//echo "\n";
			//echo result;

			echo $html_code. 'message was not sent!'.$html_code2;

		}

	}

	//one of the best practice is once you make the connection you have to close it after used.
	//Closing the Connection
	curl_close($ch);
}
else{
	echo "Please Fill Empty Fields!";
}

	
?>