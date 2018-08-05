<?php
/**
 * Created by PhpStorm.
 * User: peyman
 * Date: 7/31/18
 * Time: 1:50 PM
 */

namespace FaraPayamak\Jobs;


use FaraPayamak\Facade\Payamak;
use FaraPayamak\Message;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendSMS implements ShouldQueue
{
	use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

	/** @var Message */
	protected $message;

	/**
	 * Create a new job instance.
	 *
	 * @param Message $message
	 */
	public function __construct($message)
	{
		$this->message = $message;
	}

	/**
	 * Execute the job.
	 *
	 * @return void
	 */
	public function handle()
	{
		try {
			$res = Payamak::sendMessage( $this->message );
			if (is_soap_fault($res)) {
				$this->fail($res);
			}
		} catch (\Exception $ex) {
			$this->fail($ex);
		}
	}
}
