<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BarangResource\Pages;
use App\Filament\Resources\BarangResource\RelationManagers;
use App\Models\Barang;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;


class BarangResource extends Resource
{
    protected static ?string $model = Barang::class;

    protected static ?string $navigationIcon = 'heroicon-o-cube';

    protected static ?string $label = 'Data Barang';

    public static function form(Form $form): Form
    {
        
        return $form
            ->schema([
            TextInput::make('kode')->required(),  
            TextInput::make('nama')
                ->label('Nama Barang'),
            TextInput::make('harga')
                ->label('Harga Barang'),
            TextInput::make('stok')
            ->disabledOn('edit')
            ->label('Stok Awal'),
            Select::make('satuan')
            ->options([
                'pcs' => 'Pcs',
                'kg' => 'Kg',
                'box' => 'Box',
                'liter' => 'Liter',
            ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('kode')->searchable(),
                TextColumn::make('nama')
                ->label('Nama Barang')
                ->searchable(),
                TextColumn::make('harga')
                ->label('Harga')
                ->searchable(),
                TextColumn::make('stok')->label('Stok Barang'),
                TextColumn::make('satuan'),
            ])
            ->filters([
                //
            ])
            ->actions([
                EditAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
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
            'index' => Pages\ListBarangs::route('/'),
            'create' => Pages\CreateBarang::route('/create'),
            'edit' => Pages\EditBarang::route('/{record}/edit'),
        ];
    }
}
