<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReservationResource\Pages;
use App\Models\Reservation;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
// Importamos los componentes necesarios
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;

class ReservationResource extends Resource
{
    protected static ?string $model = Reservation::class;

    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar'; // Cambié a plata, ya es más una caja que una reserva
    protected static ?string $navigationLabel = 'Ventas Mostrador'; // Nombre más adecuado a la realidad

   // ACORDATE DE AGREGAR ESTAS DOS LÍNEAS ARRIBA DE TODO CON LOS OTROS "use"
    // use Filament\Forms\Components\Repeater;
    // use Filament\Forms\Components\Section;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // --- DATOS DEL CLIENTE Y LA MESA ---
                Forms\Components\Section::make('Datos de la Venta')
                    ->schema([
                        TextInput::make('client_name')
                            ->label('Nombre del Cliente')
                            ->placeholder('Ej: Juan Pérez')
                            ->required()
                            ->maxLength(255),

                        Select::make('user_id')
                            ->relationship('user', 'name')
                            ->label('Atendido por')
                            ->default(auth()->id())
                            ->searchable()
                            ->preload()
                            ->required(),

                        DateTimePicker::make('reservation_date')
                            ->label('Fecha y Hora')
                            ->default(now())
                            ->required(),

                        TextInput::make('table_number')
                            ->label('Mesa (Opcional)')
                            ->placeholder('Ej: Mostrador o Mesa 5')
                            ->maxLength(255),
                    ])->columns(2), // Pone los campos en 2 columnas para que quede más lindo

                // --- ACÁ ESTÁ LA MAGIA: EL REPETIDOR DE PEDIDOS ---
                Forms\Components\Section::make('Comanda (Lo que pidieron) 🍔')
                    ->schema([
                        Forms\Components\Repeater::make('orderItems')
                            ->relationship() // Se conecta automáticamente con los pedidos de esta mesa
                            ->label('')
                            ->schema([
                                Select::make('product_id')
                                    ->relationship('product', 'name') // Busca los platos en la tabla productos
                                    ->label('Plato / Bebida')
                                    ->searchable()
                                    ->preload()
                                    ->required()
                                    ->columnSpan(3),

                                TextInput::make('quantity')
                                    ->label('Cantidad')
                                    ->numeric()
                                    ->default(1)
                                    ->minValue(1)
                                    ->required()
                                    ->columnSpan(1),
                            ])
                            ->columns(4) // Divide el espacio para que quede el plato largo y la cantidad cortita
                            ->defaultItems(1) // Siempre arranca con 1 fila vacía
                            ->addActionLabel('Añadir otro plato o bebida ➕')
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
              
                TextColumn::make('index')
                    ->label('No')
                    ->rowIndex(), 
             
                // MOSTRAMOS EL CLIENTE REAL
                TextColumn::make('client_name')
                    ->label('Cliente')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'), 

                // MOSTRAMOS EL STAFF EN CHIQUITO
                TextColumn::make('user.name')
                    ->label('Cajero/Mozo')
                    ->badge()
                    ->color('gray')
                    ->toggleable(isToggledHiddenByDefault: false),

                TextColumn::make('reservation_date')
                    ->label('Fecha')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true), // Lo oculto por defecto para limpiar la tabla

                TextColumn::make('table_number')
                    ->label('Mesa')
                    ->searchable(),

                TextColumn::make('total')
                    ->label('Total ($)')
                    ->money('ars') 
                    ->sortable(),

                TextColumn::make('payment_method')
                    ->label('Pago')
                    ->badge() 
                    ->color('info'),

                TextColumn::make('status')
                    ->label('Estado')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'confirmed' => 'success',
                        'pending' => 'warning',
                        'cancelled' => 'danger',
                        default => 'gray',
                    }),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                
                Tables\Actions\Action::make('cobrar')
                    ->label('Cobrar')
                    ->icon('heroicon-o-currency-dollar')
                    ->color('success')
                    ->requiresConfirmation()
                    ->modalHeading('Cerrar Venta')
                    ->modalDescription('Elegí el medio de pago. El total se suma solo.')
                    
                    ->form([
                        \Filament\Forms\Components\TextInput::make('total_calculado')
                            ->label('Total a Pagar ($)')
                            ->disabled() 
                            ->dehydrated(false)
                            ->default(function ($record) {
                                $total = 0;
                                foreach ($record->orderItems as $item) {
                                    if ($item->product) {
                                        $total += $item->product->price * $item->quantity;
                                    }
                                }
                                return $total;
                            }),

                        \Filament\Forms\Components\Select::make('payment_method')
                            ->label('¿Cómo paga el cliente?')
                            ->options([
                                'efectivo' => 'Efectivo 💵',
                                'tarjeta' => 'Tarjeta 💳',
                                'mercadopago' => 'Mercado Pago 📲',
                            ])
                            ->required(),
                    ])
                    
                    ->action(function ($record, array $data) {
                        $total = 0;
                        foreach ($record->orderItems as $item) {
                            if ($item->product) {
                                $total += $item->product->price * $item->quantity;
                            }
                        }

                        $record->update([
                            // 'status' => 'pagado', 
                            'total' => $total,
                            'payment_method' => $data['payment_method'],
                        ]);

                        \Filament\Notifications\Notification::make()
                            ->title('¡Venta Cobrada!')
                            ->success()
                            ->send();
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
            'index' => Pages\ListReservations::route('/'),
            'create' => Pages\CreateReservation::route('/create'),
            'edit' => Pages\EditReservation::route('/{record}/edit'),
        ];
    }
}