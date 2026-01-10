<?php

namespace App\Filament\Resources;

use App\Models\Project;
use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Resource;
use Illuminate\Support\Str;
use App\Filament\Resources\ProjectResource\Pages;
use App\Filament\Resources\ProjectResource\RelationManagers;
use Filament\Tables\Filters\SelectFilter;



class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    protected static ?string $navigationIcon = 'heroicon-o-folder';
    protected static ?string $navigationGroup = 'Projects';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([

            Forms\Components\Section::make('Basic Information')
            ->schema([

                Forms\Components\TextInput::make('title')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn ($state, callable $set) =>
                    $set('slug', Str::slug($state))
                ),

                Forms\Components\TextInput::make('slug')
                    ->disabled()
                    ->dehydrated()
                    ->required(),

                Forms\Components\Toggle::make('is_featured')
                    ->label('Featured Project')
                    ->helperText('Project ini akan tampil di highlight dashboard')
                    ->default(false),

                Forms\Components\FileUpload::make('thumbnail')
                    ->label('Thumbnail')
                    ->image()
                    ->required()
                    ->disk('public')
                    ->directory('temp/projects/thumbnails')
                    ->preserveFilenames()
                    ->acceptedFileTypes([
                        'image/png',
                        'image/jpg',
                        'image/jpeg',
                        'image/webp',
                    ]),



                Forms\Components\Select::make('category_id')
                    ->relationship('category', 'name')
                    // ->searchable()
                    ->preload()
                    ->required(),

                Forms\Components\Select::make('stacks')
                    ->relationship('stacks', 'name')
                    ->multiple()
                    ->preload(),
            ])->columns(2),

            Forms\Components\Section::make('Details')
            ->schema([
                Forms\Components\Textarea::make('overview')
                    ->rows(4),

                Forms\Components\Repeater::make('features')
                    ->schema([
                        Forms\Components\TextInput::make('text'),
                    ])
                    ->collapsed()
                    ->grid(2),

                Forms\Components\TextInput::make('project_url')
                    ->label('Live URL')
                    ->url(),

                Forms\Components\TextInput::make('github_url')
                    ->url(),

            ])->columns(2),

        ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table->columns([
            Tables\Columns\ImageColumn::make('thumbnail')->square(),

            Tables\Columns\TextColumn::make('title')
                ->searchable()
                ->limit(30),

            Tables\Columns\TextColumn::make('category.name'),

            Tables\Columns\BadgeColumn::make('stacks.name')
                ->colors(['primary'])
                ->label('Tech'),

            Tables\Columns\TextColumn::make('created_at')->date(),
        ])

        ->filters([
            SelectFilter::make('category')
                ->relationship('category', 'name')
                ->label('Category'),

            SelectFilter::make('stacks')
                ->relationship('stacks', 'name')
                ->multiple()
                ->label('Tech Stack'),
        ])

        ->actions([
            Tables\Actions\EditAction::make(),
        ]);
    }

        public static function getPages(): array
    {
        return [
            'index'  => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'edit'   => Pages\EditProject::route('/{record}/edit'),
        ];
    }

        public static function getRelations(): array
    {
        return [
            RelationManagers\PhotosRelationManager::class,
        ];
    }


}
