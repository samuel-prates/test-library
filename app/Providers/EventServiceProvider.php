<?php

namespace App\Providers;

use App\Events\LoanCreated;
use App\Listeners\SendLoanCreatedEmail;
use Illuminate\Support\ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        LoanCreated::class => [
            SendLoanCreatedEmail::class,
        ],
    ];
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
