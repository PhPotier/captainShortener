<?php

use App\Http\Traits\UrlTrait;
use Illuminate\Database\Seeder;

class UrlSeeder extends Seeder
{
    use UrlTrait;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $urls = config('urls.defaults_Urls');

        foreach($urls as $url){
            UrlTrait::createUrl($url);
        }
    }
}
