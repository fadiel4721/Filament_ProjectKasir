<?php

namespace App\Filament\Resources\PembelianItemResource\Pages;

use App\Filament\Resources\PembelianItemResource;
use App\Filament\Resources\PembelianItemResource\Widgets\PembelianItemWidget;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\CreateRecord;

class CreatePembelianItem extends CreateRecord
{
    protected static string $resource = PembelianItemResource::class;

    protected function getFormActions(): array
    {
        return [
            Action::make('create')
            ->label(__('Simpan'))
            ->submit('create')
            ->keyBindings(['mod+s']),
            
        ];
    }
    protected function getRedirectUrl(): string
    {
        $id = $this ->record->pembelian_id;
        return route('filament.admin.resources.pembelian-items.create',
        [
            'pembelian_id' => $id
        ]
    );
    }
    public function getFooterWidgetsColumns(): int | array 
    {
        return 1;
    }
    public function getFooterWidgets(): array 
    {
        return [
            PembelianItemWidget::make([
                'record' => request('pembelian_id')
            ]),
        ];
    }
}
