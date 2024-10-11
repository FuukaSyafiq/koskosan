<?php

class GenerateMessage {

	public static function whenIsVerified($tanggal, $kamar) {
		return "Pembayaran pada kamar '$kamar' untuk Tanggal $tanggal sudah diverifikasi";
	}

	public static function whenCreateTagihan($kamar) {
		return "ada Tagihan baru untuk kamar '$kamar',Cek Aplikasi KosLoka untuk detail lebih lanjut";
	}

	public static function whenCreatePayment($tanggal, $kamar) {
		return "tagihan pada kamar '$kamar' untuk tanggal $tanggal Telah lunas!";
	}

	public static function whenAlmostDueDate($kamar) {
		return "Segera bayar tagihan untuk kamar $kamar";
	}
}