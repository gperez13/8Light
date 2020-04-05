<?php

namespace App\Commands;

use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;

class InitCommand extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'Init';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->task("Setting up Database if it does not exist", function () {

            echo shell_exec("sudo mysql -e 'CREATE DATABASE IF NOT EXISTS bookshelf_local;'");
            
            return true;
        });

        $this->task("Running initial migrations", function () {
            
            echo shell_exec('php bookshelf migrate');
            
            return true;
        });

        echo shell_exec('php bookshelf');
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
