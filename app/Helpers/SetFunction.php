<?php

namespace App\Helpers;

use Carbon\Carbon;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;

class SetFunction
{
    public static function generateRupiah($angka)
    {
        $hasil_rupiah = 'Rp. '.number_format($angka, 0, ',', '.');

        return $hasil_rupiah;
    }

    public static function sendNotification($token, $title, $body, $bodyData = ['app_data' => 'SIGAP'])
    {
        $messaging = app('firebase.messaging');

        $message = CloudMessage::withTarget('token', $token)
            ->withNotification(Notification::create($title, $body))
            ->withData($bodyData);

        $messaging->send($message);
    }

    // make url googlemaps using lat and lng
    public static function googleMaps($lat, $lng)
    {
        $url = 'https://www.google.com/maps/search/?api=1&query='.$lat.','.$lng;

        return $url;
    }

    public static function generateRandomString($length = 25)
    {
        $characters       = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString     = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        return $randomString;
    }

    public static function sessionGet($session)
    {
        $data = session()->get($session);

        return $data;
    }

    public static function sessionSet($session, $data)
    {
        $data = session([$session => $data]);

        return true;
    }

    public static function regexTimestamp($date)
    {
        $data = preg_replace('/\D/', '', $date);

        return $data;
    }

    public static function hitungUmur($tanggal_lahir)
    {
        return Carbon::parse($tanggal_lahir)->age;
    }

    public static function setDateID($date, $short = false)
    {
        $bulan = [
          1  => 'Januari',
          2  => 'Februari',
          3  => 'Maret',
          4  => 'April',
          5  => 'Mei',
          6  => 'Juni',
          7  => 'Juli',
          8  => 'Agustus',
          9  => 'September',
          10 => 'Oktober',
          11 => 'November',
          12 => 'Desember',
        ];
        if ($short) {
            // change bulan to 3 char
            $bulan = [
              1  => 'Jan',
              2  => 'Feb',
              3  => 'Mar',
              4  => 'Apr',
              5  => 'Mei',
              6  => 'Jun',
              7  => 'Jul',
              8  => 'Agu',
              9  => 'Sep',
              10 => 'Okt',
              11 => 'Nov',
              12 => 'Des',
            ];
        }
        $dateparse = Carbon::parse($date);
        $convert   = $dateparse->day.' '.$bulan[$dateparse->month].' '.$dateparse->year;

        return $convert;
    }
}
