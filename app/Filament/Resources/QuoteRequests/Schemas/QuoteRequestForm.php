<?php

namespace App\Filament\Resources\QuoteRequests\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Repeater;

class QuoteRequestForm
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
                        TextInput::make('project_type'),
                        Select::make('status')
                            ->options([
                                'new' => 'New',
                                'pending' => 'Pending',
                                'completed' => 'Completed',
                                'rejected' => 'Rejected',
                            ])
                            ->required()
                            ->default('new'),
                        Textarea::make('address')
                            ->columnSpanFull()
                            ->label('Delivery Address'),
                    ])->columns(2),

                Section::make('Message')
                    ->schema([
                        Textarea::make('message')->columnSpanFull(),
                    ]),

                Section::make('Requested Products')
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
                            ])
                            ->columns(5)
                            ->defaultItems(0)
                            ->disableItemCreation()
                            ->disableItemDeletion(),
                    ])
            ]);
    }
}
