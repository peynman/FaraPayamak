<?php

namespace FaraPayamak;

use FaraPayamak\Facade\Payamak;
use Illuminate\Notifications\Notification;

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
		Payamak::sendMessage($msg);
	}
}