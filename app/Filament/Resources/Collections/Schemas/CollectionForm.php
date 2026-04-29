<?php

namespace App\Filament\Resources\Collections\Schemas;

use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class CollectionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Series Information')
                    ->schema([
                        TextInput::make('id')
                            ->required()
                            ->label('Series ID (e.g. caesar-join)')
                            ->placeholder('Unique ID'),
                        Select::make('brand_id')
                            ->relationship('brand', 'name')
                            ->required()
                            ->label('Manufacturer (Brand)'),
                        TextInput::make('name')
                            ->required()
                            ->label('Series Name (e.g. Join)')
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (string $operation, $state, $set) => $operation === 'create' ? $set('slug', Str::slug($state)) : null),
                        TextInput::make('slug')
                            ->required()
                            ->unique(ignoreRecord: true),
                        Select::make('category_id')
                            ->relationship('category', 'name')
                            ->label('Market Category'),
                        Textarea::make('description')
                            ->columnSpanFull(),
                    ])->columns(2),

                Section::make('Visuals')
                    ->schema([
                        FileUpload::make('hero_image')
                            ->image()
                            ->directory('collections')
                            ->label('Hero Image / Banner'),
                    ]),
            ]);
    }
}
