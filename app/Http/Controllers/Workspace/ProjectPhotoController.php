<?php

namespace App\Http\Controllers\Workspace;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectPhoto;
use Illuminate\Http\Request;

class ProjectPhotoController extends Controller
{
    public function index($projectId)
    {
        $project = auth()->user()
            ->projects()
            ->with('photos')
            ->findOrFail($projectId);

        return view('workspace.projects.photos.index', [
            'project' => $project,
        ]);
    }

public function store(Request $request, $projectId)
{
    $project = auth()->user()
        ->projects()
        ->findOrFail($projectId);

    $request->validate([
        'photo' => ['required', 'image'],
    ]);

    $project->photos()->create([
        'photo' => $request->file('photo'), // ← ini yang krusial
        'order' => $project->photos()->count() + 1,
    ]);

    return back()->with('success', 'Photo added.');
}


    public function destroy($projectId, $photoId)
    {
        $project = auth()->user()
            ->projects()
            ->findOrFail($projectId);

        $photo = $project->photos()->findOrFail($photoId);

        $photo->delete();

        return back()->with('success', 'Photo deleted.');
    }
}
