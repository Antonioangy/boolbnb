<?php

namespace App\Console\Commands;

use App\Apartment;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class checkSponsor extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:minutely';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $apartments = Apartment::all();
        
        foreach ($apartments as $apartment) {
            
            foreach ($apartment -> sponsors as $sponsor) {
                $endDate =  $sponsor -> pivot -> end_date;
                $now = date_create();
                if ($now >= $endDate) {
                    $apartment -> sponsor = 0;
                    $apartment -> save();
                }else {
                    $apartment -> sponsor = 1;
                    $apartment -> save();
                }
            }
        }
        echo 'checked';
    }
}
