<?php

namespace App\Commands;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\Http;
use LaravelZero\Framework\Commands\Command;

class SearchCommand extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'Search {params}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Searches books by Name or Author';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $url = 'https://www.googleapis.com/books/v1/volumes?q='.$this->argument('params').'&maxResults=5';
        $response = json_decode(Http::get($url)->getBody(), true);

        
        if($response["totalItems"] === 0){
            $this->info('There were no matching results for '.$this->argument("params"));
        } else {

            foreach ($response["items"] as $book){
    
                $this->info('Title: ' .$book["volumeInfo"]["title"]);
                $this->info('Author: ' .$book["volumeInfo"]["authors"][0]);
                $this->info('Publisher: ' .$book["volumeInfo"]["publisher"]);
                $this->info('ID: ' .$book["id"]);
                $this->info('---------------------');
            }

            if ($this->confirm("Would you like to bookmark any of these books?")) {
                $this->info('Huzzah!');
                exit();
            }
            $this->info("The wise speak only of what they know 🧙‍♂️");
        }

    }

    /**
     * Define the command's schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    public function schedule(Schedule $schedule): void
    {
        // $schedule->command(static::class)->everyMinute();
    }
}
