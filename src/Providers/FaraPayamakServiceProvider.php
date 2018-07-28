<?php
/**
 * Created by PhpStorm.
 * User: peyman
 * Date: 7/28/18
 * Time: 4:18 PM
 */

namespace FaraPayamak\Providers;


use FaraPayamak\Client;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Config\Repository as Config;

class FaraPayamakServiceProvider extends ServiceProvider
{
	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = true;
	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		// Config file path.
		$dist = __DIR__.'/.../.../config/payamak.php';
		// If we're installing in to a Lumen project, config_path
		// won't exist so we can't auto-publish the config
		if (function_exists('config_path')) {
			// Publishes config File.
			$this->publishes([
				$dist => config_path('payamak.php'),
			]);
		}
		// Merge config.
		$this->mergeConfigFrom($dist, 'payamak');
	}
	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
		// Bind Nexmo Client in Service Container.
		$this->app->singleton(Client::class, function ($app) {
			return $this->createPayamakClient($app['config']);
		});
	}
	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return [Client::class];
	}


	private function createPayamakClient(Config $config) {
		return new Client(
			$config->get('soap'),
			$config->get('username'),
			$config->get('password'),
			$config->get('phone_number'),
			$config->get('isFlash')
		);
	}
}