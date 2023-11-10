<?php

namespace Admingate\PluginManagement\Events;

use Admingate\Base\Events\Event;
use Illuminate\Queue\SerializesModels;

class ActivatedPluginEvent extends Event
{
    use SerializesModels;

    public string $plugin;

    public function __construct(string $plugin)
    {
        $this->plugin = $plugin;
    }
}
