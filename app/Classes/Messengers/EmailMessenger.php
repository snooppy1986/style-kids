<?php


namespace App\Classes\Messengers;


use App\Mail\ThanksForOrder;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Support\Facades\Mail;

class EmailMessenger extends AbstractMessenger
{
    public function send(): bool
    {
        Debugbar::info('Sent by '.__METHOD__);
        /*dd($this->recipient);*/
        Mail::to($this->recipient)->send(new ThanksForOrder([
            'order_number' => $this->message
        ]));

        return parent::send();
    }
}
