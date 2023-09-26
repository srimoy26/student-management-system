<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class StudentRegisteredNotification extends Notification
{
    use Queueable;

    protected $studentData;

    /**
     * Create a new notification instance.
     *
     * @param array $studentData The student's data
     * @return void
     */
    public function __construct($studentData)
    {
        $this->studentData = $studentData;
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
            ->line('Hello ' . $this->studentData['first_name'] . '!')
            ->line('You have been successfully registered with the following details:')
            ->line('First Name: ' . $this->studentData['first_name'])
            ->line('Last Name: ' . $this->studentData['last_name'])
            ->line('Email: ' . $this->studentData['email'])
            ->line('Phone: ' . $this->studentData['phone'])
            ->action('Visit our website', url('/'))
            ->line('Thank you for using our application!');
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
            
        ];
    }
}
