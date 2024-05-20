<?php

namespace App\Filament\Resources\SpecificRoutineResource\Pages;

use App\Filament\Resources\SpecificRoutineResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSpecificRoutines extends ListRecords
{
    protected static string $resource = SpecificRoutineResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
