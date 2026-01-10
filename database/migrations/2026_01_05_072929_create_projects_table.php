<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->string('slug')->unique();

            $table->string('thumbnail'); // main image

            $table->foreignId('category_id')
                ->constrained()
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->text('overview')->nullable();   // intro / description
            $table->longText('features')->nullable(); // json / markdown features

            $table->enum('status', ['draft', 'published', 'archived'])
                  ->default('draft');

            $table->string('client_name')->nullable();

            $table->string('project_url')->nullable();
            $table->string('github_url')->nullable();

            $table->date('started_at')->nullable();
            $table->date('finished_at')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
