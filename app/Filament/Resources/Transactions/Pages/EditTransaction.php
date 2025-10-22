<?php

namespace App\Filament\Resources\Transactions\Pages;

use App\Filament\Resources\Transactions\TransactionResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Filament\Actions\Action;

class EditTransaction extends EditRecord
{
    protected static string $resource = TransactionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('updateTotal')
                ->label('Update Total')
                ->action(function () {
                    $transaction = $this->record;
                    $total = $transaction->items->sum(function ($item) {
                        return $item->price * $item->quantity;
                    });
                    $transaction->update(['total' => $total]);
                    $this->notify('success', 'Total updated successfully.');
                })
                ->requiresConfirmation()
                ->color('primary'),
            DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
