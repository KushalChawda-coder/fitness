<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\admin\Lead;
use Illuminate\Support\HtmlString;

class DigitalFileEmail extends Notification implements ShouldQueue
{
    use Queueable;

    public $file_link;

	/**
	 * Create a new notification instance.
	 *
	 * @param User $user
	 */
    public function __construct($file_link)
    {
        $this->file_link = $file_link;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $data = $this->file_link;
        
        $mailMessage = (new MailMessage)
        ->subject('Digital Files')
        ->line('Here is the Digital Ebook Link :');
        $htmlContent = '<ul>';

        foreach ($data as $key => $value) {
            $action_url  = url('/').$value;
            $htmlContent .= '<li><a href="' . $action_url . '">' . $action_url . '</a></li>';
        }
        $htmlContent .= '</ul>';
        $mailMessage->line(new HtmlString($htmlContent));
        $mailMessage->line('Thanks for register to FitnesplanApp!');

        return $mailMessage;
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
