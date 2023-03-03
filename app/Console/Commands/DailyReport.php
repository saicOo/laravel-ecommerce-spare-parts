<?php

namespace App\Console\Commands;
use App\Models\Report;
use Illuminate\Console\Command;

class DailyReport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'report:daily';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a daily report';

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
        return Report::create([
            'orders_amount'=> 0,
            'orders_count'=> 0,
            'purchases_amount'=> 0,
            'purchases_count'=> 0,
        ]);
    }
}
