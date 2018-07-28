<?php
/**
 * Created by PhpStorm.
 * User: peyman
 * Date: 7/28/18
 * Time: 3:55 PM
 */

namespace FaraPayamak;

use SoapClient;

class Client {
	protected $client;
	private $username, $password, $from, $url, $isFlash;

	public function __construct($url, $username, $password, $from, $isFlash) {
		ini_set("soap.wsdl_cache_enabled", "0");
		$this->password = $password;
		$this->username = $username;
		$this->url = $url;
		$this->from = $from;
		$this->isFlash = $isFlash;
		$this->client = new SoapClient($url);
	}

	/**
	 * @param Message $message
	 *
	 * @return mixed
	 * @throws \Exception
	 */
	public function SendMessage(Message $message) {
		if (!is_null($message->username) && !is_null($message->password)) {
			return $this->SendTextWithCredentials(
				$message->username,
				$message->password,
				$message->from,
				$message->to,
				$message->text,
				$this->isFlash
			);
		}
		return $this->SendText($message->to, $message->text);
	}

	/**
	 * @param      $username
	 * @param      $password
	 * @param      $phone_number
	 * @param      $to
	 * @param      $text
	 * @param bool $isflash
	 *
	 * @throws \Exception
	 * @return mixed
	 */
	public function SendTextWithCredentials($username, $password, $phone_number, $to, $text, $isflash = false) {
		return $this->client->SendSimpleSMS([
			'username' => $username,
			'password' => $password,
			'from' => $phone_number,
			'to' => $to,
			'text' => $text,
			'isflash' => $isflash
		]);
	}

	/**
	 * @param $number
	 * @param $text
	 *
	 * @throws \Exception
	 * @return mixed
	 */
	public function SendText($number, $text) {
		return $this->SendMessageWithCredentials($this->username, $this->password, $this->from, $number, $text, $this->isFlash);
	}

	/**
	 * @param $numbers
	 * @param $text
	 *
	 * @throws \Exception
	 * @return mixed
	 */
	public function SendTextBatch($numbers, $text) {
		return $this->client->SendSimpleSMS([
			'username' => $this->username,
			'password' => $this->password,
			'from' => $this->from,
			'to' => $numbers,
			'text' => $text,
			'isflash' => $this->isFlash
		]);
	}

}