<?php namespace Papasmurf\JSend;

use Illuminate\Support\ServiceProvider;

class JSendServiceProvider extends ServiceProvider
{
	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

    /**
     * Booting
     */
    public function boot()
    {
        $this->package('papasmurf/JSend');
    }

	/**
	 * Register the commands
	 *
	 * @return void
	 */
	public function register()
	{
        return $this->app->singleton('jsend', function () {
            return new JSend;
        });
	}
}