<?php

function calculateRating($ratings)
{
	dd($ratings);
	// Menghitung total rating
	$totalRating = array_sum($ratings);

	// Menghitung jumlah ulasan
	$count = count($ratings);

	// Menghitung rating rata-rata
	$averageRating = $count > 0 ? $totalRating / $count : 0;

	// Menampilkan rating rata-rata
	echo "Rating Rata-rata: " . round($averageRating, 1); // Output: Rating Rata-rata: 4.2

}
