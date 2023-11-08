<?php

namespace App\Filament\Resources\AppoinmentResource\Pages;

use App\Filament\Resources\AppoinmentResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAppoinments extends ListRecords
{
    protected static string $resource = AppoinmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
