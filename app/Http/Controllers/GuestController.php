<?php

namespace App\Http\Controllers;

use App\Helpers\NavItems;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    private $navItems = [];

    public function __construct()
    {
        $this->navItems = [
            new NavItems('Home', route('guest.home'), 'home'),
            new NavItems('About', route('guest.about'), 'info'),
            new NavItems('Contact', route('guest.contact'), 'call'),
            new NavItems('Projects', route('guest.projects'), 'docs'),
        ];
    }

    public function home()
    {
        $this->navItems[0]->active = true;
        return view('guest.home', [
            'navItems' => $this->navItems,
        ]);
    }

    public function about()
    {
        $this->navItems[1]->active = true;
        return view('guest.about', [
            'navItems' => $this->navItems,
        ]);
    }

    public function contact()
    {
        $this->navItems[2]->active = true;
        return view('guest.contact', [
            'navItems' => $this->navItems,
        ]);
    }

    public function projects()
    {
        $this->navItems[3]->active = true;
        return view('guest.projects', [
            'navItems' => $this->navItems,
        ]);
    }
}
