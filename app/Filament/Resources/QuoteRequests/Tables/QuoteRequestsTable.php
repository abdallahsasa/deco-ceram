<?php

namespace App\Filament\Resources\QuoteRequests\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;

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
                \Filament\Tables\Actions\EditAction::make(),
                \Filament\Tables\Actions\Action::make('confirm')
                    ->label('Confirm Order')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->requiresConfirmation()
                    ->visible(fn (\App\Models\QuoteRequest $record): bool => $record->status !== 'completed')
                    ->action(function (\App\Models\QuoteRequest $record) {
                        $record->update(['status' => 'completed']);
                        $record->load('items.product.collection.brand');

                        // 1. Send acceptance email to customer
                        \Illuminate\Support\Facades\Mail::to($record->email)
                            ->send(new \App\Mail\OrderAcceptedMail($record));

                        // 2. Send shipping request email to active shipping companies
                        $shippingCompanies = \App\Models\ShippingCompany::where('is_active', true)->get();
                        foreach ($shippingCompanies as $company) {
                            \Illuminate\Support\Facades\Mail::to($company->email)
                                ->send(new \App\Mail\ShippingRequestMail($record));
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
