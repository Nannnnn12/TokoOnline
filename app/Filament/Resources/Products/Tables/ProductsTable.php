<?php

namespace App\Filament\Resources\Products\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ProductsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('product_name')
                ->label('Nama Produk')
                    ->searchable(),
                TextColumn::make('slug')
                ->label('Slug')
                    ->searchable(),
                TextColumn::make('purchase_price')
                ->label('Harga Beli')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('sell_price')
                ->label('Harga Jual')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('stock')
                ->label('Stok')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('status')
                ->label('Status')
                    ->badge(),
                ImageColumn::make('image')
                    ->label('Gambar'),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make()
                    ->label('Edit'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                        ->label('Hapus'),
                ]),
            ]);
    }
}
