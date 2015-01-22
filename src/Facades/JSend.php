<?php namespace Papasmurf\JSend\Facades;

use Illuminate\Support\Facades\Facade;

class JSend extends Facade
{

    /**-
     * Name of the binding in the IoC container
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'JSend';
    }
}