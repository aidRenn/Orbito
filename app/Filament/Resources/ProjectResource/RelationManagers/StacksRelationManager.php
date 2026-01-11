<?php

// namespace App\Filament\Resources\ProjectResource\RelationManagers;

// use Filament\Forms;
// use Filament\Tables;
// use Filament\Resources\RelationManagers\RelationManager;

// class StacksRelationManager extends RelationManager
// {
//     protected static string $relationship = 'stacks';

//     protected static ?string $title = 'Tech Stack';

//     public function form(Forms\Form $form): Forms\Form
//     {
//         return $form->schema([
//             Forms\Components\TextInput::make('name')
//                 ->label('Stack Name')
//                 ->required()
//                 ->maxLength(100),

//             Forms\Components\TextInput::make('slug')
//                 ->required()
//                 ->maxLength(100),

//             Forms\Components\TextInput::make('color')
//                 ->label('Badge Color')
//                 ->default('primary')
//                 ->maxLength(30),
//         ]);
//     }

//     public function table(Tables\Table $table): Tables\Table
//     {
//         return $table
//             ->columns([

//                 Tables\Columns\BadgeColumn::make('name')
//                     ->colors([
//                         'primary' => 'blue',
//                         'success' => 'green',
//                         'warning' => 'yellow',
//                         'danger'  => 'red',
//                     ])
//                     ->label('Stack'),

//                 Tables\Columns\TextColumn::make('slug'),

//                 Tables\Columns\TextColumn::make('created_at')
//                     ->date(),
//             ])

//             ->headerActions([
//                 Tables\Actions\CreateAction::make(),
//             ])

//             ->actions([
//                 Tables\Actions\EditAction::make(),
//                 Tables\Actions\DetachAction::make(), // unassign from project
//             ])

//             ->bulkActions([
//                 Tables\Actions\DetachBulkAction::make(),
//             ]);
//     }
// }
