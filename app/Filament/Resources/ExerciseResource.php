<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ExerciseResource\Pages;
use App\Filament\Resources\ExerciseResource\RelationManagers;
use App\Models\Exercise;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\IconColumn;

class ExerciseResource extends Resource
{
    protected static ?string $model = Exercise::class;

    protected static ?string $navigationGroup = 'System Manager';

    protected static ?string $navigationIcon = 'heroicon-o-bolt';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Section::make('Exercise Details')
                    ->icon('heroicon-s-bolt')
                    ->description('Use this form to register a new exercise or update an existing exercise.')
                    ->columns(3)
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->columnSpanFull()
                            ->maxLength(255),
                        Forms\Components\Textarea::make('description')
                            ->columnSpanFull()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('muscle_group')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('recommended_equipment')
                            ->maxLength(255),
                        Forms\Components\Select::make('level_of_difficulty')
                            ->label('Level')
                            ->options([
                                'Intermediate' => 'Intermediate',
                                'Begginer' => 'Begginer',
                                'Advanced' => 'Advanced',
                            ])
                            ->searchable()
                            ->native(false),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->icon('heroicon-s-bolt')
                    ->searchable(),
                Tables\Columns\TextColumn::make('muscle_group')
                    ->searchable(),
                // Tables\Columns\TextColumn::make('recommended_equipment')
                //     ->searchable(),
                Tables\Columns\TextColumn::make('level_of_difficulty')
                    ->searchable(),
                // Tables\Columns\IconColumn::make('status')
                //     ->icon(fn (string $table): string => match ($table) {
                //         'Intermediate' => 'heroicon-c-heart',
                //         'Beginner' => 'heroicon-c-heart', 
                //         'Advanced' => 'heroicon-c-heart',
                //     }),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListExercises::route('/'),
            'create' => Pages\CreateExercise::route('/create'),
            'edit' => Pages\EditExercise::route('/{record}/edit'),
        ];
    }
}
