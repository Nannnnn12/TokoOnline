<?php

namespace App\Filament\Resources\Transactions\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Table;

class TransactionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('order_code')
                    ->searchable(),
                TextColumn::make('customer.name')
                    ->label('Customer')
                    ->searchable(),
                SelectColumn::make('status')
                    ->options(function ($record) {
                        $options = [
                            'pending' => 'Pending',
                            'processing' => 'Processing',
                            'shipped' => 'Shipped',
                            'delivered' => 'Delivered',
                            'cancelled' => 'Cancelled',
                        ];
                        if ($record->payment_method !== 'cod') {
                            $options['belum_dibayar'] = 'Belum Dibayar';
                        }
                        return $options;
                    })
                    ->rules(['required'])
                    ->selectablePlaceholder(false),
                TextColumn::make('total')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('province')
                    ->label('Provinsi')
                    ->toggleable(),
                TextColumn::make('city')
                    ->label('Kota')
                    ->toggleable(),
                TextColumn::make('district')
                    ->label('Kecamatan')
                    ->toggleable(),
                TextColumn::make('courier')
                    ->label('Kurir')
                    ->badge()
                    ->color('success')
                    ->toggleable(),
                TextColumn::make('courier_service')
                    ->label('Layanan Kurir')
                    ->badge()
                    ->color('primary')
                    ->toggleable(),
                TextColumn::make('shipping_cost')
                    ->label('Biaya Pengiriman')
                    ->money('IDR')
                    ->toggleable(),
                TextColumn::make('tracking_number')
                    ->label('Nomor Resi')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('payment_method')
                    ->label('Metode Pembayaran')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'midtrans' => 'info',
                        default => 'warning',
                    }),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make()
                    ->label('Lihat')
                    ->icon('heroicon-o-eye'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
