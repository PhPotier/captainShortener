<?php
namespace App\Http\Traits;

use App\Url;
use Mremi\UrlShortener\Model\Link;
use Mremi\UrlShortener\Provider\Baidu\BaiduProvider;

trait UrlTrait{

    /**
     * Create a new entry in DB from Url long
     * @param string $urlLong
     * @param boolean $crc
     * 
     * @return Url $url
     */
    public static function createUrl($urlLong, $crc = false){ 
        $url = new Url();
        $url->origin_url = $urlLong;
        if($crc){
            $url->short_url = hash('crc32', $urlLong);
            $url->type = 0;
        }
        else{
            $url->short_url = self::createUniqueString();
            $url->type = 1;
        }
        $url->save();

        return $url;
    }

    /**
     * Generate unique string and check if already exist in DB 
     * 
     * @return String $potentialUniqueString
     */
    public static function createUniqueString(){
        do{
            $potentialUniqueString = bin2hex(random_bytes(5));
        }
        while(Url::where('short_url', $potentialUniqueString)->count() != 0);

        return $potentialUniqueString;
        
       
    }
}