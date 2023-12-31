<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Config;

function formatRupiah($angka)
{
    // Cek apakah input adalah angka
    if (!is_numeric($angka)) {
        return 'Format bukan angka';
    }

    $rupiah = number_format($angka, 0, ',', '.');
    return 'Rp ' . $rupiah;
}

function getMonthName($monthNumber)
{
    try {
        // Pastikan $monthNumber berada dalam rentang 1-12
        if ($monthNumber < 1 || $monthNumber > 12) {
            throw new \Exception('Nomor bulan tidak valid');
        }

        // Daftar nama bulan dalam bahasa Indonesia
        $monthNames = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember',
        ];

        // Ambil nama bulan dari daftar
        return $monthNames[$monthNumber];
    } catch (\Exception $e) {
        return 'Bulan tidak valid';
    }
}
