<?php

namespace App\Helpers;

class Render
{

    public static function status($text)
    {
        switch ($text) {
            case 'belum_mulai':
                return 'red-500';
            case 'proposal':
                return 'amber-500';
            case 'penelitian':
                return 'purple-500';
            case 'sidang':
                return 'blue-500';
            case 'selesai':
                return 'green-500';
        }
    }
}
