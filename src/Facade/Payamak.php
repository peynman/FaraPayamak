<?php
/**
 * Created by PhpStorm.
 * User: peyman
 * Date: 7/28/18
 * Time: 4:21 PM
 */

namespace FaraPayamak\Facade;


use FaraPayamak\Client;
use Illuminate\Support\Facades\Facade;

class Payamak extends Facade
{
	/**
	 * Get the registered name of the component.
	 *
	 * @return string
	 *
	 * @throws \RuntimeException
	 */
	protected static function getFacadeAccessor()
	{
		return Client::class;
	}
}