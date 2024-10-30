<?php

namespace App\Notifications;

use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Filament\Actions\Action;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

/**
 * Class SuccessNotification
 * @package App\Notifications
 */
class SuccessNotification extends Notification
{
    use Queueable;

    protected $title;
    protected $icon;
    protected $body;
    protected $redirectTo;
    /**
     * Create a new notification instance.
     */
    public function __construct($title, $icon, $body, $redirectTo)
    {
        $this->title = $title;
        $this->icon = $icon;
        $this->body = $body;
        $this->redirectTo = $redirectTo;

        /*$this->newElementsCount = $model
            ->whereDate('created_at', Carbon::today())->count();*/

    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /*public function toDatabase($notifiable)
    {
        dump('database');
    }*/

    public function toBroadcast($notifiable)
    {
        dump('notification');
        return new BroadcastMessage([
            'title' => 'Notification content!',
            'body' => null,
            'icon' => null,
            'iconColor' => 'secondary',

            'actions' => [],
            'socket' => null,
            'format' => 'filament',
            'view' => 'notifications::notification',
            'viewData' => [],
        ]);

        /*return $this->user->notify(
            \Filament\Notifications\Notification::make()
                ->title('Test notification')
                ->success()
                ->toBroadcast()
        );*/

       /* return \Filament\Notifications\Notification::make()
                    ->title('Test notification')
                    ->success()
                    ->getBroadcastMessage();*/
       /* return new BroadcastMessage([
           \Filament\Notifications\Notification::make()
                ->title('test')
                ->success()
                ->broadcast()
        ]);*/
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        dump('notification mail');
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return \Filament\Notifications\Notification::make()
            ->title(date('d-m-Y h:i:s').' '.$this->title)
            ->icon($this->icon)
            ->body($this->body)
            ->actions([
                \Filament\Notifications\Actions\Action::make('GoTo')
                    ->label('Перейти')
                    ->button()
                    ->url(url($this->redirectTo), shouldOpenInNewTab: false),
            ])
            ->getDatabaseMessage();
    }


}
