<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\admin\Lead;

class LeadVerifyEmail extends Notification implements ShouldQueue
{
    use Queueable;

    public $leadDeatils;

	/**
	 * Create a new notification instance.
	 *
	 * @param User $user
	 */
    public function __construct($leadDeatils)
    {
        $this->leadDeatils = $leadDeatils;
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
        return (new MailMessage)
            ->subject('Fitness Plan App Email Verification')
            ->view(
                'email.template.VerifyEmail', // Path to your custom view
                ['leadDetails' => $this->leadDeatils] // Pass data to the view if needed
            );
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
