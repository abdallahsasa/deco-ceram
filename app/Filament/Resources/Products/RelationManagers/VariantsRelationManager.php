<?php

namespace App\Filament\Resources\Products\RelationManagers;

use Filament\Actions\AssociateAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DissociateAction;
use Filament\Actions\DissociateBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Table;

class VariantsRelationManager extends RelationManager
{
    protected static string $relationship = 'variants';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Technical Details')
                    ->schema([
                        Select::make('size_id')
                            ->relationship('sizeModel', 'name')
                            ->required()
                            ->searchable()
                            ->preload()
                            ->label('Technical Size / Packaging')
                            ->createOptionForm([
                                Section::make('New Size')
                                    ->schema([
                                        TextInput::make('id')
                                            ->required()
                                            ->label('Size ID (Technical)')
                                            ->placeholder('e.g. 60x120-1pc'),
                                        TextInput::make('name')
                                            ->required()
                                            ->label('Display Name')
                                            ->placeholder('e.g. 60x120 cm (1 pc)'),
                                        TextInput::make('pcs_per_box')->numeric()->default(1),
                                        TextInput::make('sqm_per_box')->numeric()->step(0.0001)->label('m² / Box'),
                                        TextInput::make('kg_per_box')->numeric()->step(0.01)->label('~ Kg / Box'),
                                        TextInput::make('kg_per_pallet')->numeric()->step(0.01)->label('~ Kg / Pal'),
                                    ])->columns(2),
                            ]),
                        TextInput::make('sku')
                            ->required()
                            ->label('SKU (e.g. AFAL)'),
                        TextInput::make('price_full_pallet')
                            ->numeric()
                            ->prefix('€')
                            ->label('Price >PL'),
                        TextInput::make('price_partial_pallet')
                            ->numeric()
                            ->prefix('€')
                            ->label('Price <PL'),
                        TextInput::make('finish_type')
                            ->placeholder('e.g. Matt RT')
                            ->label('Finish Type'),
                        Toggle::make('is_active')
                            ->default(true)
                            ->label('Is Active'),
                    ])->columns(2),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('sku')
            ->columns([
                TextColumn::make('sku')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('sizeModel.name')
                    ->label('Size')
                    ->sortable(),
                TextColumn::make('finish_type')
                    ->label('Finish'),
                TextColumn::make('price_full_pallet')
                    ->label('>PL')
                    ->money('EUR')
                    ->sortable(),
                TextColumn::make('price_partial_pallet')
                    ->label('<PL')
                    ->money('EUR')
                    ->sortable(),
                IconColumn::make('is_active')
                    ->boolean()
                    ->label('Active'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make(),
                AssociateAction::make(),
            ])
            ->recordActions([
                EditAction::make(),
                DissociateAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DissociateBulkAction::make(),
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
