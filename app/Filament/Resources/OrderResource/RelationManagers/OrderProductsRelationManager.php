<?php

namespace App\Filament\Resources\OrderResource\RelationManagers;

use App\Models\Product;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\HasManyRelationManager;
use Filament\Resources\Table;
use Filament\Tables;

class OrderProductsRelationManager extends HasManyRelationManager
{
    protected static string $relationship = 'orderProducts';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('product_id')
                    ->label('Product')
                    ->options(Product::all()->pluck('name', 'id'))
                    ->searchable()
                    ->required(),
                Forms\Components\TextInput::make('qte')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('product.name'),
                Tables\Columns\TextColumn::make('product.category.name')->label('category'),
                Tables\Columns\TextColumn::make('qte'),
                Tables\Columns\TextColumn::make('product.sale_price')->label('Unit price')->suffix(' DA'),
            ])
            ->filters([
                //
            ]);
    }
}