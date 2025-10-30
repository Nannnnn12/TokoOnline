<?php

namespace App\Filament\Resources\Transactions\Pages;

use App\Filament\Resources\Transactions\TransactionResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Filament\Actions\Action;

class EditTransaction extends EditRecord
{
    protected static string $resource = TransactionResource::class;
    public function getBreadcrumb(): string
    {
        return 'Lihat';
    }

    protected function getHeaderActions(): array
    {
        return [
            //
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
