<?php

namespace App\Filament\Resources\Sizes\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class SizesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Size Name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('id')
                    ->label('Technical ID')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('dimensions')
                    ->label('Dimensions'),
                TextColumn::make('thickness')
                    ->label('Thickness'),
                TextColumn::make('pcs_per_box')
                    ->label('Pcs/Box')
                    ->sortable(),
                TextColumn::make('sqm_per_box')
                    ->label('Sqm/Box')
                    ->sortable(),
            ])
            ->filters([
                //
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
