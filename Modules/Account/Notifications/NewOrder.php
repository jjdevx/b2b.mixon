<?php

namespace Modules\Account\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class NewOrder extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(protected Order $order, protected bool $forManagers = false)
    {
    }

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        $mail = (new MailMessage)
            ->subject($this->forManagers ? 'Поступил новый заказ для Mixon' : 'Ваш заказ на сайте Mixon')
            ->greeting($this->forManagers ? 'Новый заказ для вашей точки отгрузки.' : 'Спасибо вам за заказ.');

        $order = $this->order;
        $author = $order->user;
        $mail->line("Заказчик: #{$author->id}, {$author->full_name}, {$author->email}, {$author->phone}.");

        $billing = Order::$billing[$order->billing];
        $type = Order::$types[$order->type];
        $mail->line("Форма расчета: {$billing}, тип заказа: {$type}.");

        if ($comment = $order->comment) {
            $mail->line("Примечание: {$comment}.");
        }

        $mail->line(new HtmlString("Количество, ед.: {$order->qty}.<br>
        Cумма: {$order->total}₴.<br>
        Общий вес, кг.: {$order->weight}.<br>
        Общий объем, м².: {$order->volume}."));

        return $mail;
    }
}
