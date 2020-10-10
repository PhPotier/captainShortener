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
        $urls = [
            'https://www.linkedin.com/in/philippe-potier/',
            'https://www.captainwallet.com/',
            'https://www.youtube.com/watch?v=wLoWd2KyUro',
            'https://github.com/PhPotier',
            'https://gitlab.com/PPotier'
        ];


        foreach($urls as $url){
            UrlTrait::createUrl($url);
        }
    }
}
