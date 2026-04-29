<?php

namespace App\Filament\Resources\Products\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Filters\SelectFilter;

class ProductsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('images')
                    ->label('Swatch')
                    ->circular()
                    ->stacked()
                    ->limit(1),
                TextColumn::make('name')
                    ->label('Color Name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('collection.name')
                    ->label('Series')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('collection.brand.name')
                    ->label('Brand')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('variants_count')
                    ->counts('variants')
                    ->label('Sizes')
                    ->badge(),
            ])
            ->filters([
                SelectFilter::make('collection')
                    ->relationship('collection', 'name')
                    ->label('Filter by Series')
                    ->searchable()
                    ->preload(),
                SelectFilter::make('brand')
                    ->relationship('collection.brand', 'name')
                    ->label('Filter by Brand')
                    ->searchable()
                    ->preload(),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
