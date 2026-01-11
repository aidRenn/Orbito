<?php
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;


// landigng page
Route::get('/', [HomeController::class, 'index'])->name('home'); 
Route::post('/contact', [ContactController::class, 'store']) ->name('contact.store');

// GLOBAL SHOWCASE (tetap public)
Route::get('/dashboard', [ProjectController::class, 'index'])
    ->name('dashboard');

Route::get('/dashboard/{slug}', [ProjectController::class, 'show']) 
    ->name('projects.show');

// auth page
Route::get('/auth', fn () => view('auth.auth'))->name('auth.page');

// Override Breeze pages
Route::get('/login', fn () => redirect()->route('auth.page'))->name('login');
Route::get('/register', fn () => redirect()->route('auth.page'))->name('register');



// AUTH USER AREA
Route::middleware('auth')->group(function () {

    // Route::get('/workspace', function () {
    //     return view('workspace.index');
    // })->name('workspace');

    Route::get('/workspace/projects', [
        \App\Http\Controllers\Workspace\ProjectController::class,
        'index'
    ])->name('workspace.projects.index');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Create Project
    Route::get('/workspace/projects/create', [
        \App\Http\Controllers\Workspace\ProjectController::class,
        'create'
    ])->name('workspace.projects.create');

    Route::post('/workspace/projects', [
        \App\Http\Controllers\Workspace\ProjectController::class,
        'store'
    ])->name('workspace.projects.store');

    // Edit Project
    Route::get('/workspace/projects/{project}/edit', [
    \App\Http\Controllers\Workspace\ProjectController::class,
    'edit'
    ])->name('workspace.projects.edit');

    Route::put('/workspace/projects/{project}', [
        \App\Http\Controllers\Workspace\ProjectController::class,
        'update'
    ])->name('workspace.projects.update');


    // Delete Project
    Route::delete('/workspace/projects/{project}', [
    \App\Http\Controllers\Workspace\ProjectController::class,
    'destroy'
    ])->name('workspace.projects.destroy');

    //  manage gallery photos
    Route::get('/workspace/projects/{project}/photos', [
    \App\Http\Controllers\Workspace\ProjectPhotoController::class,
    'index'
    ])->name('workspace.projects.photos.index');

    Route::post('/workspace/projects/{project}/photos', [
        \App\Http\Controllers\Workspace\ProjectPhotoController::class,
        'store'
    ])->name('workspace.projects.photos.store');

    Route::delete('/workspace/projects/{project}/photos/{photo}', [
        \App\Http\Controllers\Workspace\ProjectPhotoController::class,
        'destroy'
    ])->name('workspace.projects.photos.destroy');


});

require __DIR__.'/auth.php';
