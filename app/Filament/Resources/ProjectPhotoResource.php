<?php

namespace App\Filament\Resources;

use App\Models\ProjectPhoto;
use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Resource;

class ProjectPhotoResource extends Resource
{
    protected static ?string $model = ProjectPhoto::class;

    protected static ?string $navigationIcon = null;
    protected static bool $shouldRegisterNavigation = false;

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([
            Forms\Components\FileUpload::make('photo')
                ->directory('projects/gallery')
                ->image()
                ->required(),

            Forms\Components\TextInput::make('caption'),

            Forms\Components\TextInput::make('order')
                ->numeric()
                ->default(0),
        ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table->columns([
            Tables\Columns\ImageColumn::make('photo'),
            Tables\Columns\TextColumn::make('caption'),
            Tables\Columns\TextColumn::make('order'),
        ])->actions([
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
        ]);
    }
}
