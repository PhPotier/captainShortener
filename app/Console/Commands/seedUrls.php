<?php

namespace App\Console\Commands;

use App\Http\Traits\UrlTrait;
use Illuminate\Console\Command;

class seedUrls extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'url:seed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'launch seed URLS';

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
        $urls = config('urls.defaults_Urls');

        $this->info('URLs seeding process:');
                
        //userless but beautiful
        $bar = $this->output->createProgressBar(count($urls));
        $bar->start();
        foreach($urls as $url){ 
            UrlTrait::createUrl($url);
            $bar->advance();            
        }
        $bar->finish();

        //$this->newLine() throw error
        $this->info('');
        $this->info('URLs created');

       
        return 0;
    }
}
