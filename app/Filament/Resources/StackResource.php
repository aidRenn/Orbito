<?php

namespace App\Filament\Resources;

use App\Models\Stack;
use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Resource;
use Illuminate\Support\Str;
use App\Filament\Resources\StackResource\Pages;

class StackResource extends Resource
{
    protected static ?string $model = Stack::class;

    protected static ?string $navigationIcon = 'heroicon-o-cpu-chip';
    protected static ?string $navigationGroup = 'Project Data';

public static function form(Forms\Form $form): Forms\Form
{
    return $form->schema([
        Forms\Components\TextInput::make('name')
            ->required()
            ->live(onBlur: true)
            ->afterStateUpdated(fn ($state, callable $set) =>
                $set('slug', Str::slug($state))
            ),

        Forms\Components\TextInput::make('slug')
            ->disabled()
            ->dehydrated()
            ->unique(ignoreRecord: true)
            ->required(),

Forms\Components\FileUpload::make('icon')
    ->label('Icon')
    ->image()
    ->disk('public')
    ->directory('temp/stacks')
    ->nullable(),
    ]);
}


    public static function table(Tables\Table $table): Tables\Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('name')->searchable(),
            Tables\Columns\TextColumn::make('slug'),
            Tables\Columns\TextColumn::make('projects_count')
                ->counts('projects')
                ->label('Used In'),
        ])
        ->actions([
            Tables\Actions\EditAction::make(),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListStacks::route('/'),
            'create' => Pages\CreateStack::route('/create'),
            'edit'   => Pages\EditStack::route('/{record}/edit'),
        ];
    }
}
