<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('product_name')
                ->label('Nama Produk')
                    ->required()
                    ->afterStateUpdated(function (Set $set, ?string $state) {
                        $set('slug', Str::slug($state));
                    }),
                Textarea::make('description')
                    ->label('Deskripsi')
                    ->default(null)
                    ->columnSpanFull(),
                TextInput::make('purchase_price')
                ->label('Harga Beli')
                    ->required()
                    ->numeric(),
                TextInput::make('sell_price')
                ->label('Harga Jual')
                    ->required()
                    ->numeric(),
                TextInput::make('stock')
                ->label('Stok')
                    ->required()
                    ->numeric(),
                Select::make('status')
                ->label('Status')
                    ->options(['active' => 'Active', 'inactive' => 'Inactive'])
                    ->default('active')
                    ->required(),
                FileUpload::make('image')
                ->label('Gambar')
                    ->image(),
            ]);
    }
}
