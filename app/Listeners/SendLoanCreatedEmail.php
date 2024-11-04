<?php

namespace App\Listeners;

use App\Mail\LoanCreatedMail;
use Illuminate\Support\Facades\Mail;

class SendLoanCreatedEmail
{

    /**
     * Handle the event.
     */
    public function handle(LoanCreatedMail $event): void
    {
        Mail::to($event->loan->user->email)->queue(new LoanCreatedMail($event->loan));
    }
}
