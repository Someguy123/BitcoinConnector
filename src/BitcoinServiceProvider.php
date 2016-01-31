<?php

namespace Someguy123\BitcoinConnector;

use Validator;
use Illuminate\Support\ServiceProvider;
use JsonRPC\Client;

class BitcoinServiceProvider extends ServiceProvider
{
	/**
	 * Base58Chars
	 *
	 * This is a string containing the allowed characters in base58.
	 */
	private static $base58chars = "123456789ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijkmnopqrstuvwxyz";

	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		bcscale(8);
	}

	/**
	 * Register bindings in the container.
	 *
	 * @return void
	 */
	public function register() {
		if(env('APP_DEBUG', true) === true) {
			$this->app->bind('bitcoin', 'Someguy123\BitcoinConnector\MockBitcoin');
		} else {
			$this->app->bind('bitcoin', function() {
				$url = 'http://'.env('BTC_USER').':'.env('BTC_PASS')."@".env('BTC_HOST') . ":" . env('BTC_PORT');
				return new Client($url);
			});
		}
	}
}
