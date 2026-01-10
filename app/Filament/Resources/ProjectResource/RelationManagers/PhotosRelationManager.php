<?php

namespace App\Filament\Resources\ProjectResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Resources\RelationManagers\RelationManager;
use Illuminate\Http\UploadedFile;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use App\Services\CloudinaryService;
use Illuminate\Support\Facades\Storage;
use App\Models\ProjectPhoto;

class PhotosRelationManager extends RelationManager
{
    protected static string $relationship = 'photos';

    protected static ?string $title = 'Gallery Photos';

    public function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([
            Forms\Components\FileUpload::make('photo')
                ->label('Photo')
                ->image()
                ->disk('public')
                ->directory('temp/projects/photos')
                ->required(),

            Forms\Components\TextInput::make('caption')
                ->nullable(),

            Forms\Components\TextInput::make('order')
                ->numeric()
                ->nullable(),
        ]);
    }

    public function table(Tables\Table $table): Tables\Table
    {
        return $table->columns([
            Tables\Columns\ImageColumn::make('photo')->square(),

            Tables\Columns\TextColumn::make('caption')
                ->limit(30),

            Tables\Columns\TextColumn::make('order'),
        ])
        ->headerActions([
            Tables\Actions\CreateAction::make(),
        ])
        ->actions([
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
        ])
        ->reorderable('order');
    }
}
