<?php

namespace App\Jobs;

use App\Classes\AppMessenger;
use App\Mail\ThanksForOrder;
use App\Models\User;
use App\Notifications\NewOrderNotification;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class OrderCreated implements ShouldQueue
{
    use Queueable;
    protected $order;
    protected $email;
    protected $user;
    protected $locale;
    /**
     * Create a new job instance.
     */
    public function __construct($order, $email)
    {
        $this->locale = app()->getLocale();
        $this->order = $order;
        $this->email = $email;
        $this->user = User::query()->first();
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $messenger = new AppMessenger();

        $messenger->setRecipient($this->email)
            ->setMessage($this->order->id)
            ->send();

        Debugbar::info($messenger);
        /*Mail::to($this->email)->locale($this->locale)->send(new ThanksForOrder([
            'order_number' => $this->order->number
        ]));*/
        /*Notification for admin panel*/
        $this->user->notify(
            new NewOrderNotification()
        );
    }
}
