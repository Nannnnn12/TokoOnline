<?php

namespace App\Filament\Resources\Transactions\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class TransactionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('order_code')
                    ->required()
                    ->disabled(),
                Select::make('customer_id')
                    ->relationship('customer', 'name')
                    ->required()
                    ->disabled(),
                Textarea::make('address')
                    ->label('Alamat Pengiriman')
                    ->required()
                    ->disabled()
                    ->columnSpanFull(),
                Select::make('status')
                    ->options(function ($record) {
                        $options = [
                            'pending' => 'Pending',
                            'processing' => 'Processing',
                            'shipped' => 'Shipped',
                            'delivered' => 'Delivered',
                            'cancelled' => 'Cancelled',
                        ];
                        if ($record && $record->payment_method !== 'cod') {
                            $options['belum_dibayar'] = 'Belum Dibayar';
                        }
                        return $options;
                    })
                    ->default('pending')
                    ->required(),
                TextInput::make('total')
                    ->required()
                    ->numeric()
                    ->default(0.0)
                    ->disabled(),
                Textarea::make('notes')
                    ->label('Catatan')
                    ->default(null)
                    ->disabled()
                    ->columnSpanFull(),
                Select::make('payment_method')
                    ->label('Metode Pembayaran')
                    ->options(['cod' => 'Bayar di Tempat (COD)'])
                    ->default('cod')
                    ->required()
                    ->disabled(),
            ]);
    }
}
