<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Product / Color Details')
                    ->schema([
                        Select::make('collection_id')
                            ->relationship('collection', 'name')
                            ->required()
                            ->label('Series (Collection)'),
                        Select::make('category_id')
                            ->relationship('category', 'name')
                            ->required()
                            ->label('Market Category'),
                        TextInput::make('name')
                            ->required()
                            ->label('Color Name (e.g. Spice)')
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (string $operation, $state, $set) => $operation === 'create' ? $set('slug', Str::slug($state)) : null),
                        TextInput::make('slug')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->placeholder('e.g. calacatta-gold'),
                        Textarea::make('description')
                            ->rows(3)
                            ->columnSpanFull(),
                    ])->columns(2),

                Section::make('Assets')
                    ->schema([
                        FileUpload::make('images')
                            ->multiple()
                            ->image()
                            ->directory('products')
                            ->label('Product Images'),
                    ]),
            ]);
    }
}
