<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Category;
use App\Models\Stack;

class ProjectController extends Controller
{
public function index(Request $request)
{
    $projects = Project::with(['stacks', 'category'])
        ->when($request->filled('search'), fn ($q) =>
            $q->where('title', 'like', "%{$request->search}%")
        )
        ->when($request->filled('categories'), fn ($q) =>
            $q->whereHas('category', fn ($c) =>
                $c->whereIn('slug', $request->categories)
            )
        )
        ->when($request->filled('stacks'), fn ($q) =>
            $q->whereHas('stacks', fn ($s) =>
                $s->whereIn('slug', $request->stacks)
            )
        )

        ->latest()
        ->paginate(12)
        ->withQueryString();

    $featuredProjects = Project::with('stacks')
        ->where('is_featured', true)
        ->latest()
        ->get();

    return view('pages.projects.index', [
        'projects'         => $projects,
        'featuredProjects' => $featuredProjects,
        'categories'       => Category::all(),
        'stacks'           => Stack::all(),
    ]);
}


public function show(string $slug)
{
    $project = Project::with([
        'category',
        'stacks',
        'photos' => fn ($q) => $q->orderBy('order'),
    ])->where('slug', $slug)->firstOrFail();

    $stackIds = $project->stacks->pluck('id');

    $similarProjects = Project::with('stacks')
        ->where('id', '!=', $project->id)
        ->when($stackIds->isNotEmpty(), fn ($q) =>
            $q->whereHas('stacks', fn ($s) =>
                $s->whereIn('stacks.id', $stackIds)
            )
        )
        ->orWhere('category_id', $project->category_id)
        ->limit(4)
        ->get();

    $seo = [
        'title'       => $project->title . ' – Project Showcase',
        'description' => \Illuminate\Support\Str::limit(strip_tags($project->overview), 155),
        'image'       => $project->thumbnail,
        'url'         => route('projects.show', $project->slug),
    ];

    return view('pages.projects.show', [
        'project'         => $project,
        'similarProjects' => $similarProjects,
        'categories'      => Category::all(),
        'stacks'          => Stack::all(),
        'seo'             => $seo,
    ]);
}


// public function show(string $slug)
// {
//     $project = Project::with([
//         'category',
//         'stacks',
//         'photos' => fn ($q) => $q->orderBy('order'),
//     ])->where('slug', $slug)->firstOrFail();

//     return view('pages.projects.show', [
//         'project'    => $project,
//         'categories' => Category::all(),
//         'stacks'     => Stack::all(),
//     ]);
// }


}
