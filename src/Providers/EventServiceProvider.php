<?php

namespace Admingate\PluginManagement\Providers;

use Admingate\Installer\Events\InstallerFinished;
use Admingate\PluginManagement\Listeners\ClearPluginCaches;
use Illuminate\Contracts\Database\Events\MigrationEvent;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        MigrationEvent::class => [
            ClearPluginCaches::class,
        ],
        InstallerFinished::class => [
            ClearPluginCaches::class,
        ],
    ];
}
