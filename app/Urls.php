<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;

class Urls extends Model
{
    private static function getRandomToken($length = 6)
    {
        $maxTryCount = 20;
        $url = null;
        $randomToken = null;

        do
        {
            --$maxTryCount;
            $randomToken = substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length / strlen($x)))), 1, $length);
            $url = Urls::where('token', $randomToken)->first();

            if ($url != null)
                $randomToken = null;
        }
        while ($url != null || $maxTryCount > 0);

        return $randomToken;
    }

    public static function add($dstUrl)
    {
        $randomToken = static::getRandomToken();

        if ($randomToken == null)
            return null;

        $url = new static;
        $url->token = $randomToken;
        $url->dst_url = $dstUrl;
        $url->save();

        return URL::to('/') . '/l/' . $randomToken;
    }
}
