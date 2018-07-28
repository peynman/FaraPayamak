<?php
/**
 * Created by PhpStorm.
 * User: peyman
 * Date: 7/28/18
 * Time: 4:11 PM
 */

namespace FaraPayamak;


class Message
{
	public $text;
	public $to;
	public $from = null;
	public $username = null;
	public $password = null;

	public function __construct($text, $number)
	{

	}
}