<?php

namespace App\Filament\Resources\Banners\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class BannerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Banner Content')
                    ->schema([
                        TextInput::make('title')
                            ->placeholder('Main Heading'),
                        TextInput::make('subtitle')
                            ->placeholder('Subheading / Description'),
                        FileUpload::make('image')
                            ->image()
                            ->required()
                            ->directory('banners')
                            ->label('Banner Image'),
                    ]),
                
                Section::make('Action & Settings')
                    ->schema([
                        TextInput::make('button_text')
                            ->placeholder('e.g. Shop Now'),
                        TextInput::make('button_link')
                            ->placeholder('e.g. /products'),
                        TextInput::make('sort_order')
                            ->numeric()
                            ->default(0),
                        Toggle::make('is_active')
                            ->label('Active')
                            ->default(true),
                    ])->columns(2),
            ]);
    }
}
