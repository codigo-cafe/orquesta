<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Event;
use App\Models\Member;
use App\Models\Orchestra;
use App\Models\Point;
use App\Models\Promotion;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function events()
    {
        return Inertia::render('Admin/Reports/Events', [
            'orchestra' => Orchestra::first(),
            'events' => Event::all()->count(),
            'points' => Point::all()->count(),
            'services' => Service::all()->count(),
            'promotions' => Promotion::all()->count(),
            'members' => Member::all()->count(),
            'users' => User::all()->count(),
        ]);
    }

    public function points()
    {
        return Inertia::render('Admin/Reports/Points', [
            'orchestra' => Orchestra::first(),
            'events' => Event::all()->count(),
            'points' => Point::all()->count(),
            'services' => Service::all()->count(),
            'promotions' => Promotion::all()->count(),
            'members' => Member::all()->count(),
            'users' => User::all()->count(),
        ]);
    }

    public function services()
    {
        return Inertia::render('Admin/Reports/Services', [
            'orchestra' => Orchestra::first(),
            'events' => Event::all()->count(),
            'points' => Point::all()->count(),
            'services' => Service::all()->count(),
            'promotions' => Promotion::all()->count(),
            'members' => Member::all()->count(),
            'users' => User::all()->count(),
        ]);
    }

    public function promotions()
    {
        return Inertia::render('Admin/Reports/Promotions', [
            'orchestra' => Orchestra::first(),
            'events' => Event::all()->count(),
            'points' => Point::all()->count(),
            'services' => Service::all()->count(),
            'promotions' => Promotion::all()->count(),
            'members' => Member::all()->count(),
            'users' => User::all()->count(),
        ]);
    }

    public function members()
    {
        return Inertia::render('Admin/Reports/Members', [
            'orchestra' => Orchestra::first(),
            'events' => Event::all()->count(),
            'points' => Point::all()->count(),
            'services' => Service::all()->count(),
            'promotions' => Promotion::all()->count(),
            'members' => Member::all()->count(),
            'users' => User::all()->count(),
        ]);
    }

    public function users()
    {
        return Inertia::render('Admin/Reports/Users', [
            'orchestra' => Orchestra::first(),
            'events' => Event::all()->count(),
            'points' => Point::all()->count(),
            'services' => Service::all()->count(),
            'promotions' => Promotion::all()->count(),
            'members' => Member::all()->count(),
            'users' => User::all()->count(),
        ]);
    }
}
