<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPasswordNotification extends Notification
{
    use Queueable;
    public $token;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
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
        ->subject('Thông báo đặt lại mật khẩu') //Nó sẽ sử dụng tên lớp này nếu bạn không chỉ định
        //->greeting('Xin chào bạn!') //Ví dụ: Thưa ông, xin chào bà, v.v ...
        //->level('info') //Đây là loại email. Tùy chọn có sẵn: thông tin, thành công, lỗi. Mặc định: thông tin
        ->line('Bạn đang nhận được email này vì chúng tôi đã nhận được yêu cầu đặt lại mật khẩu cho tài khoản của bạn.')
        ->action('Đặt lại mật khẩu', route('password.reset', $this->token))
        ->line('Nếu bạn không yêu cầu đặt lại mật khẩu, không cần thực hiện thêm hành động nào!');
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
