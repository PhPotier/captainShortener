<?php

namespace App\Console\Commands;

use App\Url;
use App\Http\Traits\UrlTrait;
use Illuminate\Console\Command;

class shortenUrl extends Command
{
    use UrlTrait;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'url:shorten {url}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'create a shorter url';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $url = $this->argument('url');

        $urlCheck = Url::where('origin_url', $url)->get()->last();

        //check if it's a correct URL 
        if(filter_var($url, FILTER_VALIDATE_URL) === FALSE){
            $this->error('this isn\'t a valid URL');
            return false;
        }

        //check if already exist
        if($urlCheck){
            $this->info('this shorter URL already exist, and is : '. $urlCheck->short_full_url);
        }
        else{
            $urlCreated = UrlTrait::createUrl($url);

            $this->info('Your shorter URL is : '. $urlCreated->short_full_url);
        }
      
        return true;
    }
}
