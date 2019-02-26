<?php
// use Mail as Mail;
// En esta función controlamos todos los envios de correo de la aplicación
function sending_mails($email = 'contacto@chekogarcia.com.mx',$subject = 'Default',$data = array()){
	

	Mail::send('sweet.mails.main', $data, function ($message)use($email,$subject){

	$message->from('no_replay@reydecibel.com.mx', 'Knobs')->subject($subject);
	$message->to($email);

	});

	return response()->json(['success' => true,'message'=>'El mensaje fue enviado correctamente']);
}