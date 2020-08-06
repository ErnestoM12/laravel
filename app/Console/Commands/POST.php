<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;


class POST extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:POST';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send imaginary post data';

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
    
     //send data to url
    $response = Http::asForm()->post('https://atomic.incfile.com/fakepost', [
    'name' => 'Ernesto',
    'lastName' => 'Maya',
     ]);
     
    //Determine if status works
    $response->ok() ?  error_log('success') :  error_log('error');  
   
    // Determine if the status code was >= 200 and < 300...
    $response->successful() ? error_log('success data sent status 200') :  error_log('error data sent status 200');  

   // Determine if the status code was >= 400...
    $response->failed() ? error_log('failed status 400') : '' ; 

   // Determine if the response has a 400 level status code...
    $response->clientError() ?error_log('client error failed status 400') : '' ;

   // Determine if the response has a 500 level status code...
    $response->serverError() ? error_log('failed status 500 server not found') : '' ;
   
   
  
    
    }
}
