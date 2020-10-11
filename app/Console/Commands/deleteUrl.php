<?php

namespace App\Console\Commands;

use App\Url;
use Illuminate\Console\Command;

class deleteUrl extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'url:delete {url?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'delete url';

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

        if($url){
            $urlCheck = Url::where('origin_url', $url)->get()->last();

            //check if it's a correct URL 
            if(filter_var($url, FILTER_VALIDATE_URL) === FALSE){
                $this->error('this isn\'t a valid URL');
                return false;
            }
    
            if($urlCheck){
                $urlCheck->delete();
                $this->info('URL delete process:');
                
                //userless but beautiful
                $bar = $this->output->createProgressBar(100);
                $bar->start();
                for ($i=0; $i < 10; $i++) { 
                    sleep(1);
                    $bar->advance(10);            
                }
                $bar->finish();
    
                //$this->newLine() throw error
                $this->info('');
                $this->info('URL deleted');
            }
            else{
                $this->info('No url find');
            }
        }
        else{
            if ($this->confirm('Do you wish to delete all entries?')) {
                $urls = Url::all();
                
                $this->info('URLs delete process:');
                
                //userless but beautiful
                $bar = $this->output->createProgressBar(count($urls));
                $bar->start();
                foreach($urls as $url){ 
                    $url->delete();
                    $bar->advance();            
                }
                $bar->finish();
    
                //$this->newLine() throw error
                $this->info('');
                $this->info('URLs deleted');
            }
        }
        return 0;
    }
}
