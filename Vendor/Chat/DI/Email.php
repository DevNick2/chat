<?php

namespace Chat\DI;
use League\OAuth2\Client\Provider\Google;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\OAuth;

class Email
{
	public static function EnviarEmail(array $params)
	{	
		$clientId = $params['clientId'];
		$clientSecrect = $params['clientSecret'];
		$token = $params['token'];

		$mail = new PHPMailer;
		$mail->isSMTP(); // Ativa o SMTP
		//Ativa SMTP debugging
		// 0 = off (produção)
		// 1 = client messages
		// 2 = client and server messages
		$mail->SMTPDebug = $params['SMTPDebug']; // Degub para validar
		$mail->Host = 'smtp.gmail.com'; // Host SMTP
		$mail->Port = 587; // Porta para SMTP e TLS
		$mail->SMTPSecure = 'tls'; // Segurança padrão
		$mail->SMTPAuth = true; // Ativa autenticação pelo SMTP
		$mail->AuthType = 'XOAUTH2'; // Habilita o OAuth2 do google
	
		$provider = new Google( // Instancia do google
		    [
		        'clientId' => $clientId,
		        'clientSecret' => $clientSecrect,
		    ]
		);
		$mail->setOAuth( // Instancia do OAuth
		    new OAuth(
		        [
		            'provider' => $provider,
		            'clientId' => $clientId,
		            'clientSecret' => $clientSecrect,
		            'refreshToken' => $token,
		            'userName' => $params['emailBase'],
		        ]
		    )
		);
		$mail->setFrom($params['emailBase'], NOMESISTEMA); // De quem
		$mail->addAddress($params['quemRecebe'], $params['nomeQuemRecebe']); // Para quem
		$mail->Subject = $params['assunto']; // Assunto
		$mail->addReplyTo($params['reply'], $params['nameReply']);
    	$mail->addCC($params['cc']);
		$mail->CharSet = 'utf-8'; 
		$mail->msgHTML($params['msg']); // html para o corpo do e-mail
		
		if (!$mail->send()) {
		    return "Mailer Error: " . $mail->ErrorInfo;
		} else {
		    return true;
		}
	}
}