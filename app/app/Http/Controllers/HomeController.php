<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View as View;
use Illuminate\Contracts\View\Factory as Factory;
use Illuminate\Contracts\Foundation\Application as Application;

class HomeController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('home');
    }
}
