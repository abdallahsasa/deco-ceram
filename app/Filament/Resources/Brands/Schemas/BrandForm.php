<?php

namespace App\Filament\Resources\Brands\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class BrandForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Brand Identity')
                    ->schema([
                        TextInput::make('id')
                            ->required()
                            ->label('Brand ID (e.g. caesar)')
                            ->placeholder('Unique ID'),
                        TextInput::make('name')
                            ->required()
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (string $operation, $state, $set) => $operation === 'create' ? $set('slug', Str::slug($state)) : null),
                        TextInput::make('slug')
                            ->required()
                            ->unique(ignoreRecord: true),
                        Toggle::make('official_distributor')
                            ->label('Official Distributor')
                            ->default(false),
                    ])->columns(2),

                Section::make('Visual Assets')
                    ->schema([
                        FileUpload::make('logo')
                            ->image()
                            ->directory('brands/logos')
                            ->label('Brand Logo'),
                        FileUpload::make('hero_image')
                            ->image()
                            ->directory('brands/heroes')
                            ->label('Hero Image'),
                        Textarea::make('description')
                            ->columnSpanFull(),
                    ])->columns(2),
            ]);
    }
}
