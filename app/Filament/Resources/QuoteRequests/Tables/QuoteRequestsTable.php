<?php

namespace App\Filament\Resources\QuoteRequests\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use App\Models\QuoteRequest;
use App\Models\ShippingCompany;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;

class QuoteRequestsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->searchable(),
                TextColumn::make('first_name')
                    ->searchable(),
                TextColumn::make('last_name')
                    ->searchable(),
                TextColumn::make('company')
                    ->searchable(),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'new' => 'gray',
                        'pending' => 'warning',
                        'completed' => 'success',
                        'rejected' => 'danger',
                        default => 'gray',
                    }),
                TextColumn::make('items_count')
                    ->counts('items')
                    ->label('Products'),
            ])
            ->filters([
                //
            ])
            ->actions([
                \Filament\Actions\EditAction::make(),
                \Filament\Actions\Action::make('confirm')
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
                        \Illuminate\Support\Facades\Mail::to($record->email)
                            ->send(new \App\Mail\OrderAcceptedMail($record));

                        // 2. Send shipping request email to selected shipping companies
                        $shippingCompanies = ShippingCompany::whereIn('id', $data['shipping_companies'])->get();
                        foreach ($shippingCompanies as $company) {
                            \Illuminate\Support\Facades\Mail::to($company->email)
                                ->send(new \App\Mail\ShippingRequestMail(
                                    $record,
                                    (int) $data['weight'],
                                    (int) $data['pallets']
                                ));
                        }
                    }),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }
}
