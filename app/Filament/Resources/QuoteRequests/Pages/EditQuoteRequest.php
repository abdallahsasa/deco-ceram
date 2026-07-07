<?php

namespace App\Filament\Resources\QuoteRequests\Pages;

use App\Filament\Resources\QuoteRequests\QuoteRequestResource;
use App\Models\QuoteRequest;
use App\Models\ShippingCompany;
use App\Mail\OrderAcceptedMail;
use App\Mail\ShippingRequestMail;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Mail;

class EditQuoteRequest extends EditRecord
{
    protected static string $resource = QuoteRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('confirm')
                ->label('Confirm Order')
                ->icon('heroicon-o-check-circle')
                ->color('success')
                ->requiresConfirmation()
                ->visible(fn (QuoteRequest $record): bool => $record->status !== 'completed')
                ->form([
                    TextInput::make('weight')
                        ->label('Poids total (kg)')
                        ->numeric()
                        ->required()
                        ->default(fn (QuoteRequest $record) => $record->getTotalWeight()),
                    TextInput::make('pallets')
                        ->label('Nombre de palettes')
                        ->numeric()
                        ->required()
                        ->default(fn (QuoteRequest $record) => $record->getTotalPallets()),
                    Textarea::make('delivery_address')
                        ->label('Lieu de livraison')
                        ->required()
                        ->default(fn (QuoteRequest $record) => $record->address),
                    Select::make('shipping_companies')
                        ->label('Shipping Companies to notify')
                        ->multiple()
                        ->options(fn () => ShippingCompany::where('is_active', true)->pluck('name', 'id'))
                        ->default(fn () => ShippingCompany::where('is_active', true)->pluck('id')->toArray())
                        ->required(),
                ])
                ->action(function (QuoteRequest $record, array $data) {
                    $record->update([
                        'status' => 'completed',
                        'address' => $data['delivery_address'],
                    ]);
                    $record->load('items.product.collection.brand');

                    // 1. Send acceptance email to customer
                    Mail::to($record->email)->send(new OrderAcceptedMail($record));

                    // 2. Send shipping request email to selected shipping companies
                    $shippingCompanies = ShippingCompany::whereIn('id', $data['shipping_companies'])->get();
                    foreach ($shippingCompanies as $company) {
                        Mail::to($company->email)->send(new ShippingRequestMail(
                            $record,
                            (int) $data['weight'],
                            (int) $data['pallets']
                        ));
                    }

                    // Refresh the form and redirect to display new values
                    $this->redirect($this->getResource()::getUrl('edit', ['record' => $record]));
                }),
            DeleteAction::make(),
        ];
    }
}
