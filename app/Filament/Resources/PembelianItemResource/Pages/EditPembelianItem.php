<?php

namespace App\Filament\Resources\PembelianItemResource\Pages;

use App\Filament\Resources\PembelianItemResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPembelianItem extends EditRecord
{
    protected static string $resource = PembelianItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
