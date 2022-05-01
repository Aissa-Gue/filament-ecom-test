<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Category;
use App\Models\Product;
use Filament\Forms;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\Card;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema(
                Card::make()->columns(2)->schema([
                    Forms\Components\TextInput::make('name')->required(),
                    Forms\Components\Select::make('category_id')
                        ->label('Category')
                        ->options(Category::all()->pluck('name', 'id'))
                        ->searchable()
                        ->required(),
                    Forms\Components\TextInput::make('quantity')->integer()->required(),
                    Forms\Components\TextInput::make('purchase_price')->numeric()->required(),
                    Forms\Components\TextInput::make('sale_price')->numeric()->required(),
                    Forms\Components\RichEditor::make('description')->required()->columnSpan('full'),
                    Forms\Components\Toggle::make('is_active')->required()
                        ->default(true)
                        ->onIcon('heroicon-s-lightning-bolt')->offIcon('heroicon-s-user'),
                ])
            );
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('category.name')->sortable(),
                Tables\Columns\TextColumn::make('quantity'),
                Tables\Columns\TextColumn::make('purchase_price'),
                Tables\Columns\TextColumn::make('sale_price'),
                Tables\Columns\BooleanColumn::make('is_active')->trueIcon('heroicon-o-badge-check')->falseIcon('heroicon-o-x-circle')
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('deleted_at')
                    ->options([
                        "with-trashed" => "With Trashed",
                        "only-trashed" => "Only Trashed",
                    ])
                    ->query(function (Builder $query, array $data) {
                        $query->when($data['value'] === "with-trashed", function (Builder $query) {
                            $query->withTrashed();
                        })->when($data['value'] === "only-trashed", function (Builder $query) {
                            $query->onlyTrashed();
                        });
                    })
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}