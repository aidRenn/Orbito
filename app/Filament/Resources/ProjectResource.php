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
use Illuminate\Support\Facades\Auth;

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
                        ->default(false),

                    Forms\Components\FileUpload::make('thumbnail')
                        ->label('Thumbnail')
                        ->image()
                        ->disk('public')
                        ->directory('temp/projects/thumbnails')
                        ->preserveFilenames()
                        ->required(fn ($record) => $record === null) // hanya required saat create
                        ->dehydrated(fn ($state) => filled($state)), // jangan kirim null saat edit


                    // MULTI CATEGORY
                    Forms\Components\Select::make('categories')
                        ->label('Categories')
                        ->multiple()
                        ->relationship('categories', 'name')
                        ->preload()
                        ->required(),

                    Forms\Components\Select::make('stacks')
                        ->multiple()
                        ->relationship('stacks', 'name')
                        ->preload(),

                ])->columns(2),

            Forms\Components\Section::make('Details')
                ->schema([

                    Forms\Components\Textarea::make('overview')
                        ->rows(4),

                    Forms\Components\Repeater::make('features')
                        ->schema([
                            Forms\Components\TextInput::make('text')->required(),
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

            Tables\Columns\TextColumn::make('categories.name')
                ->label('Categories')
                ->listWithLineBreaks(),

            Tables\Columns\BadgeColumn::make('stacks.name')
                ->label('Tech')
                ->listWithLineBreaks(),

            Tables\Columns\TextColumn::make('created_at')->date(),
        ])
        ->filters([
            SelectFilter::make('categories')
                ->relationship('categories', 'name')
                ->multiple()
                ->label('Categories'),

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

        public static function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = Auth::id();

        return $data;
    }

    public static function mutateFormDataBeforeSave(array $data): array
    {
        if (! isset($data['user_id'])) {
            $data['user_id'] = Auth::id();
        }

        return $data;
    }
}
