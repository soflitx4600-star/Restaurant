<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Models\Order;
use App\Models\Product; // <-- Importado para buscar precios
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get; // <-- Importado para cálculos en vivo
use Filament\Forms\Set; // <-- Importado para cálculos en vivo
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Barryvdh\DomPDF\Facade\Pdf;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';
    
    protected static ?string $modelLabel = 'Comanda';
    protected static ?string $pluralModelLabel = 'Comandas';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('status')
                    ->label('Estado de la Comanda')
                    ->options([
                        'Pendiente' => 'Pendiente ⏳',
                        'Pagado' => 'Pagado ✅',
                        'Cancelado' => 'Cancelado ❌',
                    ])
                    ->default('Pendiente')
                    ->required(),

                Forms\Components\Select::make('payment_method')
                    ->label('Método de Pago')
                    ->options([
                        'Efectivo' => '💵 Efectivo',
                        'Mercado Pago' => '📱 Mercado Pago',
                        'Tarjeta' => '💳 Tarjeta',
                    ]),

                // El total se calcula solo, le ponemos readOnly para que no se pueda modificar a mano
                Forms\Components\TextInput::make('total_price')
                    ->label('Total ($)')
                    ->numeric()
                    ->prefix('$')
                    ->readOnly()
                    ->default(0),

                Forms\Components\Textarea::make('notes')
                    ->label('Notas Generales')
                    ->columnSpanFull(),

                // --- 👇 ACÁ EMPIEZA LA MAGIA DE FUDO (EL REPEATER AUTOMÁTICO) 👇 ---
                Forms\Components\Repeater::make('items')
                    ->relationship('items')
                    ->label('Productos del Pedido')
                    ->schema([
                        Forms\Components\Select::make('product_id')
                            ->relationship('product', 'name')
                            ->label('Elegir Plato/Bebida')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->live() // Escucha cuando eligen un plato
                            ->columnSpan(2),

                        Forms\Components\TextInput::make('quantity')
                            ->label('Cantidad')
                            ->numeric()
                            ->default(1)
                            ->minValue(1)
                            ->required()
                            ->live() // Escucha cuando cambian el numerito
                            ->columnSpan(1),

                        Forms\Components\TextInput::make('note')
                            ->label('Nota (Ej: Sin lechuga)')
                            ->columnSpan(3),
                    ])
                    ->columns(3)
                    ->columnSpanFull()
                    ->addActionLabel('🍔 Agregar Producto')
                    ->collapsible()
                    ->live() // Escucha cuando agregan o borran una fila
                    ->afterStateUpdated(function (Get $get, Set $set) {
                        $total = 0;
                        
                        foreach ((array) $get('items') as $item) {
                            $producto = Product::find($item['product_id']);
                            
                            // Asumimos que la columna de tu BD se llama 'price'
                            if ($producto && !empty($item['quantity'])) {
                                $total += $producto->price * $item['quantity'];
                            }
                        }
                        
                        $set('total_price', $total);
                    }),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('N° Pedido')
                    ->sortable(),

                Tables\Columns\TextColumn::make('status')
                    ->label('Estado')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Pendiente' => 'warning',
                        'Pagado' => 'success',
                        'Cancelado' => 'danger',
                        default => 'gray',
                    }),

                Tables\Columns\TextColumn::make('payment_method')
                    ->label('Método'),

                Tables\Columns\TextColumn::make('total_price')
                    ->label('Total')
                    ->money('ARS')
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Fecha')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                
                // 👇 ACÁ ESTÁ NUESTRO BOTÓN DE IMPRIMIR 👇
                Tables\Actions\Action::make('imprimir')
                    ->label('Ticket')
                    ->icon('heroicon-o-printer')
                    ->color('success')
                    ->action(function (Order $record) {
                        // Carga el diseño que creamos recién y le pasa los datos de la comanda
                        $pdf = Pdf::loadView('pdf.ticket', ['order' => $record]);
                        
                        // Te descarga el archivito listo para imprimir
                        return response()->streamDownload(function () use ($pdf) {
                            echo $pdf->stream();
                        }, 'ticket-' . $record->id . '.pdf');
                    }),
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
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }


    public static function canViewAny(): bool
    {
        // Solo el usuario con rol 1 (Administrador) puede ver esta pestaña
        return auth()->user()->role_id === 1;
    }
}