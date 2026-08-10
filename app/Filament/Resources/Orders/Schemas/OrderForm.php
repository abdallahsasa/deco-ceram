<?php

namespace App\Filament\Resources\Orders\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Repeater;
use Filament\Schemas\Schema;

class OrderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Customer Details')
                    ->schema([
                        TextInput::make('first_name')->required(),
                        TextInput::make('last_name')->required(),
                        TextInput::make('email')->email()->required(),
                        TextInput::make('phone'),
                        TextInput::make('company'),
                        Select::make('status')
                            ->options([
                                'pending' => 'Pending',
                                'processing' => 'Processing',
                                'completed' => 'Completed',
                                'cancelled' => 'Cancelled',
                            ])
                            ->required()
                            ->default('pending'),
                        Select::make('payment_status')
                            ->options([
                                'unpaid' => 'Unpaid',
                                'paid' => 'Paid',
                                'failed' => 'Failed',
                            ])
                            ->required()
                            ->default('unpaid'),
                        Textarea::make('address')
                            ->columnSpanFull()
                            ->label('Billing/Shipping Address'),
                        Textarea::make('notes')
                            ->columnSpanFull()
                            ->label('Order Notes'),
                    ])->columns(2),

                Section::make('Order Totals')
                    ->schema([
                        TextInput::make('subtotal')->numeric()->prefix('€'),
                        TextInput::make('total_amount')->numeric()->prefix('€')->required(),
                    ])->columns(2),

                Section::make('Ordered Products')
                    ->schema([
                        Repeater::make('items')
                            ->relationship()
                            ->schema([
                                Select::make('product_id')
                                    ->relationship('product', 'name')
                                    ->required()
                                    ->searchable(),
                                TextInput::make('variant_name'),
                                TextInput::make('boxes')->numeric(),
                                TextInput::make('pcs')->numeric()->label('Pieces (pcs)'),
                                TextInput::make('meters')->numeric()->label('Meters (m²)'),
                                TextInput::make('price')->numeric()->prefix('€'),
                                TextInput::make('total')->numeric()->prefix('€'),
                            ])
                            ->columns(2)
                            ->defaultItems(0)
                            ->disableItemCreation()
                            ->disableItemDeletion(),
                    ])
            ]);
    }
}
