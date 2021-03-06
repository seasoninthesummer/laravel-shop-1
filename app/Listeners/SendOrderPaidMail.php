<?php

namespace App\Listeners;

use App\Events\OrderPaid;
use App\Notifications\OrderPaidNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
// implements ShouldQueue 代表异步监听器
class SendOrderPaidMail implements ShouldQueue
{

    public function handle(OrderPaid $event)
    {
        // 从事件对象中取出对应的订单
        $order = $event->getOrder();
        $order->user->notify(new OrderPaidNotification($order));
    }
}
