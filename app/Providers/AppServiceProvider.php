<?php

namespace App\Providers;

use Illuminate\Support\Facades\Queue;
use Illuminate\Support\ServiceProvider;
use Illuminate\Queue\Events\JobProcessed;
use Illuminate\Queue\Events\JobProcessing;
use Illuminate\Queue\Events\JobFailed;
use DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        DB::listen(function ($query) {
            // $query->sql
            // $query->bindings
            // $query->time
            //$sql = $query->sql;
           // $bindings = $query->bindings;
           // $time =  $query->time;
            // \Log::info($sql, $bindings, $time);
        });


          Queue::before(function (JobProcessing $event) {
            // $event->connectionName
            // dd($event->job);
            // $event->job->payload()
        });

        Queue::after(function (JobProcessed $event) {
            // $event->connectionName
            // $event->job
                        // $event->job->payload()
            //dd($event->job->getJobId());
        });



         Queue::failing(function (JobFailed $event) {
            // $event->connectionName
            // $event->job
            // $event->exception
        });
    }
}
