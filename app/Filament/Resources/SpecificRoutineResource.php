<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SpecificRoutineResource\Pages;
use App\Filament\Resources\SpecificRoutineResource\RelationManagers;
use App\Models\SpecificRoutine;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Section;

class SpecificRoutineResource extends Resource
{
    protected static ?string $model = SpecificRoutine::class;

    protected static ?string $navigationGroup = 'Exercise Manager';

    protected static ?string $navigationIcon = 'heroicon-o-trophy';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('New Details Exercise')
                    ->description('Create or update routines to start your exercises.')
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('series')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('repetitions')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('rest')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Select::make('category_id')
                            ->relationship('category', 'name')
                            ->searchable()
                            ->preload()
                            ->createOptionForm([
                                Forms\Components\TextInput::make('name')
                                    ->label('Category Name')
                                    ->required()
                                    ->maxLength(255),
                                Forms\Components\Textarea::make('description')
                                    ->required()
                                    ->maxLength(255),
                            ])
                            ->required(),
                        Forms\Components\Select::make('routine_id')
                            ->relationship('routine', 'name')
                            ->searchable()
                            ->preload()
                            ->createOptionForm([
                                Forms\Components\TextInput::make('name')
                                    ->required()
                                    ->maxLength(255),
                                Forms\Components\Textarea::make('description')
                                    ->columnSpanFull()
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('duration')
                                    ->numeric(),
                                Forms\Components\TextInput::make('level')
                                    ->maxLength(255),
                            ])
                            ->required(),
                        Forms\Components\Select::make('exercise_id')
                            ->relationship('exercise', 'name')
                            ->searchable()
                            ->preload()
                            ->createOptionForm([
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
                                Forms\Components\TextInput::make('level_of_difficulty')
                                    ->maxLength(255),
                            ])
                            ->required(),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('series')
                    ->searchable(),
                Tables\Columns\TextColumn::make('repetitions')
                    ->searchable(),
                Tables\Columns\TextColumn::make('rest')
                    ->searchable(),
                Tables\Columns\TextColumn::make('category.name')
                    ->numeric()
                    ->searchable(),
                Tables\Columns\TextColumn::make('routine.name')
                    ->numeric()
                    ->searchable(),
                Tables\Columns\TextColumn::make('exercise.name')
                    ->numeric()
                    ->searchable(),
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
            'index' => Pages\ListSpecificRoutines::route('/'),
            'create' => Pages\CreateSpecificRoutine::route('/create'),
            'edit' => Pages\EditSpecificRoutine::route('/{record}/edit'),
        ];
    }
}
