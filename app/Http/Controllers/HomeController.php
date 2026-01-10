<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function index()
    {
        return view('home', [
            'navLinks'      => config('nav'),
            'words'         => config('hero'),
            'features'      => config('features'),
            'experiences'   => config('experience'),
            'testimonials'  => config('testimonials'),
            'counterItems'  => config('counter'),
            'socials'      => config('socials'),
        ]);
    }
}
