<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderItemResource\Pages;
use App\Models\OrderItem;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
// --- IMPORTACIONES NECESARIAS ---
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;

class OrderItemResource extends Resource
{
    protected static ?string $model = OrderItem::class;

    
    protected static bool $shouldRegisterNavigation = false; 

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';
    protected static ?string $navigationLabel = 'Comandas / Pedidos';
    protected static ?string $modelLabel = 'Pedido';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // 1. Selector de Reserva (Mesa)
                Select::make('reservation_id')
                    ->relationship('reservation', 'id') // Muestra el ID de la reserva
                    ->label('Nro. Reserva')
                    ->required()
                    ->searchable()
                    ->preload(),

                // 2. Selector de Producto (Comida)
                Select::make('product_id')
                    ->relationship('product', 'name') // Muestra el nombre "Milanesa"
                    ->label('Plato / Bebida')
                    ->required()
                    ->searchable()
                    ->preload(),

                // 3. Cantidad
                TextInput::make('quantity')
                    ->label('Cantidad')
                    ->numeric()
                    ->default(1)
                    ->required(),

                // 4. Notas (Opcional)
                Textarea::make('note')
                    ->label('Notas de Cocina')
                    ->placeholder('Ej: Sin sal, con hielo...')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
        
                TextColumn::make('reservation.id')
                    ->label('Reserva #')
                    ->sortable(),

              
                TextColumn::make('product.name')
                    ->label('Producto')
                    ->weight('bold')
                    ->searchable()
                    ->sortable(),

             
                TextColumn::make('product.price')
                    ->label('Precio Unit.')
                    ->money('ars')
                    ->sortable(),

             
                TextColumn::make('quantity')
                    ->label('Cant.')
                    ->sortable(),

                TextColumn::make('note')
                    ->label('Nota')
                    ->limit(20),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListOrderItems::route('/'),
            'create' => Pages\CreateOrderItem::route('/create'),
            'edit' => Pages\EditOrderItem::route('/{record}/edit'),
        ];
    }
}