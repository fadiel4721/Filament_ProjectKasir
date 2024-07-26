<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PembelianResource\Pages;
use App\Filament\Resources\PembelianResource\RelationManagers;
use App\Models\Pembelian;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PembelianResource extends Resource
{
    protected static ?string $model = Pembelian::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\DatePicker::make('tanggal')
                ->label('Tanggal Pembelian')
                ->required()
                ->default(now())->columnSpanFull(),
                Forms\Components\Select::make('supplier_id')
                ->label('Pilih Supplier')
                ->options(
                    \App\Models\Supplier::pluck('nama_perusahaan', 'id')
                )
                ->searchable()
                ->required()
                ->createOptionForm(
                  \App\Filament\Resources\SupplierResource::getForm(),
                )->createOptionUsing(function (array $data):int {
                    return \App\Models\Supplier::create($data)->id;
                })
                ->reactive()
                ->afterStateUpdated(function($state, Set $set){
                    $supplier = \App\Models\Supplier::find($state);
                    $set('email', $supplier->email ?? null);
                }),
                Forms\Components\TextInput::make('email')->disabled(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('supplier.nama_perusahaan')->label('Nama Supplier'),
                TextColumn::make('supplier.nama')->label('Nama Sales'),
                TextColumn::make('tanggal')->dateTime('d F Y')->label('Tanggal Pembelian'),

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
            'index' => Pages\ListPembelians::route('/'),
            'create' => Pages\CreatePembelian::route('/create'),
            'edit' => Pages\EditPembelian::route('/{record}/edit'),
        ];
    }
}
