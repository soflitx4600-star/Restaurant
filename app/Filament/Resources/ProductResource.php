<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
// Importamos para subir fotos
use Filament\Forms\Components\FileUpload; 
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-cake';
    protected static ?string $navigationLabel = 'Platos (Productos)';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // 1. Elegir a qué Categoría pertenece (Bebidas, Entradas...)
                Select::make('subject_id')
                    ->relationship('subject', 'name')
                    ->label('Categoría')
                    ->required(),

                // 2. Nombre del plato
                TextInput::make('name')
                    ->required(),

                // 3. LA FOTO
                FileUpload::make('image')
                    ->directory('products')
                    ->image()
                    ->columnSpanFull(),

                // 4. Precio
                TextInput::make('price')
                    ->numeric()
                    ->prefix('$')
                    ->required(),

                // --- NUEVO CAMPO DE STOCK ---
                TextInput::make('stock')
                    ->label('Stock Disponible')
                    ->numeric()
                    ->default(0)
                    ->required(),
                // ----------------------------
                
                // 5. Descripción
                Textarea::make('description')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')->circular(), 
                
                TextColumn::make('name')
                    ->sortable()
                    ->searchable(),
                
                TextColumn::make('price')
                    ->money('ars'),

                // --- NUEVA COLUMNA DE STOCK CON COLORES ---
                TextColumn::make('stock')
                    ->label('Stock')
                    ->numeric()
                    ->sortable()
                    ->badge() // Lo hace ver como una etiqueta
                    ->color(fn (string $state): string => match (true) {
                        $state <= 5 => 'danger',   // Rojo si quedan 5 o menos
                        $state <= 15 => 'warning', // Amarillo si quedan 15 o menos
                        default => 'success',      // Verde si hay más
                    }),
                // ------------------------------------------

                TextColumn::make('subject.name')
                    ->label('Categoría'),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
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