<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use MongoDB\Client as MongoClient;
use MongoDB\Driver\Manager;


class CreateNewSeasonCollection extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'season:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new collection for the upcoming season in MongoDB';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        /*$currentYear = date('Y');
        $first = intval(substr($currentYear, -2))-1;
        $second = $first+1;
        $seasonName = "season_" . $first . "_" . $second . "_competitions";
        try{
            $this->line("Creating collection for " . $seasonName);
            $mongoClient = new MongoClient(env('MONGODB_URI'));
            $this->line("Connected to MongoDB");
            $database = $mongoClient->selectDatabase(env('DB_DATABASE'));
            $database->createCollection($seasonName);
            $this->info("Created succesfully!");
        } catch (Exception $error){
            $this->error("Error: " . $error);
        }*/
    }
}
