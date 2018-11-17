<?php

namespace ShopCore\Infrastructure;

use Illuminate\Foundation\Support\Providers\EventServiceProvider;

class ShopCoreServiceProvider extends EventServiceProvider
{
    protected $listen = [
        'ShopCore\DomainCommands\*' => [
            DomainCommandsDispatcher::class,
        ],
    ];

}
