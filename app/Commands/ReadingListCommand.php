<?php

namespace App\Commands;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\DB;
use LaravelZero\Framework\Commands\Command;


class ReadingListCommand extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'ReadingList';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Displays Saved Books and gives the option to remove books from local database';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $books = DB::select('select * from books');
        $optionsArray = [];
        
        foreach ($books as $book){

            $this->info('Title: ' .$book->title);
            $this->info('Author: ' .$book->author);
            $this->info('Publisher: ' .$book->publisher);
            $this->info('ID: ' .$book->id);
            $this->info('---------------------');
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
