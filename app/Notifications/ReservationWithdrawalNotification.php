<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ReservationWithdrawalNotification extends Notification
{
    private User $user;

    /**
     * Create a new notification instance.
     */
    public function __construct(User $user)
    {
        $this->user = $user;
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
            ->line($this->mailMessage())
            ->line('لطفا هرچه سریعتر برای تحویل کتاب اقدام کنید.');
    }

    /**
     * @return string
     */
    private function mailMessage(): string
    {
        $reservedBooks = $this->user->reservations()
            ->with('book')
            ->whereNull('withdrawal_date')
            ->get()
            ->pluck('book.title')
            ->implode(', ');

        return "سلام کاربر " . $this->user->user_name . "\nکتاب‌های رزرو شده شما: " . $reservedBooks;
    }
}
