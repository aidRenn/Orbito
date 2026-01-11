<?php

namespace App\Http\Controllers\Workspace;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Project;
use App\Models\Category;
use App\Models\Stack;
use Illuminate\Support\Str;




class ProjectController extends Controller
{
    public function index()
    {
        $projects = auth()->user()
            ->projects()
            ->with(['categories'])
            ->latest()
            ->paginate(10);

        return view('workspace.projects.index', [
            'projects' => $projects,
        ]);
    }

    
    
public function create()
{
    return view('workspace.projects.create', [
        'categories' => Category::all(),
        'stacks'     => Stack::all(),
    ]);
}

// store atau create
public function store(Request $request)
{
    $data = $request->validate([
        'title'        => ['required', 'string', 'max:255'],
        'slug'         => ['nullable', 'string', 'max:255', 'unique:projects,slug'],
        'thumbnail'    => ['required', 'image'],
        'overview'     => ['nullable', 'string'],
        'features'     => ['nullable', 'string'],
        'status'       => ['required', 'in:draft,published,archived'],
        'project_url'  => ['nullable', 'url'],
        'github_url'   => ['nullable', 'url'],
        'categories'   => ['required', 'array'],
        'categories.*' => ['exists:categories,id'],
        'stacks'       => ['nullable', 'array'],
        'stacks.*'     => ['exists:stacks,id'],
    ]);

    // Auto-generate slug if empty
    if (empty($data['slug'])) {
        $base = Str::slug($data['title']);
        $slug = $base;
        $i = 1;

        while (Project::where('slug', $slug)->exists()) {
            $slug = $base . '-' . $i++;
        }

        $data['slug'] = $slug;
    }

    if (! empty($data['features'])) {
        $lines = collect(
            preg_split("/\r\n|\n|\r/", $data['features'])
        )
            ->map(fn ($v) => trim($v))
            ->filter()
            ->values();

        $data['features'] = $lines
            ->map(fn ($v) => ['text' => $v])
            ->toArray();
    }

    $data['user_id'] = auth()->id();

    $project = Project::create($data);

    $project->categories()->sync($data['categories']);
    $project->stacks()->sync($data['stacks'] ?? []);

    return redirect()
        ->route('workspace.projects.edit', $project->id)
        ->with('success', 'Project created.');
}



public function edit($id)
{
    $project = auth()->user()
        ->projects()
        ->with(['categories', 'stacks'])
        ->findOrFail($id);

    return view('workspace.projects.edit', [
        'project'    => $project,
        'categories' => Category::all(),
        'stacks'     => Stack::all(),
    ]);
}

public function update(Request $request, $id)
{
    $project = auth()->user()
        ->projects()
        ->findOrFail($id);

    $data = $request->validate([
        'title'        => ['required', 'string', 'max:255'],
        'slug'         => ['nullable', 'string', 'max:255', 'unique:projects,slug,' . $project->id],
        'thumbnail'    => ['nullable', 'image'],
        'overview'     => ['nullable', 'string'],
        'features'     => ['nullable', 'string'],
        'status'       => ['required', 'in:draft,published,archived'],
        'project_url'  => ['nullable', 'url'],
        'github_url'   => ['nullable', 'url'],
        'categories'   => ['required', 'array'],
        'categories.*' => ['exists:categories,id'],
        'stacks'       => ['nullable', 'array'],
        'stacks.*'     => ['exists:stacks,id'],
    ]);

    // Auto-generate slug if empty
    if (empty($data['slug'])) {
        $base = Str::slug($data['title']);
        $slug = $base;
        $i = 1;

        while (
            Project::where('slug', $slug)
                ->where('id', '!=', $project->id)
                ->exists()
        ) {
            $slug = $base . '-' . $i++;
        }

        $data['slug'] = $slug;
    }

    if (! empty($data['features'])) {
        $lines = collect(
            preg_split("/\r\n|\n|\r/", $data['features'])
        )
            ->map(fn ($v) => trim($v))
            ->filter()
            ->values();

        $data['features'] = $lines
            ->map(fn ($v) => ['text' => $v])
            ->toArray();
    }

    $project->update($data);

    $project->categories()->sync($data['categories']);
    $project->stacks()->sync($data['stacks'] ?? []);

    return back()->with('success', 'Project updated.');
}


// delete
public function destroy($id)
{
    $project = auth()->user()
        ->projects()
        ->findOrFail($id);

    $project->delete();

    return redirect()
        ->route('workspace.projects.index')
        ->with('success', 'Project deleted.');
}

}
