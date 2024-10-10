<?php

use Illuminate\Support\Facades\Http;
use Mailgun\HttpClient\HttpClientConfigurator;
use Mailgun\Mailgun;

function SendToWhatsapp($email)
{
	try {
		
		// $mailgunSecret = env("MAILGUN_SECRET");
		// $domain = env("MAILGUN_DOMAIN");
		// # Make the call to the client.
		// // $mgClient::
		// $configurator = new HttpClientConfigurator();
		// $configurator->setApiKey($mailgunSecret);

		// $mgClient = new Mailgun($configurator);

		// $endpoint = env("MAILGUN_ENDPOINT");

		// // dd($domain);

		// // Instantiate the Mailgun client
		// $mgClient = Mailgun::create($configurator->getApiKey(), $endpoint);

		// $from = "syafiqparadisam@gmail.com";
		// // $to = ;
		// // Send email
		// $mgClient->messages()->send($domain, [
		// 	'from'	=> $from,
		// 	'to'	=> $email,
		// 	'subject' => 'Ndang bayaren kosmu',
		// 	'html'    => '<h1>Testing some Mailgun awesomeness!<h1>'
		// ]);

		return "Successfully sending email";
	} catch (\Exception $e) {
		dd($e->getMessage());
		throw $e;
	}
}
