<?php

namespace App\Console;

use App\Image;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();

        $schedule->call(function(){
            \Cloudinary::config(array(
                "cloud_name" =>  env('API_CLOUDINARY_NAME'),
                "api_key" =>  env('API_CLOUDINARY_KEY'),
                "api_secret" => env('API_CLOUDINARY_SECRET'),
            ));

            $images = Image::all();
            foreach($images as $image){
                $idImage = $image->public_id;
                \Cloudinary\Uploader::destroy($idImage);
                $image->delete();
            }
        })->hourly();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
