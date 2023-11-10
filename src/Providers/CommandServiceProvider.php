<?php

namespace Admingate\PluginManagement\Providers;

use Admingate\PluginManagement\Commands\ClearCompiledCommand;
use Admingate\PluginManagement\Commands\IlluminateClearCompiledCommand as OverrideIlluminateClearCompiledCommand;
use Admingate\PluginManagement\Commands\PackageDiscoverCommand;
use Admingate\PluginManagement\Commands\PluginActivateAllCommand;
use Admingate\PluginManagement\Commands\PluginActivateCommand;
use Admingate\PluginManagement\Commands\PluginAssetsPublishCommand;
use Admingate\PluginManagement\Commands\PluginDeactivateAllCommand;
use Admingate\PluginManagement\Commands\PluginDeactivateCommand;
use Admingate\PluginManagement\Commands\PluginDiscoverCommand;
use Admingate\PluginManagement\Commands\PluginListCommand;
use Admingate\PluginManagement\Commands\PluginRemoveAllCommand;
use Admingate\PluginManagement\Commands\PluginRemoveCommand;
use Illuminate\Foundation\Console\ClearCompiledCommand as IlluminateClearCompiledCommand;
use Illuminate\Foundation\Console\PackageDiscoverCommand as IlluminatePackageDiscoverCommand;
use Illuminate\Support\ServiceProvider;

class CommandServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->extend(IlluminatePackageDiscoverCommand::class, function () {
            return $this->app->make(PackageDiscoverCommand::class);
        });

        $this->app->extend(IlluminateClearCompiledCommand::class, function () {
            return $this->app->make(OverrideIlluminateClearCompiledCommand::class);
        });
    }

    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                PluginAssetsPublishCommand::class,
                ClearCompiledCommand::class,
                PluginDiscoverCommand::class,
            ]);
        }

        $this->commands([
            PluginActivateCommand::class,
            PluginActivateAllCommand::class,
            PluginDeactivateCommand::class,
            PluginDeactivateAllCommand::class,
            PluginRemoveCommand::class,
            PluginRemoveAllCommand::class,
            PluginListCommand::class,
        ]);
    }
}
