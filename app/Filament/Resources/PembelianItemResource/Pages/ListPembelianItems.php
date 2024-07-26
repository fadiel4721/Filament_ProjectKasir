<?php

namespace App\Filament\Resources\PembelianItemResource\Pages;

use App\Filament\Resources\PembelianItemResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPembelianItems extends ListRecords
{
    protected static string $resource = PembelianItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
