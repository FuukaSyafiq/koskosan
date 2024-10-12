<?php

use Illuminate\Support\Facades\Http;
use Mailgun\HttpClient\HttpClientConfigurator;
use Mailgun\Mailgun;

function SendToWhatsapp($noTelp, $text)
{
	try {
		$apiUrl = env("API_WHATSAPP_URL", "https://gsmpremium-alibaba.global-inovasi.com/index.php/recorder_mjk/send_wa_mjk");

		// dd($apiUrl);
		// Http::asForm()->post($apiUrl, [
		// 	'no_telepon' => $noTelp,
		// 	'isi_pesan' => $text,
		// 	'app_name' => 'ojt_kost'
		// ]);

		return "Successfully sending email";
	} catch (\Exception $e) {
		dd($e->getMessage());
		throw $e;
	}
}
