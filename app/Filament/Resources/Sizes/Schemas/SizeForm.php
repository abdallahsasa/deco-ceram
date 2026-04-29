<?php

namespace App\Filament\Resources\Sizes\Schemas;

use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class SizeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('General Information')
                    ->schema([
                        TextInput::make('id')
                            ->required()
                            ->label('Size ID (Technical)')
                            ->placeholder('e.g. 60x60-9mm'),
                        TextInput::make('name')
                            ->required()
                            ->label('Display Name')
                            ->placeholder('e.g. 60x60 cm'),
                        TextInput::make('dimensions')
                            ->placeholder('e.g. 23 5/8" x 23 5/8"'),
                        TextInput::make('thickness')
                            ->placeholder('e.g. 9 mm'),
                    ])->columns(2),

                Section::make('Packaging Information')
                    ->description('Data for box and pallet calculations')
                    ->schema([
                        TextInput::make('pcs_per_box')
                            ->numeric()
                            ->default(1)
                            ->label('Pcs/box'),
                        TextInput::make('sqm_per_box')
                            ->numeric()
                            ->step(0.0001)
                            ->label('Sqm/box (Mq/sc)'),
                        TextInput::make('kg_per_box')
                            ->numeric()
                            ->step(0.01)
                            ->label('Kg/box'),
                        TextInput::make('boxes_per_pallet')
                            ->numeric()
                            ->label('Boxes/pal (Sc/pal)'),
                        TextInput::make('sqm_per_pallet')
                            ->numeric()
                            ->step(0.0001)
                            ->label('Sqm/pal (Mq/pal)'),
                        TextInput::make('kg_per_pallet')
                            ->numeric()
                            ->step(0.01)
                            ->label('Kg/pal'),
                    ])->columns(3),
            ]);
    }
}
