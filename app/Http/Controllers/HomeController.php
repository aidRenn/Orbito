<?php

namespace App\Http\Controllers;
use App\Models\Project;

class HomeController extends Controller
{
    public function index()
    {

            $featuredProjects = Project::with(['stacks', 'categories', 'user'])
            ->where('is_featured', true)
            ->where('status', 'published')
            ->latest()
            ->get();
        return view('home', [
            'navLinks'      => config('nav'),
            'words'         => config('hero'),
            'features'      => config('features'),
            'experiences'   => config('experience'),
            'testimonials'  => config('testimonials'),
            'counterItems'  => config('counter'),
            'socials'      => config('socials'),
            'featuredProjects'=> $featuredProjects,
        ]);
    }
}
