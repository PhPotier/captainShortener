<?php
namespace App\Http\Traits;

use App\Url;


trait UrlTrait{

    public static function createUrl($urlLong){
        $url = new Url();
        $url->origin_url = $urlLong;
        $url->short_url = hash('crc32', $urlLong);
        $url->type = 1;
        $url->save();

        return $url;
    }
}