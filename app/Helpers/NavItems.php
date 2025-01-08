<?php

namespace App\Helpers;

class NavItems
{
    public $name;
    public $route;
    public $active;
    public $icon;

    public function __construct(string $name, string $route, string $icon = '', bool $active = false)
    {
        $this->name = ucfirst($name);
        $this->route = $route;
        $this->icon = $icon;
        $this->active = $active;
    }
}
