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
                    ->options([
                        'pending' => 'Pending',
                        'belum_dibayar' => 'Belum Dibayar',
                        'processing' => 'Processing',
                        'shipped' => 'Shipped',
                        'delivered' => 'Delivered',
                        'cancelled' => 'Cancelled',
                    ])
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
