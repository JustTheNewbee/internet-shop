<?php

namespace ShopCore\Infrastructure;

use Illuminate\Foundation\Application;

class DomainCommandsDispatcher
{
    /**
     * @var Application
     */
    protected $app;

    /**
     * DomainCommandsDispatcher constructor.
     *
     * @param Application $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    public function handle($eventName, $arg)
    {
        $explodedNamespace = explode('\\', $eventName);
        $explodedNamespace[count($explodedNamespace) - 1] = 'Handler';

        return ($this->app->make(implode('\\', $explodedNamespace)))->handle(reset($arg));
    }
}
