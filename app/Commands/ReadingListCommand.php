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

        if(count($books) === 0){
            $this->info('Currently, there are no books in your ReadingList. Try executing a Search to add a book.');
        } else {

            foreach ($books as $book){
                array_push(
                    $optionsArray,
                    $book->title." by ".$book->author
                );
    
                $this->info('Title: ' .$book->title);
                $this->info('Author: ' .$book->author);
                $this->info('Publisher: ' .$book->publisher);
                $this->info('ID: ' .$book->id);
                $this->info('---------------------');
            }
    
            if ($this->confirm("Would you like to delete any of these books?")) {
                $option = $this->menu('ReadingList', $optionsArray)
                    ->disableDefaultItems()
                    ->open();
    
                DB::table('books')->where('id', $books[$option]->id)->delete();
                $this->info('This book has been removed to your Reading List!');
                exit();
            }
            $this->info("To the Bridge of Khazad-dûm! 🧙‍♂️");
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
