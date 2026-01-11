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
        $projects = Project::with(['stacks', 'categories', 'user'])
            ->where('status', 'published')
            ->when($request->filled('search'), fn ($q) =>
                $q->where('title', 'like', "%{$request->search}%")
            )
            ->when($request->filled('categories'), fn ($q) =>
                $q->whereHas('categories', fn ($c) =>
                    $c->whereIn('slug', (array) $request->categories)
                )
            )
            ->when($request->filled('stacks'), fn ($q) =>
                $q->whereHas('stacks', fn ($s) =>
                    $s->whereIn('slug', (array) $request->stacks)
                )
            )
            ->latest()
            ->paginate(12)
            ->withQueryString();

        $featuredProjects = Project::with(['stacks', 'categories', 'user'])
            ->where('is_featured', true)
            ->where('status', 'published')
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
            'categories',
            'stacks',
            'photos' => fn ($q) => $q->orderBy('order'),
        ])->where('slug', $slug)->firstOrFail();

        $stackIds     = $project->stacks->pluck('id');
        $categoryIds  = $project->categories->pluck('id');

        $similarProjects = Project::with(['stacks', 'categories'])
            ->where('id', '!=', $project->id)
            ->where(function ($q) use ($stackIds, $categoryIds) {
                if ($stackIds->isNotEmpty()) {
                    $q->whereHas('stacks', fn ($s) =>
                        $s->whereIn('stacks.id', $stackIds)
                    );
                }

                if ($categoryIds->isNotEmpty()) {
                    $q->orWhereHas('categories', fn ($c) =>
                        $c->whereIn('categories.id', $categoryIds)
                    );
                }
            })
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
}






