<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

if (!function_exists('convertToBase64')) {
    function convertToBase64($path)
    {
        // $path = FCPATH.$path;
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        return $base64;
    }
}

if (!function_exists('ej')) {
    function ej($params)
    {
        echo json_encode($params);

        exit;
    }
}

if (!function_exists('time_ago')) {
    function time_ago($datetime, $full = false)
    {
        // $datetime = date(" Y - m - d H : i : s ", time()+120);
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = [
            'i' => 'Menit ',
            's' => 'Detik ',
        ];
        $a = null;
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v;
                $a .= $v;
            } else {
                unset($string[$k]);
            }
        }
        return $a;
    }
}
