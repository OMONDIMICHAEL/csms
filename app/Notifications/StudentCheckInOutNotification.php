<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class StudentCheckInOutNotification extends Notification implements ShouldQueue
{
    use Queueable;
    public $student;
    public $status; // 'check-in' or 'check-out'
    public $time;

    /**
     * Create a new notification instance.
     */
     public function __construct($student, $status, $time)
     {
         $this->student = $student;
         $this->status = $status;
         $this->time = $time;
     }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
          ->subject("Student {$this->status} Notification")
          ->greeting("Hello, Parent of {$this->student->name}")
          ->line("Your child, {$this->student->name}, has {$this->status} at the school gate.")
          ->line("Time: {$this->time}")
          ->line("If you have any concerns, please contact the school.")
          ->action('View Records', url('/security/check-in-history'))
          ->line('Thank you for your attention.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
