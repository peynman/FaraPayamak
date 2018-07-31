<?php

namespace FaraPayamak;

use FaraPayamak\Facade\Payamak;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Queue;

/**
 * Created by PhpStorm.
 * User: peyman
 * Date: 7/28/18
 * Time: 5:56 PM
 */

class PayamakChannel
{
	public function send( $notifiable, Notification $notification ) {
		/** @var \FaraPayamak\Message $msg */
		$msg = $notification->toSMS($notifiable);
		if (isset($notifiable->meta->phone)) {
			$msg->to = $notifiable->meta->phone;
		}
		if (is_null(config('payamak.queue'))) {
			Payamak::sendMessage($msg);
		} else {
			Queue::push(new Jobs\SendSMS($msg), [], config('payamak.queue'));
		}
	}
}